<?php

namespace App\Services\Collection;

use App\Models\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class Show
{
    /**
     * Find an active collection by slug.
     */
    public function find(string $slug): Collection
    {
        return Collection::query()
            ->with('media')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

    /**
     * Get active products belonging to the collection.
     */
    public function products(Collection $collection): EloquentCollection
    {
        return $collection
            ->products()
            ->with([
                'brand',
                'category',
                'primaryMedia',
            ])
            ->where('products.is_active', true)
            ->get();
    }
}