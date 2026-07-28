<?php

namespace App\Services\Frontend;

use App\Models\Brand as BrandModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class Brand
{
    /**
     * Base query for active brands.
     */
    public function query(): Builder
    {
        return BrandModel::query()
            ->with('media')
            ->where('is_active', true);
    }

    /**
     * Get all active brands.
     */
    public function get(): Collection
    {
        return $this->query()
            ->orderBy('position')
            ->orderBy('name')
            ->get();
    }

    /**
     * Get active brands that have active products.
     */
    public function available(): Collection
    {
        return $this->query()
            ->whereHas('products', fn ($query) => $query
                ->where('is_active', true)
            )
            ->withCount([
                'products' => fn ($query) => $query
                    ->where('is_active', true),
            ])
            ->orderBy('position')
            ->orderBy('name')
            ->get();
    }

    /**
     * Get brands for the product filters.
     */
    public function filters(?string $search = null): Collection
    {
        return $this->query()
            ->whereHas('products', fn ($query) => $query
                ->where('is_active', true)
            )
            ->withCount([
                'products' => fn ($query) => $query
                    ->where('is_active', true),
            ])
            ->when(
                filled($search),
                fn ($query) => $query->where(
                    'name',
                    'like',
                    '%' . $search . '%'
                )
            )
            ->orderBy('name')
            ->get();
    }
}