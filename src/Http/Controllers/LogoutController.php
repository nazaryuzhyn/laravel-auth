<?php

namespace LaravelAuth\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

/**
 * Class LogoutController.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Http\Controllers
 */
class LogoutController extends Controller
{
    /**
     * Logout user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $request->user()?->currentAccessToken()->delete() ?? Auth::logout();

        return Response::json([], 204);
    }
}
