<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\BannerLocation;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Services\Media\MediaUploaderService;

class BannerController extends Controller
{
    protected MediaUploaderService $mediaUploader;

    public function __construct(MediaUploaderService $mediaUploader)
    {
        $this->mediaUploader = $mediaUploader;
    }

    public function index()
    {
        $banners = Banner::with([
            'location',
            'media',
            'targets',
        ])->ordered()->paginate(10);

        return view('backend.banners.index', compact('banners'));
    }

    public function create()
    {
        $locations = BannerLocation::all();
        $categories = Category::all();
        $products = Product::select('id', 'title')->get();
        $brands = Brand::all();

        return view('backend.banners.create', compact(
            'locations',
            'categories',
            'products',
            'brands'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_location_id' => ['required', 'exists:banner_locations,id'],
            'title' => ['nullable', 'string', 'max:255'],

            'image' => ['required', 'image', 'max:2048'],

            'priority' => ['nullable', 'integer'],
            'is_active' => ['required', 'boolean'],

            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],

            'target_type' => ['nullable', 'in:category,product,brand,custom_link'],

            'category_id' => ['nullable', 'required_if:target_type,category', 'exists:categories,id'],
            'product_id' => ['nullable', 'required_if:target_type,product', 'exists:products,id'],
            'brand_id' => ['nullable', 'required_if:target_type,brand', 'exists:brands,id'],

            'custom_link' => ['nullable', 'required_if:target_type,custom_link', 'string', 'max:255'],
        ]);

        $location = BannerLocation::findOrFail($request->banner_location_id);

        $count = Banner::where('banner_location_id', $location->id)->count();

        if ($count >= $location->max_banners) {
            return back()
                ->withErrors([
                    'banner_location_id' => "This location allows only {$location->max_banners} banner(s)."
                ])
                ->withInput();
        }

        $bannerData = [
            'banner_location_id' => $request->banner_location_id,
            'title' => $request->title,
            'priority' => $request->priority ?? 0,
            'is_active' => $request->boolean('is_active'),
            'starts_at' => $request->starts_at,
            'ends_at' => $request->ends_at,
        ];

        if ($request->hasFile('image')) {
            $media = $this->mediaUploader->upload(
                $request->file('image'),
                'banners'
            );

            $bannerData['media_id'] = $media->id;
        }

        $banner = Banner::create($bannerData);

        $this->syncTarget($banner, $request);

        return redirect()
            ->route('backoffice.banners.index')
            ->with('success', 'Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        $locations = BannerLocation::all();
        $categories = Category::all();
        $products = Product::select('id', 'title')->get();
        $brands = Brand::all();

        $target = $banner->targets()->first();

        return view('backend.banners.edit', compact(
            'banner',
            'locations',
            'categories',
            'products',
            'brands',
            'target'
        ));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'banner_location_id' => ['required', 'exists:banner_locations,id'],
            'title' => ['nullable', 'string', 'max:255'],

            'image' => ['nullable', 'image', 'max:2048'],

            'priority' => ['nullable', 'integer'],
            'is_active' => ['required', 'boolean'],

            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],

            'target_type' => ['nullable', 'in:category,product,brand,custom_link'],

            'category_id' => ['nullable', 'required_if:target_type,category', 'exists:categories,id'],
            'product_id' => ['nullable', 'required_if:target_type,product', 'exists:products,id'],
            'brand_id' => ['nullable', 'required_if:target_type,brand', 'exists:brands,id'],

            'custom_link' => ['nullable', 'required_if:target_type,custom_link', 'string', 'max:255'],
        ]);

        if ($banner->banner_location_id != $request->banner_location_id) {

            $location = BannerLocation::findOrFail($request->banner_location_id);

            $count = Banner::where('banner_location_id', $location->id)->count();

            if ($count >= $location->max_banners) {
                return back()
                    ->withErrors([
                        'banner_location_id' => "This location allows only {$location->max_banners} banner(s)."
                    ])
                    ->withInput();
            }
        }

        $bannerData = [
            'banner_location_id' => $request->banner_location_id,
            'title' => $request->title,
            'priority' => $request->priority ?? 0,
            'is_active' => $request->boolean('is_active'),
            'starts_at' => $request->starts_at,
            'ends_at' => $request->ends_at,
        ];

        if ($request->hasFile('image')) {
            $media = $this->mediaUploader->upload(
                $request->file('image'),
                'banners'
            );

            $bannerData['media_id'] = $media->id;
        }

        $banner->update($bannerData);

        $this->syncTarget($banner, $request);

        return redirect()
            ->route('backoffice.banners.index')
            ->with('success', 'Banner updated successfully.');
    }

    public function destroy(Banner $banner)
    {
        $banner->targets()->delete();

        $banner->delete();

        return redirect()
            ->route('backoffice.banners.index')
            ->with('success', 'Banner deleted successfully.');
    }

    private function syncTarget(Banner $banner, Request $request): void
    {
        $banner->targets()->delete();

        if (!$request->target_type) {
            return;
        }

        $data = match ($request->target_type) {

            'category' => [
                'target_type' => 'category',
                'target_id' => $request->category_id,
            ],

            'product' => [
                'target_type' => 'product',
                'target_id' => $request->product_id,
            ],

            'brand' => [
                'target_type' => 'brand',
                'target_id' => $request->brand_id,
            ],

            'custom_link' => [
                'target_type' => 'custom_link',
                'custom_link' => $request->custom_link,
                'target_id' => null,
            ],

            default => null,
        };

        if ($data) {
            $banner->targets()->create($data);
        }
    }
}