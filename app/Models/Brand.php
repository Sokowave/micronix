<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
class Brand extends Model
{
    use HasUuids;

    /**
     * The columns that should receive unique UUIDs.
     */
    public function uniqueIds(): array
    {
        return ['public_id'];
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'position' => 'integer',
        ];
    }
}