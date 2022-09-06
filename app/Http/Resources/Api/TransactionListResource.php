<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionListResource extends JsonResource
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
            'customer' => [
                'cpf'  => $this->resource["cpf"],
                'name' => $this->resource["name"] ?? 'empty name',
                'card_number' => $this->resource['pivot']["card_number"],
            ],
            'value' => 'R$ ' . number_format($this->resource["pivot"]['value'], 2, ',', '.'),
            'type'  => $this->resource['pivot']["type"],
            'date'  => date('d/m/Y', strtotime($this->resource['pivot']["date"])),
            'time'  => date('H:i:s', strtotime($this->resource['pivot']["time"])),
        ];
    }
}
