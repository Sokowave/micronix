<?php

namespace App\Services\Media\Drivers;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Spatie\ImageOptimizer\OptimizerChainFactory;

use App\Services\Media\Contracts\MediaDiskInterface;

class PublicDiskService implements MediaDiskInterface
{
    public function upload(
        UploadedFile $file,
        string $folder
    ): array {

        /*
        |--------------------------------------------------------------------------
        | Validate Upload
        |--------------------------------------------------------------------------
        */

        if (!$file->isValid()) {

            throw new Exception(
                'Invalid uploaded file.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Normalize Folder
        |--------------------------------------------------------------------------
        */

        $folder = trim($folder, '/');
        $folder .= '/' . now()->format('Ym');

        /*
        |--------------------------------------------------------------------------
        | File Information
        |--------------------------------------------------------------------------
        */

        $originalName = $file->getClientOriginalName();

        $extension = strtolower(
            $file->getClientOriginalExtension()
        );

        $nameWithoutExtension = pathinfo(
            $originalName,
            PATHINFO_FILENAME
        );

        /*
        |--------------------------------------------------------------------------
        | Safe SEO Filename
        |--------------------------------------------------------------------------
        */

        $slug = Str::limit(
            Str::slug($nameWithoutExtension),
            8,
            ''
        );

        if (empty($slug)) {

            $slug = 'file';
        }

        $random = strtolower(
            (string) Str::ulid()
        );

        /*
        |--------------------------------------------------------------------------
        | Preserve Original Extension
        |--------------------------------------------------------------------------
        */

        $filename =
            "{$slug}-{$random}.{$extension}";

        $path =
            "{$folder}/{$filename}";

        /*
        |--------------------------------------------------------------------------
        | Store File
        |--------------------------------------------------------------------------
        */

        Storage::disk('public')->putFileAs(
            $folder,
            $file,
            $filename
        );

        /*
        |--------------------------------------------------------------------------
        | Optimize Image
        |--------------------------------------------------------------------------
        */

        $absolutePath = Storage::disk('public')
            ->path($path);

        $mimeType = $file->getMimeType();

        if (
            file_exists($absolutePath) &&
            str_starts_with($mimeType, 'image/') &&
            $extension !== 'svg'
        ) {

            $optimizerChain =
                OptimizerChainFactory::create();

            $optimizerChain->optimize(
                $absolutePath
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Return Media Payload
        |--------------------------------------------------------------------------
        */

        return [

            'disk' => 'public',

            'folder' => $folder,

            'filename' => $filename,

            'original_name' => $originalName,

            'path' => $path,

            'url' => Storage::disk('public')
                ->url($path),

            'provider_file_id' => null,

            'provider_metadata' => null,

            'mime_type' => $mimeType,

            'size' => Storage::disk('public')
                ->size($path),

            'hash' => hash_file(
                'sha256',
                $absolutePath
            ),
        ];
    }
}