<?php

namespace LaravelAuth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use LaravelAuth\Http\Requests\ResetPasswordRequest;
use LaravelAuth\Models\PasswordReset;

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
            /** @var PasswordReset $passwordReset */
            $passwordReset = PasswordReset::query()
                ->where('token', '=', $request->get('token'))
                ->first();

            $user = User::query()->where('email', '=', $passwordReset->email)->first();
            $user->update(['password' => data_get($request->validated(), 'password')]);

            $passwordReset->delete();

            return Response::json([
                'message' => 'Success'
            ]);
        });
    }
}
