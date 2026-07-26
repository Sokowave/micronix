<?php

namespace App\Services\Frontend\Product;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class Pagination
{
    public function paginate(
        Builder $query,
        string $sort = 'featured',
        int $perPage = 24,
    ): LengthAwarePaginator {
        $this->sort($query, $sort);

        return $query->paginate($perPage);
    }

    private function sort(Builder $query, string $sort): void
    {
        match ($sort) {
            'newest' => $query->latest(),
            'price_asc' => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            'name_asc' => $query->orderBy('name'),
            default => $query->latest(),
        };
    }
}