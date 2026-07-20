<?php

namespace App\Http\Controllers\Backoffice\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\Product\CreateRequest;
use App\Http\Requests\Backoffice\Product\UpdateRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\Products\FilterService;
use App\Services\Products\ProductService;

class ProductController extends Controller
{
    public function __construct(
        protected FilterService $filterService,
        protected ProductService $productService,
    ) {
        $this->authorizeResource(Product::class, 'product');
    }

    public function index()
    {
        $products = $this->filterService
            ->apply(
                Product::query()->with([
                    'brand',
                    'category',
                    'productImages.media',
                ])
            )
            ->paginate(20)
            ->withQueryString();

        return view('backend.products.index', [
            'products' => $products,
            ...$this->formData(),
        ]);
    }

    public function create()
    {
        return view('backend.products.create', [
            'product' => new Product(),
            ...$this->formData(),
        ]);
    }

    public function store(CreateRequest $request)
    {
        $product = $this->productService->create(
            $this->payload($request)
        );

        return redirect()
            ->route('backoffice.products.edit', $product)
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load([
            'brand',
            'category',
            'productImages.media',
            'tags',
        ]);

        return view('backend.products.edit', [
            'product' => $product,
            ...$this->formData(),
        ]);
    }

    public function update(
        UpdateRequest $request,
        Product $product
    ) {
        $this->productService->update(
            $product,
            $this->payload($request)
        );

        return redirect()
            ->route('backoffice.products.edit', $product)
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $this->productService->delete($product);

        return redirect()
            ->route('backoffice.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    protected function formData(): array
    {
        return [
            'brands' => Brand::query()
                ->orderBy('name')
                ->get(),

            'categories' => Category::leaf()
                ->with('parent')
                ->get()
                ->sortBy('full_name')
                ->values(),
        ];
    }

    protected function payload(CreateRequest|UpdateRequest $request): array
    {
        $data = $request->validated();

        $data['images'] = collect(
            $request->file('images', [])
        )
            ->filter()
            ->values()
            ->all();

        $data['existing_media'] = collect(
            $data['existing_media'] ?? []
        )
            ->filter()
            ->values()
            ->all();

        $data['remove_media_ids'] = collect(
            $data['remove_media_ids'] ?? []
        )
            ->filter()
            ->values()
            ->all();

        return $data;
    }
}