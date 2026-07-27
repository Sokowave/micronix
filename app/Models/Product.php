<?php

namespace App\Models;

use App\Support\ProductDetails;
use App\Support\ProductIdentifiers;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable([
    'category_id',
    'brand_id',
    'name',
    'price',
    'sale_price',
    'stock_quantity',
    'condition',
    'warranty',
    'short_description',
    'description',
    'meta_title',
    'meta_description',
    'is_featured',
    'is_active',
])]
class Product extends Model
{
    use HasUuids;

    public function uniqueIds(): array
    {
        return ['public_id'];
    }

    protected static function booted(): void
    {
        static::creating(function (Product $product): void {
            $product->sku ??= ProductIdentifiers::sku();
            $product->slug ??= ProductIdentifiers::slug($product->name);
        });
    }

    public function details(): ProductDetails
    {
        return new ProductDetails($this);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function collections(): BelongsToMany
    {
        return $this->belongsToMany(
            Collection::class,
            'collection_product'
        )
            ->withPivot('position')
            ->withTimestamps()
            ->orderByPivot('position');
    }

    public function deals(): BelongsToMany
    {
        return $this->belongsToMany(
            Deal::class,
            'deal_product'
        )
            ->withPivot('position')
            ->withTimestamps()
            ->orderByPivot('position');
    }

    public function media(): BelongsToMany
    {
        return $this->belongsToMany(Media::class, 'product_media')
            ->withPivot([
                'is_primary',
                'position',
            ])
            ->withTimestamps()
            ->orderByPivot('position');
    }

    public function primaryMedia(): BelongsToMany
    {
        return $this->belongsToMany(Media::class, 'product_media')
            ->withPivot([
                'is_primary',
                'position',
            ])
            ->wherePivot('is_primary', true)
            ->withTimestamps();
    }

    public function specifications(): BelongsToMany
    {
        return $this->belongsToMany(
            Specification::class,
            'product_specifications'
        )->withPivot('value');
    }

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'sale_price' => 'decimal:2',
            'stock_quantity' => 'integer',
            'warranty' => 'integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }
    
}