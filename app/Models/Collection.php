<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable([
    'media_id',
    'name',
    'slug',
    'description',
    'meta_title',
    'meta_description',
    'is_active',
    'position',
])]
class Collection extends Model
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
     * Get the collection image.
     */
    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    /**
     * Get the products belonging to this collection.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'collection_product'
        )
            ->withPivot('position')
            ->withTimestamps()
            ->orderByPivot('position');
    }

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'position' => 'integer',
        ];
    }
}