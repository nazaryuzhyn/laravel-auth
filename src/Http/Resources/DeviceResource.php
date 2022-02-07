<?php

namespace LaravelAuth\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class DeviceResource.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Http\Resources
 */
class DeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'last_used_at' => $this->resource->last_used_at,
        ];
    }
}
