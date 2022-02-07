<?php

namespace LaravelAuth\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * Class DeleteTokenController.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Http\Controllers
 */
class DeleteTokenController extends Controller
{
    /**
     * Delete token.
     *
     * @param PersonalAccessToken $token
     * @return JsonResponse
     */
    public function __invoke(PersonalAccessToken $token): JsonResponse
    {
        $token->delete();

        return Response::json([], 204);
    }
}
