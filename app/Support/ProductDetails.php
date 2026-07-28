<?php

namespace App\Support;

use App\Models\Media;
use App\Models\Product;

class ProductDetails
{
    public function __construct(
        protected Product $product
    ) {}

    /**
     * Get the effective selling price.
     */
    public function currentPrice(): float
    {
        if ($this->hasDiscount()) {
            return (float) $this->product->sale_price;
        }

        return (float) $this->product->price;
    }

    /**
     * Determine whether the product has a valid discount.
     */
    public function hasDiscount(): bool
    {
        return $this->product->sale_price !== null
            && (float) $this->product->sale_price > 0
            && (float) $this->product->sale_price < (float) $this->product->price;
    }

    /**
     * Get the amount saved.
     */
    public function discountAmount(): float
    {
        if (! $this->hasDiscount()) {
            return 0.0;
        }

        return round(
            (float) $this->product->price - (float) $this->product->sale_price,
            2
        );
    }

    /**
     * Get the discount percentage.
     */
    public function discountPercentage(): int
    {
        if (! $this->hasDiscount() || (float) $this->product->price <= 0) {
            return 0;
        }

        return (int) round(
            ($this->discountAmount() / (float) $this->product->price) * 100
        );
    }

    /**
     * Determine whether the product is in stock.
     */
    public function inStock(): bool
    {
        return $this->product->stock_quantity > 0;
    }

    /**
     * Determine whether the product is out of stock.
     */
    public function outOfStock(): bool
    {
        return ! $this->inStock();
    }

    /**
     * Determine whether stock is running low.
     */
    public function lowStock(int $threshold = 5): bool
    {
        return $this->product->stock_quantity > 0
            && $this->product->stock_quantity <= $threshold;
    }

    /**
     * Get the stock status.
     */
    public function stockStatus(): string
    {
        if ($this->outOfStock()) {
            return 'out_of_stock';
        }

        if ($this->lowStock()) {
            return 'low_stock';
        }

        return 'in_stock';
    }

    /**
     * Get the stock status label.
     */
    public function stockLabel(): string
    {
        return match ($this->stockStatus()) {
            'out_of_stock' => 'Out of stock',
            'low_stock' => 'Only '.$this->product->stock_quantity.' left',
            default => 'In stock',
        };
    }

    /**
     * Determine whether the product has a warranty.
     */
    public function hasWarranty(): bool
    {
        return $this->product->warranty !== null
            && $this->product->warranty > 0;
    }

    /**
     * Get the warranty label.
     */
    public function warrantyLabel(): ?string
    {
        if (! $this->hasWarranty()) {
            return null;
        }

        $months = (int) $this->product->warranty;

        return $months === 1
            ? '1 month warranty'
            : "{$months} months warranty";
    }

    public function brandUrl(): string
    {
        return route('categories.show', [
            'category' => $this->product->category,
            'brand' => [$this->product->brand->slug],
        ]);
    }

    /**
     * Get the primary media item.
     */
    public function primaryMedia(): ?Media
    {
        if ($this->product->relationLoaded('primaryMedia')) {
            return $this->product->primaryMedia->first();
        }

        if ($this->product->relationLoaded('media')) {
            return $this->product->media->firstWhere(
                'pivot.is_primary',
                true
            ) ?? $this->product->media->first();
        }

        return $this->product->primaryMedia()->first()
            ?? $this->product->media()->first();
    }
}