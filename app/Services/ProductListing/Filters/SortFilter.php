<?php

namespace App\Services\ProductListing\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SortFilter
{
    private const OPTIONS = [
        'featured'  => 'Featured',
        'newest'    => 'Latest Arrivals',
        'price_asc' => 'Price: Low to High',
        'price_desc'=> 'Price: High to Low',
        'name'      => 'Name (A–Z)',
    ];

    public function apply(Builder $query, Request $request): void
    {
        match ($this->current($request)) {

            'featured' => $query
                ->orderByDesc('featured')
                ->latest(),

            'newest' => $query
                ->latest(),

            'price_asc' => $query
                ->orderByRaw('COALESCE(sale_price, price) ASC'),

            'price_desc' => $query
                ->orderByRaw('COALESCE(sale_price, price) DESC'),

            'name' => $query
                ->orderBy('title'),
        };
    }

    public function current(Request $request): string
    {
        $sort = $request->input('sort', 'featured');

        return array_key_exists($sort, self::OPTIONS)
            ? $sort
            : 'featured';
    }

    public function label(Request $request): string
    {
        return self::OPTIONS[$this->current($request)];
    }

    public function options(): array
    {
        return self::OPTIONS;
    }
}