<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    /**
     * Fixed page slugs.
     */
    public const PRIVACY_POLICY = 'privacy-policy';
    public const TERMS_CONDITIONS = 'terms-and-conditions';
    public const SHIPPING_POLICY = 'shipping-policy';
    public const RETURNS_REFUNDS = 'returns-refunds';
    public const WARRANTY_INFORMATION = 'warranty-information';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'seo_title',
        'seo_description',
        'is_published',
    ];

    /**
     * Attribute casting.
     */
    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    /**
     * Automatically generate a slug.
     */
    protected static function booted(): void
    {
        static::creating(function (Page $page) {
            if (blank($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });

        static::updating(function (Page $page) {
            if ($page->isDirty('title') && blank($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    /**
     * Published pages scope.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    /**
     * Route model binding by slug.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get all supported page slugs.
     */
    public static function slugs(): array
    {
        return [
            self::PRIVACY_POLICY,
            self::TERMS_CONDITIONS,
            self::SHIPPING_POLICY,
            self::RETURNS_REFUNDS,
            self::WARRANTY_INFORMATION,
        ];
    }
}