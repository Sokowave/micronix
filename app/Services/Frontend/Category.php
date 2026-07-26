<?php

namespace App\Services\Frontend;

use App\Models\Category as CategoryModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class Category
{
    /**
     * Get all active categories.
     */
    public function get(): Collection
    {
        return CategoryModel::query()
            ->with('media')
            ->where('is_active', true)
            ->orderBy('position')
            ->orderBy('name')
            ->get();
    }

    /**
     * Get active parent categories.
     */
    public function parents(): Collection
    {
        return CategoryModel::query()
            ->with('media')
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('position')
            ->orderBy('name')
            ->get();
    }

    /**
     * Get active parent categories with their children.
     */
    public function withChildren(): Collection
    {
        return CategoryModel::query()
            ->with([
                'media',
                'children' => fn ($query) => $query
                    ->where('is_active', true)
                    ->orderBy('position')
                    ->orderBy('name'),
            ])
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('position')
            ->orderBy('name')
            ->get();
    }

    /**
     * Find an active category by slug.
     */
    public function findBySlug(string $slug): CategoryModel
    {
        return CategoryModel::query()
            ->with([
                'media',
                'parent',
                'children' => fn ($query) => $query
                    ->where('is_active', true)
                    ->orderBy('position')
                    ->orderBy('name'),
            ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

    /**
     * Get the category ID and all active descendant category IDs.
     */
    public function idsWithDescendants(CategoryModel $category): array
    {
        $ids = [$category->id];

        $children = CategoryModel::query()
            ->where('parent_id', $category->id)
            ->where('is_active', true)
            ->get(['id']);

        foreach ($children as $child) {
            $ids = array_merge(
                $ids,
                $this->idsWithDescendants($child)
            );
        }

        return $ids;
    }


    public function navigation(?CategoryModel $category): Collection
    {
        if (! $category) {
            return $this->parents();
        }

        return CategoryModel::query()
            ->with('media')
            ->where('parent_id', $category->id)
            ->where('is_active', true)
            ->orderBy('position')
            ->orderBy('name')
            ->get();
    }




}