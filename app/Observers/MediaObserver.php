<?php

namespace App\Observers;

use App\Models\Media;
use Illuminate\Support\Facades\File;

class MediaObserver
{
    /**
     * Handle media creation.
     */
    public function created(Media $media): void
    {
        $this->mirror($media);
    }

    /**
     * Handle media updates.
     */
    public function updated(Media $media): void
    {
        if (
            ! $media->wasChanged([
                'path',
                'disk',
            ])
        ) {
            return;
        }

        $this->mirror($media);
    }

    /**
     * Handle media deletion.
     */
    public function deleted(Media $media): void
    {
        if (! $this->shouldMirror($media)) {
            return;
        }

        File::delete(
            $this->publicPath($media->path)
        );
    }

    /**
     * Copy local storage file to public/storage.
     */
    protected function mirror(Media $media): void
    {
        if (! $this->shouldMirror($media)) {
            return;
        }

        $source = $this->storagePath(
            $media->path
        );

        if (! File::exists($source)) {
            return;
        }

        $destination = $this->publicPath(
            $media->path
        );

        File::ensureDirectoryExists(
            dirname($destination)
        );

        /*
        |--------------------------------------------------------------------------
        | Skip identical files
        |--------------------------------------------------------------------------
        */
        if (
            File::exists($destination)
            && md5_file($source) === md5_file($destination)
        ) {
            return;
        }

        File::copy(
            $source,
            $destination
        );
    }

    /**
     * Determine if media should be mirrored.
     */
    protected function shouldMirror(
        Media $media
    ): bool {
        return $media->disk === 'local'
            && filled($media->path);
    }

    /**
     * Storage file path.
     */
    protected function storagePath(
        string $path
    ): string {
        return storage_path(
            'app/public/' . ltrim($path, '/')
        );
    }

    /**
     * Public mirrored file path.
     */
    protected function publicPath(
        string $path
    ): string {
        return public_path(
            'storage/' . ltrim($path, '/')
        );
    }
}