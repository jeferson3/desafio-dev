<?php

namespace App\Http\Resources;

use App\Http\Resources\Api\StoreListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'status'    => true,
            'timestamp' => now(),
            'data'      => StoreListResource::collection($this->resource['data']),
            'page'      => intval($this->resource['current_page']),
            'per_page'  => intval($this->resource['per_page']),
            'total'     => intval($this->resource['total'])
        ];
    }
}
