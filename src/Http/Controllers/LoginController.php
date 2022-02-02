<?php

namespace LaravelAuth\Http\Controllers;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\AbstractProvider;
use LaravelAuth\Http\Requests\LoginRequest;
use LaravelAuth\Models\User;

/**
 * Class LoginController.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Http\Controllers
 */
class LoginController extends Controller
{
    /**
     * Resource class.
     *
     * @var string
     */
    protected string $resource;

    /**
     * Model class.
     *
     * @var string
     */
    protected string $model;

    /**
     * Instantiate a new controller instance.
     */
    public function __construct()
    {
        $this->resource = config('laravel-auth.user_resource');
        $this->model = config('laravel-auth.user_model') ?? User::class;
    }

    /**
     * Login user.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws AuthenticationException
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $user = $this->model::query()
            ->find($this->getUser($request)->id);

        $token = $user->createToken($request->userAgent());

        return Response::json([
            'data' => [
                'access_token' => $token->plainTextToken,
                'user' => $this->resource ? new $this->resource($user) : $user
            ],
            'message' => 'Success'
        ]);
    }

    /**
     * Get user.
     *
     * @param LoginRequest $request
     * @return mixed
     * @throws AuthenticationException
     */
    private function getUser(LoginRequest $request): mixed
    {
        if ($this->shouldLoginViaSocials($request)) {
            return $this->loginViaSocials($request);
        }

        if (!Auth::attempt($request->only(['email', 'password']))) {
            throw new AuthenticationException(
                'Email or password is incorrect'
            );
        }

        return $request->user();
    }

    /**
     * Should log in via socials.
     *
     * @param LoginRequest $request
     * @return bool
     */
    private function shouldLoginViaSocials(LoginRequest $request): bool
    {
        return $request->has('driver') && $request->has('access_token');
    }

    /**
     * Log in via socials.
     *
     * @param LoginRequest $request
     * @return mixed
     * @throws AuthenticationException
     */
    private function loginViaSocials(LoginRequest $request): mixed
    {
        try {
            /** @var AbstractProvider $driver */
            $driver = Socialite::driver($request->get('driver'));
            $socialiteUser = $driver->userFromToken($request->get('access_token'));
        } catch (ClientException) {
            throw new AuthenticationException(
                'Driver or code is incorrect'
            );
        }

        return $this->model::query()->firstOrCreate(
            [
                'email' => $socialiteUser->getEmail()
            ],
            [
                'name' => $socialiteUser->getName(),
                'email_verified_at' => now(),
                'password' => null,
            ]
        );
    }
}
