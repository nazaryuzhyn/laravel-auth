<?php

namespace LaravelAuth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use LaravelAuth\Http\Requests\SignUpRequest;

/**
 * Class SignUpController.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Http\Controllers
 */
class SignUpController extends Controller
{
    public function __invoke(SignUpRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $resource = config('laravel-auth.user_resource');

            /** @var User $user */
            $user = User::query()->create($request->validated());

            $token = $user->createToken($request->userAgent());

            return Response::json([
                'data' => [
                    'access_token' => $token->plainTextToken,
                    'user' => $resource ? new $resource($user) : $user
                ],
                'message' => 'Success'
            ], 201);
        });
    }
}
