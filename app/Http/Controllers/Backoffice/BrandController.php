<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Brand;

use App\Services\Media\MediaUploaderService;

class BrandController extends Controller
{
    protected MediaUploaderService $mediaUploader;

    public function __construct(
        MediaUploaderService $mediaUploader
    ) {
        $this->mediaUploader = $mediaUploader;
        $this->authorizeResource(Brand::class, 'brand');
    }

    public function index()
    {
        $brands = Brand::with('logo')
            ->latest()
            ->paginate(20);

        return view(
            'backend.brands.index',
            compact('brands')
        );
    }

    public function create()
    {
        return view(
            'backend.brands.create'
        );
    }

    public function store(Request $request)
    {
        $brandData = $request->validate([

            'name' => 'required|string|max:255|unique:brands,name',

            'image' => 'nullable|image|max:5120',

            'meta_title' => 'nullable|string|max:255',

            'meta_description' => 'nullable|string',

            'status' => 'required|string|in:active,inactive',
        ]);


        if ($request->hasFile('image')) {

            $media = $this->mediaUploader->upload(
                $request->file('image'),
                'brands'
            );

            $brandData['logo_id'] = $media->id;
        }

        Brand::create($brandData);

        return redirect()
            ->route('backoffice.brands.index')
            ->with(
                'success',
                'Brand created successfully.'
            );
    }

    public function edit(Brand $brand)
    {
        $brand->load('logo');

        return view(
            'backend.brands.edit',
            compact('brand')
        );
    }

    public function update(
        Request $request,
        Brand $brand
    ) {

        $brandData = $request->validate([

            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,

            'image' => 'nullable|image|max:5120',

            'meta_title' => 'nullable|string|max:255',

            'meta_description' => 'nullable|string',

            'status' => 'required|string|in:active,inactive',
        ]);


        if ($request->hasFile('image')) {

            $media = $this->mediaUploader->upload(
                $request->file('image'),
                'brands'
            );

            $brandData['logo_id'] = $media->id;
        }

        $brand->update($brandData);

        return redirect()
            ->route('backoffice.brands.index')
            ->with(
                'success',
                'Brand updated successfully.'
            );
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()
            ->route('backoffice.brands.index')
            ->with(
                'success',
                'Brand deleted successfully.'
            );
    }
}