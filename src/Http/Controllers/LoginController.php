<?php

namespace LaravelAuth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\AbstractProvider;
use LaravelAuth\Http\Requests\LoginRequest;

/**
 * Class LoginController.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Http\Controllers
 */
class LoginController extends Controller
{
    /**
     * Login user.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws AuthenticationException
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $resource = config('laravel-auth.user_resource');

        $user = $this->getUser($request);
        $token = $user->createToken($request->userAgent());

        return Response::json([
            'data' => [
                'access_token' => $token->plainTextToken,
                'user' => $resource ? new $resource($user) : $user
            ],
            'message' => 'Success'
        ]);
    }

    /**
     * Get user.
     *
     * @param LoginRequest $request
     * @return User|null
     * @throws AuthenticationException
     */
    private function getUser(LoginRequest $request): ?User
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
     * @return User
     * @throws AuthenticationException
     */
    private function loginViaSocials(LoginRequest $request): User
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

        /** @var User $user */
        $user = User::query()->firstOrCreate(
            [
                'email' => $socialiteUser->getEmail()
            ],
            [
                'name' => $socialiteUser->getName(),
                'email_verified_at' => now(),
                'password' => null,
            ]
        );

        return $user;
    }
}
