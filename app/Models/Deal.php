<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable([
    'name',
    'slug',
    'starts_at',
    'ends_at',
    'is_active',
    'position',
])]
class Deal extends Model
{
    use HasUuids;

    /**
     * The columns that should receive unique UUIDs.
     */
    public function uniqueIds(): array
    {
        return ['public_id'];
    }

    /**
     * Get the products belonging to this deal.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'deal_product'
        )
            ->withPivot('position')
            ->withTimestamps()
            ->orderByPivot('position');
    }

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'is_active' => 'boolean',
            'position' => 'integer',
        ];
    }
}