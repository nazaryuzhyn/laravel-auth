<?php

namespace LaravelAuth\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use LaravelAuth\Http\Requests\SignUpRequest;
use LaravelAuth\Models\User;

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
            $model = config('laravel-auth.user_model') ?? User::class;
            $resource = config('laravel-auth.user_resource');

            $user = $model::query()->create($request->validated());

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
