<?php

namespace App\Http\Services\Store;

use App\Models\Store;

class StoreService implements StoreServiceInterface
{

    public function paginate(int $limit = 10): array
    {
        return Store::with('Transactions')
            ->withCount('Transactions')
            ->withSum('Transactions', 'transactions.value')
            ->paginate($limit)
            ->toArray();
    }
}
