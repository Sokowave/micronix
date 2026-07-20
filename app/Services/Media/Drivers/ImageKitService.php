<?php

namespace App\Services\Media\Drivers;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

use ImageKit\ImageKit;

use App\Services\Media\Contracts\MediaDiskInterface;

class ImageKitService implements MediaDiskInterface
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
                'imagekit_root_folder',
                'kasiodc'
            ),
            '/'
        );

        $fullFolder =
            "{$root}/{$folder}";

        /*
        |--------------------------------------------------------------------------
        | ImageKit Instance
        |--------------------------------------------------------------------------
        */

        $imageKit = new ImageKit(

            setting('imagekit_public_key'),

            setting('imagekit_private_key'),

            setting('imagekit_url_endpoint')
        );

        /*
        |--------------------------------------------------------------------------
        | Upload File
        |--------------------------------------------------------------------------
        */

        $upload = $imageKit->upload([

            'file' => fopen(
                $file->getRealPath(),
                'r'
            ),

            'fileName' => $filename,

            'folder' => "/{$fullFolder}",
        ]);

        /*
        |--------------------------------------------------------------------------
        | Validate Upload Response
        |--------------------------------------------------------------------------
        */

        if (
            empty($upload)
            || empty($upload->result)
            || empty($upload->result->url)
        ) {

            throw new Exception(
                'Failed to upload file to ImageKit.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Extract Relative Path
        |--------------------------------------------------------------------------
        */

        $path = ltrim(
            parse_url(
                $upload->result->url,
                PHP_URL_PATH
            ),
            '/'
        );

        /*
        |--------------------------------------------------------------------------
        | Remove Endpoint Namespace
        |--------------------------------------------------------------------------
        */

        $endpointPath = trim(
            parse_url(
                setting('imagekit_url_endpoint'),
                PHP_URL_PATH
            ),
            '/'
        );

        if (
            !empty($endpointPath)
            && str_starts_with(
                $path,
                $endpointPath . '/'
            )
        ) {

            $path = substr(
                $path,
                strlen($endpointPath) + 1
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Provider Metadata
        |--------------------------------------------------------------------------
        */

        $metadata = [

            'file_id' => $upload->result->fileId ?? null,

            'name' => $upload->result->name ?? null,

            'file_path' => $upload->result->filePath ?? null,

            'thumbnail_url' => $upload->result->thumbnailUrl ?? null,

            'height' => $upload->result->height ?? null,

            'width' => $upload->result->width ?? null,

            'size' => $upload->result->size ?? null,

            'file_type' => $upload->result->fileType ?? null,
        ];

        /*
        |--------------------------------------------------------------------------
        | Return Media Payload
        |--------------------------------------------------------------------------
        */

        return [

            'disk' => 'imagekit',

            'folder' => $folder,

            'filename' => $filename,

            'original_name' => $originalName,

            'path' => $path,

            'url' => $upload->result->url,

            'provider_file_id' => $upload->result->fileId ?? null,

            'provider_metadata' => $metadata,

            'mime_type' => $file->getMimeType(),

            'size' => $upload->result->size
                ?? $file->getSize(),

            'hash' => hash_file(
                'sha256',
                $file->getRealPath()
            ),
        ];
    }
}