<?php

namespace App\Services\Media\Drivers;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Services\Media\Contracts\MediaDiskInterface;

class CloudflareR2Service implements MediaDiskInterface
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
        | Dynamic R2 Disk
        |--------------------------------------------------------------------------
        */

        $disk = Storage::build([

            'driver' => 's3',

            'key' => setting(
                'cloudflare_r2_key'
            ),

            'secret' => setting(
                'cloudflare_r2_secret'
            ),

            'region' => 'auto',

            'bucket' => setting(
                'cloudflare_r2_bucket'
            ),

            'endpoint' => setting(
                'cloudflare_r2_endpoint'
            ),

            'url' => setting(
                'cloudflare_r2_url'
            ),

            'use_path_style_endpoint' => true,
        ]);

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

        $filename =
            $slug
            . '-'
            . strtolower(
                (string) Str::ulid()
            )
            . '.'
            . $extension;

        /*
        |--------------------------------------------------------------------------
        | Root Namespace
        |--------------------------------------------------------------------------
        */

        $root = trim(
            setting(
                'cloudflare_r2_root_folder',
                'kasiodc'
            ),
            '/'
        );

        $path =
            "{$root}/{$folder}/{$filename}";

        /*
        |--------------------------------------------------------------------------
        | Upload File
        |--------------------------------------------------------------------------
        */

        $stream = fopen(
            $file->getRealPath(),
            'r'
        );

        $uploaded = $disk->put(
            $path,
            $stream,
            'public'
        );

        if (is_resource($stream)) {

            fclose($stream);
        }

        /*
        |--------------------------------------------------------------------------
        | Validate Upload
        |--------------------------------------------------------------------------
        */

        if (!$uploaded) {

            throw new Exception(
                'Failed to upload file to Cloudflare R2.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | File URL
        |--------------------------------------------------------------------------
        */

        $url = rtrim(
            setting('cloudflare_r2_url'),
            '/'
        ) . '/' . ltrim(
            $path,
            '/'
        );

        /*
        |--------------------------------------------------------------------------
        | Provider Metadata
        |--------------------------------------------------------------------------
        */

        $metadata = [

            'bucket' => setting(
                'cloudflare_r2_bucket'
            ),

            'endpoint' => setting(
                'cloudflare_r2_endpoint'
            ),

            'visibility' => 'public',
        ];

        /*
        |--------------------------------------------------------------------------
        | Return Payload
        |--------------------------------------------------------------------------
        */

        return [

            'disk' => 'cloudflare_r2',

            'folder' => $folder,

            'filename' => $filename,

            'original_name' => $originalName,

            'path' => $path,

            'url' => $url,

            'provider_file_id' => $path,

            'provider_metadata' => $metadata,

            'mime_type' => $file->getMimeType(),

            'size' => $file->getSize(),

            'hash' => hash_file(
                'sha256',
                $file->getRealPath()
            ),
        ];
    }
}