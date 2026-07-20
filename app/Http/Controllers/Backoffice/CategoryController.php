<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\Media\MediaUploaderService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        protected MediaUploaderService $mediaUploader
    ) {
        $this->authorizeResource(Category::class, 'category');
    }

    private function defaultCategory(): Category
    {
        return Category::firstOrCreate(
            ['slug' => 'uncategorized'],
            [
                'name' => 'Uncategorized',
                'meta_title' => 'Uncategorized',
                'is_active' => true,
                'is_featured' => false,
            ]
        );
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->integer('perPage', 10);

        $categories = Category::query()
            ->with(['parent', 'image'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%")
                        ->orWhere('meta_title', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate($perPage)
            ->appends($request->query());

        if ($request->ajax()) {
            return view(
                'backend.categories.partials.category-table',
                compact('categories')
            )->render();
        }

        return view('backend.categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::whereNull('parent_id')
            ->with('childrenRecursive')
            ->orderBy('name')
            ->get();

        return view('backend.categories.create', compact('parents'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $media = $this->mediaUploader->upload(
                $request->file('image'),
                'categories'
            );

            $data['media_id'] = $media->id;
        }

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active', true);

        Category::create($data);

        return redirect()
            ->route('backoffice.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return redirect()->route('backoffice.categories.edit', $category);
    }

    public function edit(Category $category)
    {
        $category->load('image');

        $parents = Category::whereNull('parent_id')
            ->with('childrenRecursive')
            ->whereKeyNot($category->id)
            ->orderBy('name')
            ->get();

        return view('backend.categories.edit', compact('category', 'parents'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $media = $this->mediaUploader->upload(
                $request->file('image'),
                'categories'
            );

            $data['media_id'] = $media->id;
        }

        // Preserve the original slug for SEO.
        unset($data['slug']);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        $category->update($data);

        return redirect()
            ->route('backoffice.categories.edit', $category)
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->slug === 'uncategorized') {
            return back()->with(
                'error',
                'Default category cannot be deleted.'
            );
        }

        $default = $this->defaultCategory();

        Product::where('category_id', $category->id)
            ->update([
                'category_id' => $default->id,
            ]);

        $category->delete();

        return redirect()
            ->route('backoffice.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}