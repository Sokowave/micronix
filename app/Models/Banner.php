<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',

        'title',

        'media_id',

        'target_type',
        'target_id',
        'custom_url',

        'priority',

        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeLocation($query, string $location)
    {
        return $query->where('location', $location);
    }

    public function scopeOrdered($query)
    {
        return $query
            ->orderByDesc('priority')
            ->orderByDesc('id');
    }

    public function getUrlAttribute(): string
    {
        return match ($this->target_type) {

            'product' => Product::find($this->target_id)?->url
                ?? url('/'),

            'category' => ($category = Category::find($this->target_id))
                ? route('category.show', $category->slug)
                : url('/'),

            'brand' => ($brand = Brand::find($this->target_id))
                ? route('brand.show', $brand->slug)
                : url('/'),

            'custom' => $this->custom_url ?: url('/'),

            default => url('/'),
        };
    }
}