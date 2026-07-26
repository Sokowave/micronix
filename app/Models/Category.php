<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'parent_id',
    'media_id',
    'name',
    'slug',
    'icon',
    'description',
    'meta_title',
    'meta_description',
    'is_active',
    'position',
])]
class Category extends Model
{
    use HasUuids;

    /**
     * The columns that should receive unique UUIDs.
     */
    public function uniqueIds(): array
    {
        return ['public_id'];
    }
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->orderBy('position');
    }

    public function descendants(): HasMany
    {
        return $this->children()
            ->with('descendants');
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function specifications(): BelongsToMany
    {
        return $this->belongsToMany(
            Specification::class,
            'category_specification'
        )
            ->withPivot('position')
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