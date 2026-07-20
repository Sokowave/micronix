<?php

namespace App\Models;

use App\Support\Media\ImageUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'public_id',
        'disk',
        'folder',
        'path',
        'url',
        'provider_file_id',
        'uploaded_by',
    ];

    protected $appends = [
        'file_url',
    ];

    /*
    |--------------------------------------------------------------------------
    | Boot
    |--------------------------------------------------------------------------
    */

    protected static function booted(): void
    {
        static::creating(function (Media $media) {
            if (blank($media->public_id)) {
                $media->public_id = (string) Str::ulid();
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_images',
            'media_id',
            'product_id'
        )->withPivot('sort_order')
         ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFileUrlAttribute(): ?string
    {
        return $this->getUrl();
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function imageUrl(
        ?int $width = null,
        ?int $quality = null,
    ): ?string {
        return ImageUrl::make($this, $width, $quality);
    }

    public function getUrl(): ?string
    {
        if (blank($this->path) && blank($this->url)) {
            return null;
        }

        // Explicit URL
        if (filled($this->url)) {
            return $this->url;
        }

        // External URL stored in path
        if (
            str_starts_with($this->path, 'http://') ||
            str_starts_with($this->path, 'https://')
        ) {
            return $this->path;
        }

        return match ($this->disk) {
            'imagekit' => rtrim(setting('imagekit_url_endpoint'), '/') . '/' . ltrim($this->path, '/'),

            'cloudflare_r2' => rtrim(setting('cloudflare_r2_url'), '/') . '/' . ltrim($this->path, '/'),

            'bunny' => rtrim(setting('bunny_url'), '/') . '/' . ltrim($this->path, '/'),

            'aws_s3' => rtrim(setting('aws_s3_url'), '/') . '/' . ltrim($this->path, '/'),

            default => Storage::disk(
                array_key_exists($this->disk, config('filesystems.disks'))
                    ? $this->disk
                    : 'public'
            )->url($this->path),
        };
    }
}