<?php

namespace LaravelAuth\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use LaravelAuth\Http\Requests\ResetPasswordRequest;
use LaravelAuth\Models\PasswordReset;
use LaravelAuth\Models\User;

/**
 * Class ResetPasswordController.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Http\Controllers
 */
class ResetPasswordController extends Controller
{
    /**
     * Reset password user.
     *
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function __invoke(ResetPasswordRequest $request): JsonResponse
    {
        return DB::transaction(function () use ($request) {
            $model = config('laravel-auth.user_model') ?? User::class;

            /** @var PasswordReset $passwordReset */
            $passwordReset = PasswordReset::query()
                ->where('token', '=', $request->get('token'))
                ->first();

            $user = $model::query()->where('email', '=', $passwordReset->email)->first();
            $user->update(['password' => data_get($request->validated(), 'password')]);

            $passwordReset->delete();

            return Response::json([
                'message' => 'Success'
            ]);
        });
    }
}
