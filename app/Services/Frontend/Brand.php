<?php

namespace App\Services\Frontend;

use App\Models\Brand as BrandModel;
use Illuminate\Database\Eloquent\Collection;

class Brand
{
    /**
     * Get all active brands.
     */
    public function get(): Collection
    {
        return BrandModel::query()
            ->with('media')
            ->where('is_active', true)
            ->orderBy('position')
            ->orderBy('name')
            ->get();
    }

    /**
     * Get active brands available for product filtering.
     */
    public function filters(?string $search = null): Collection
    {
        return BrandModel::query()
            ->where('is_active', true)
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
                    '%'.$search.'%'
                )
            )
            ->orderBy('name')
            ->get();
    }
}