<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductDetailsController extends Controller
{
    public function show(string $slug)
    {
        $product = Product::query()
            ->published()
            ->with([
                'brand',
                'category.parent',
                'images',
                'tags',
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        $similarProducts = Product::query()
            ->published()
            ->where('category_id', $product->category_id)
            ->whereKeyNot($product->id)
            ->with([
                'brand',
                'category',
                'images',
            ])
            ->inRandomOrder()
            ->take(8)
            ->get();

        $breadcrumbs = $product->category
            ? $product->category->getBreadcrumbs()
            : collect();

        $breadcrumbs->push((object) [
            'name' => $product->title,
        ]);

        $metaKeywords = collect([
            $product->title,
            $product->brand?->name,
            $product->category?->name,
        ])
            ->filter()
            ->implode(', ');

        return view('frontend.product_details', [
            'product'         => $product,
            'similarProducts' => $similarProducts,
            'breadcrumbs'     => $breadcrumbs,
            'metaKeywords'    => $metaKeywords,
        ]);
    }
}