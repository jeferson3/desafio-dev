<?php

namespace App\Http\Services\Store;

interface StoreServiceInterface
{
    public function paginate(int $limit = 10): array;
}
