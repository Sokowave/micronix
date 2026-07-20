<?php

namespace App\Support\Media;

use App\Models\Media;

class ImageUrl
{
    /**
     * Generate an image URL.
     */
    public static function make(
        ?Media $media,
        ?int $width = null,
        ?int $quality = null
    ): ?string {
        if (! $media || ! $media->isImage()) {
            return null;
        }

        return match ($media->disk) {

            /*
            |--------------------------------------------------------------------------
            | Local Public Disk
            |--------------------------------------------------------------------------
            */

            'public' => self::publicDisk(
                $media,
                $width,
                $quality,
            ),

            /*
            |--------------------------------------------------------------------------
            | CDN / Cloud Storage
            |--------------------------------------------------------------------------
            */

            'imagekit',
            'bunny',
            'cloudflare_r2',
            's3' => $media->file_url,

            default => $media->file_url,
        };
    }

    /**
     * Generate a URL for images stored on the public disk.
     */
    protected static function publicDisk(
        Media $media,
        ?int $width,
        ?int $quality,
    ): string {

        $parameters = [
            'path' => 'uploads/' . ltrim($media->path, '/'),
        ];

        if ($width) {
            $parameters['w'] = $width;
        }

        if ($quality) {
            $parameters['q'] = $quality;
        }

        return route('image', $parameters);
    }
}