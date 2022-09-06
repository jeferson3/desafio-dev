<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreListResource extends JsonResource
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
            'id'            => $this->resource['id'],
            "store"         => $this->resource['name'],
            "owner_name"    => $this->resource['owner_name'],
            'transactions'  => [
                'qtd'       => $this->resource['transactions_count'],
                'total'     => 'R$ ' . number_format($this->resource['transactions_sum_transactionsvalue'], 2, ',', '.'),
                'history'   => TransactionListResource::collection($this->resource['transactions'])
            ],
        ];
    }
}
