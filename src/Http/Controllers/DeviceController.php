<?php

namespace LaravelAuth\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use LaravelAuth\Http\Resources\DeviceResource;

/**
 * Class DeviceController.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Http\Controllers
 */
class DeviceController extends Controller
{
    /**
     * Devices the user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $resource = config('laravel-auth.devices.resource') ?? DeviceResource::class;

        $devices = $request->user()
            ->tokens()
            ->get();

        return Response::json([
            'data' => $resource::collection($devices)
        ]);
    }
}
