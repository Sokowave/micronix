<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'media_id',
        'public_id',

        'name',
        'slug',

        'meta_title',
        'meta_description',

        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(fn ($category) => $category->public_id = (string) Str::uuid());
    }


    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            Category::class,
            'parent_id'
        );
    }

    public function children(): HasMany
    {
        return $this->hasMany(
            Category::class,
            'parent_id'
        );
    }

    public function childrenRecursive(): HasMany
    {
        return $this->children()
            ->with('childrenRecursive');
    }

    public function childrenRecursiveWithCount()
    {
        return $this->children()
            ->withCount('publishedProducts')
            ->with('childrenRecursiveWithCount');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(
            Media::class,
            'media_id'
        );
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function publishedProducts(): HasMany
    {
        return $this->hasMany(Product::class)
            ->where('status', 'published');
    }

    public function banners(): HasMany
    {
        return $this->hasMany(Banner::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeLeaf($query)
    {
        return $query->whereDoesntHave('children');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function isRoot(): bool
    {
        return is_null($this->parent_id);
    }

    public function isLeaf(): bool
    {
        return ! $this->children()->exists();
    }

    public function getBreadcrumbs()
    {
        $breadcrumbs = collect();

        $category = $this;

        while ($category) {
            $breadcrumbs->prepend($category);
            $category = $category->parent;
        }

        return $breadcrumbs;
    }


    public function descendantIds(): array
    {
        $ids = collect([$this->id]);

        foreach ($this->children as $child) {
            $ids = $ids->merge($child->descendantIds());
        }

        return $ids->unique()->values()->all();
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getBreadcrumbs()
                ->pluck('name')
                ->implode(' > ')
        );
    }
}