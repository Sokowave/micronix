<?php

namespace App\Services\Media\Drivers;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

use App\Services\Media\Contracts\MediaDiskInterface;

class BunnyStorageService implements MediaDiskInterface
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

        /*
        |--------------------------------------------------------------------------
        | SEO Filename
        |--------------------------------------------------------------------------
        */

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
                'bunny_storage_root_folder',
                'kasiodc'
            ),
            '/'
        );

        $path =
            "{$root}/{$folder}/{$filename}";

        /*
        |--------------------------------------------------------------------------
        | Bunny Configuration
        |--------------------------------------------------------------------------
        */

        $storageZone = setting(
            'bunny_storage_zone'
        );

        $apiKey = setting(
            'bunny_storage_api_key'
        );

        $region = setting(
            'bunny_storage_region',
            'de'
        );

        /*
        |--------------------------------------------------------------------------
        | CDN URL
        |--------------------------------------------------------------------------
        */

        $cdnUrl = rtrim(
            setting('bunny_url'),
            '/'
        );

        /*
        |--------------------------------------------------------------------------
        | Storage Endpoint
        |--------------------------------------------------------------------------
        */

        $endpoint =
            "https://{$region}.storage.bunnycdn.com"
            . "/{$storageZone}/{$path}";

        /*
        |--------------------------------------------------------------------------
        | Upload File
        |--------------------------------------------------------------------------
        */

        $stream = fopen(
            $file->getRealPath(),
            'r'
        );

        $response = Http::withHeaders([

            'AccessKey' => $apiKey,

            'Content-Type' => $file->getMimeType(),

        ])->withBody(

            $stream,

            $file->getMimeType()

        )->put($endpoint);

        if (is_resource($stream)) {

            fclose($stream);
        }

        /*
        |--------------------------------------------------------------------------
        | Validate Upload
        |--------------------------------------------------------------------------
        */

        if (!$response->successful()) {

            throw new Exception(
                'Failed to upload file to Bunny Storage. '
                . $response->body()
            );
        }

        /*
        |--------------------------------------------------------------------------
        | File URL
        |--------------------------------------------------------------------------
        */

        $url =
            $cdnUrl
            . '/'
            . ltrim($path, '/');

        /*
        |--------------------------------------------------------------------------
        | Provider Metadata
        |--------------------------------------------------------------------------
        */

        $metadata = [

            'storage_zone' => $storageZone,

            'region' => $region,

            'endpoint' => $endpoint,

            'visibility' => 'public',
        ];

        /*
        |--------------------------------------------------------------------------
        | Return Media Payload
        |--------------------------------------------------------------------------
        */

        return [

            'disk' => 'bunny',

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