<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_PUBLISHED = 'published';

    protected $fillable = [
        'public_id',
        'category_id',
        'brand_id',
        'title',
        'slug',
        'short_description',
        'description',
        'specifications',
        'sku',
        'stock',
        'condition',
        'color',
        'model',
        'warranty',
        'price',
        'sale_price',
        'sale_starts_at',
        'sale_ends_at',
        'featured',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'specifications' => 'array',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'sale_starts_at' => 'datetime',
        'sale_ends_at' => 'datetime',
        'published_at' => 'datetime',
        'stock' => 'integer',
        'warranty' => 'integer',
        'featured' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Product $product) {

            $product->public_id ??= (string) Str::uuid();
            $product->sku ??= 'KSDC-' . strtoupper(Str::random(10));
            $product->slug ??= Str::slug($product->title)
                . '-'
                . strtolower(Str::random(13));
        });
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }


    public function productImages()
    {
        return $this->hasMany(ProductImage::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function images()
    {
        return $this->belongsToMany(Media::class, 'product_images')
            ->withPivot('sort_order')
            ->withTimestamps()
            ->orderByPivot('sort_order');
    }

    public function mainImage()
    {
        return $this->hasOne(ProductImage::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function getPrimaryImageAttribute(): ?Media
    {
        return $this->mainImage?->media;
    }

    public function getCurrentPriceAttribute(): float
    {
        return $this->has_discount
            ? (float) $this->sale_price
            : (float) $this->price;
    }

    public function getHasDiscountAttribute(): bool
    {
        if (! $this->sale_price) {
            return false;
        }

        $now = now();

        return
            (! $this->sale_starts_at || $this->sale_starts_at <= $now) &&
            (! $this->sale_ends_at || $this->sale_ends_at >= $now) &&
            $this->sale_price < $this->price;
    }

    public function getDiscountAmountAttribute(): float
    {
        return $this->has_discount
            ? round($this->price - $this->sale_price)
            : 0;
    }

    public function getDiscountPercentageAttribute(): ?int
    {
        return $this->has_discount
            ? (int) round((($this->price - $this->sale_price) / $this->price) * 100)
            : null;
    }

    public function getFormattedPriceAttribute(): string
    {
        return (site_currency() ?? 'KSh') . ' ' . number_format($this->current_price);
    }

    public function getFormattedOriginalPriceAttribute(): string
    {
        return (site_currency() ?? 'KSh') . ' ' . number_format($this->price);
    }

    public function getSavingsAttribute(): float
    {
        return $this->has_discount
            ? (float) ($this->price - $this->sale_price)
            : 0;
    }

    public function getFormattedSavingsAttribute(): string
    {
        return (site_currency() ?? 'KSh') . ' ' . number_format($this->savings);
    }

    public function getUrlAttribute(): string
    {
        return route('product.show', $this);
    }

    protected function specificationsList(): Attribute
    {
        return Attribute::make(
            get: fn () => collect($this->specifications ?? [])
                ->filter(fn ($spec) => filled($spec['name'] ?? null) && filled($spec['value'] ?? null))
                ->values()
                ->all(),
        );
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if (blank($search)) {
            return $query;
        }

        return $query->where(function (Builder $query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhereHas('tags', function (Builder $query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });
        });
    }

    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeDraft($query)
    {
        return $query->where('status', self::STATUS_DRAFT);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}