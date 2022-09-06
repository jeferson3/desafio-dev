<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Store extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'owner_name'
    ];

    /**
     * Timestamps columns
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * @return BelongsToMany
     */
    public function Transactions(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'transactions')
            ->withPivot('id', 'value', 'card_number', 'type', 'date', 'time');
    }

}
