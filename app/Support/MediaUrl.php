<?php

namespace App\Support;

use App\Models\Media;

class MediaUrl
{
    public static function get(?Media $media): ?string
    {
        if (! $media || ! $media->path) {
            return null;
        }

        return match ($media->disk) {
            'public' => self::fromDisk($media, 'public'),
            's3' => self::fromDisk($media, 's3'),
            'r2' => self::fromDisk($media, 'r2'),
            'bunny' => self::fromDisk($media, 'bunny'),
            'imagekit' => self::fromDisk($media, 'imagekit'),

            default => self::fromDisk($media, $media->disk),
        };
    }

    protected static function fromDisk(Media $media, string $disk): ?string
    {
        $baseUrl = config("filesystems.disks.{$disk}.url");

        if (! $baseUrl) {
            return null;
        }

        return rtrim((string) $baseUrl, '/')
            . '/'
            . ltrim($media->path, '/');
    }
}