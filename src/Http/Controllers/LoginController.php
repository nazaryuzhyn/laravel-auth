<?php

namespace LaravelAuth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use LaravelAuth\Http\Requests\LoginRequest;

/**
 * Class LoginActionController.
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
        if (!Auth::attempt($request->only(['email', 'password']))) {
            throw new AuthenticationException(
                'Email or password is incorrect'
            );
        }

        return $request->user();
    }
}
