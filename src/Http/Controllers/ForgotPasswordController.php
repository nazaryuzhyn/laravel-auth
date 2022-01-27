<?php

namespace LaravelAuth\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use LaravelAuth\Http\Requests\ForgotPasswordRequest;
use LaravelAuth\Models\PasswordReset;
use LaravelAuth\Models\User;

/**
 * Class ForgotPasswordController.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Http\Controllers
 */
class ForgotPasswordController extends Controller
{
    /**
     * Forgot password user.
     *
     * @param ForgotPasswordRequest $request
     * @return JsonResponse
     */
    public function __invoke(ForgotPasswordRequest $request): JsonResponse
    {
        return DB::transaction(function () use ($request) {
            $model = config('laravel-auth.user_model') ?? User::class;

            $user = $model::query()->where('email', '=', $request->get('email'))->first();

            /** @var PasswordReset $passwordReset */
            $passwordReset = PasswordReset::query()->firstOrCreate(
                ['email' => $user->email],
                [
                    'token' => Str::random(60)
                ]
            );

            $notification = config('laravel-auth.reset_password.notification');

            $user->notify(new $notification($passwordReset->token));

            return Response::json([
                'message' => 'Success'
            ]);
        });
    }
}
