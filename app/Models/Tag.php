<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable([
    'name',
    'slug',
])]
class Tag extends Model
{
    use HasUuids;

    public function uniqueIds(): array
    {
        return ['public_id'];
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}