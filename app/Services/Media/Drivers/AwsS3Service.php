<?php

namespace App\Services\Media\Drivers;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Services\Media\Contracts\MediaDiskInterface;

class AwsS3Service implements MediaDiskInterface
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
        | Dynamic S3 Disk
        |--------------------------------------------------------------------------
        */

        $disk = Storage::build([

            'driver' => 's3',

            'key' => setting(
                'aws_s3_key'
            ),

            'secret' => setting(
                'aws_s3_secret'
            ),

            'region' => setting(
                'aws_s3_region'
            ),

            'bucket' => setting(
                'aws_s3_bucket'
            ),

            'url' => setting(
                'aws_s3_url'
            ),

            'use_path_style_endpoint' => false,
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
                'aws_s3_root_folder',
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
                'Failed to upload file to AWS S3.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | File URL
        |--------------------------------------------------------------------------
        */

        $url = rtrim(
            setting('aws_s3_url'),
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
                'aws_s3_bucket'
            ),

            'region' => setting(
                'aws_s3_region'
            ),

            'visibility' => 'public',
        ];

        /*
        |--------------------------------------------------------------------------
        | Return Media Payload
        |--------------------------------------------------------------------------
        */

        return [

            'disk' => 'aws_s3',

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