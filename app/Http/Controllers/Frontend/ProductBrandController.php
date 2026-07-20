<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductBrandController extends Controller
{
    private array $sortOptions = [
        'newest'     => 'Latest Arrivals',
        'price_asc'  => 'Price: Low to High',
        'price_desc' => 'Price: High to Low',
        'name'       => 'Name (A-Z)',
    ];

    public function show(Request $request, string $slug)
    {
        $brand = Brand::where('slug', $slug)
            ->firstOrFail();

        $sort = $request->input('sort', 'newest');

        if (! array_key_exists($sort, $this->sortOptions)) {
            $sort = 'newest';
        }

        $productsQuery = $brand->products()
            ->published()
            ->with([
                'images',
                'brand',
                'category',
            ]);

        $allProducts = (clone $productsQuery)->get();

        $minPriceDefault = $allProducts->min('current_price') ?? 0;
        $maxPriceDefault = $allProducts->max('current_price') ?? 0;

        if ($request->filled('min_price')) {
            $productsQuery->where(function ($query) use ($request) {
                $query->where('price', '>=', $request->min_price)
                    ->orWhere('sale_price', '>=', $request->min_price);
            });
        }

        if ($request->filled('max_price')) {
            $productsQuery->where(function ($query) use ($request) {
                $query->where('price', '<=', $request->max_price)
                    ->orWhere('sale_price', '<=', $request->max_price);
            });
        }

        $this->applySorting($productsQuery, $sort);

        $products = $productsQuery
            ->paginate(24)
            ->appends($request->query());

        return view('frontend.product_listing', [
            'brand'             => $brand,
            'products'          => $products,
            'sort'              => $sort,
            'sortLabel'         => $this->sortOptions[$sort],
            'sortOptions'       => $this->sortOptions,
            'selectedView'      => $request->cookie('productView', 'grid'),
            'min_price'         => $request->min_price,
            'max_price'         => $request->max_price,
            'min_price_default' => $minPriceDefault,
            'max_price_default' => $maxPriceDefault,
        ]);
    }

    private function applySorting($query, string $sort): void
    {
        match ($sort) {
            'price_asc' => $query->orderByRaw('COALESCE(sale_price, price) ASC'),

            'price_desc' => $query->orderByRaw('COALESCE(sale_price, price) DESC'),

            'name' => $query->orderBy('title'),

            default => $query->latest(),
        };
    }
}