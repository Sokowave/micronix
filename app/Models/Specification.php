<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable([
    'name',
    'slug',
    'icon',
])]
class Specification extends Model
{
    use HasUuids;

    /**
     * The columns that should receive unique UUIDs.
     */
    public function uniqueIds(): array
    {
        return ['public_id'];
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_specification')
            ->withPivot('position');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_specifications')
            ->withPivot('value');
    }
}