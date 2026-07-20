<?php

namespace App\Services\Media;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Services\Media\Drivers\AwsS3Service;
use App\Services\Media\Drivers\BunnyStorageService;
use App\Services\Media\Drivers\CloudflareR2Service;
use App\Services\Media\Drivers\ImageKitService;
use App\Services\Media\Drivers\PublicDiskService;

class MediaUploaderService
{
    public function __construct(
        protected ImageProcessorService $imageProcessor,
    ) {
    }

    /**
     * Upload media.
     */
    public function upload(
        UploadedFile $file,
        string $folder = 'general'
    ): Media {

        /*
        |--------------------------------------------------------------------------
        | Validate Upload
        |--------------------------------------------------------------------------
        */

        if (! $file->isValid()) {

            throw ValidationException::withMessages([
                'image' => 'Invalid uploaded file.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Resolve Processing Profile
        |--------------------------------------------------------------------------
        */

        $profile = explode('/', trim($folder, '/'))[0];

        /*
        |--------------------------------------------------------------------------
        | Process Image
        |--------------------------------------------------------------------------
        */

        $originalPath = $file->getRealPath();

        $file = $this->imageProcessor->process(
            $file,
            $profile
        );

        $processedPath = $file->getRealPath();

        /*
        |--------------------------------------------------------------------------
        | Active Storage Driver
        |--------------------------------------------------------------------------
        */

        $driver = setting(
            'storage_driver',
            'public'
        );

        /*
        |--------------------------------------------------------------------------
        | Calculate File Hash
        |--------------------------------------------------------------------------
        */

        $hash = hash_file(
            'sha256',
            $processedPath
        );

        /*
        |--------------------------------------------------------------------------
        | Reuse Existing Media
        |--------------------------------------------------------------------------
        */

        $existing = Media::where(
            'hash',
            $hash
        )->first();

        if ($existing) {

            if (
                $processedPath &&
                $processedPath !== $originalPath &&
                file_exists($processedPath)
            ) {
                @unlink($processedPath);
            }

            return $existing;
        }

        /*
        |--------------------------------------------------------------------------
        | Resolve Storage Driver
        |--------------------------------------------------------------------------
        */

        $service = match ($driver) {

            'imagekit' => app(ImageKitService::class),

            'cloudflare_r2' => app(CloudflareR2Service::class),

            'bunny' => app(BunnyStorageService::class),

            'aws_s3' => app(AwsS3Service::class),

            default => app(PublicDiskService::class),

        };

        /*
        |--------------------------------------------------------------------------
        | Upload File
        |--------------------------------------------------------------------------
        */

        $data = $service->upload(
            $file,
            $folder
        );

        /*
        |--------------------------------------------------------------------------
        | Remove Temporary Processed File
        |--------------------------------------------------------------------------
        */

        if (
            $processedPath &&
            $processedPath !== $originalPath &&
            file_exists($processedPath)
        ) {
            @unlink($processedPath);
        }

        /*
        |--------------------------------------------------------------------------
        | Complete Media Payload
        |--------------------------------------------------------------------------
        */

        $data['hash'] = $hash;

        $data['uploaded_by'] = Auth::id();

        /*
        |--------------------------------------------------------------------------
        | Create Media Record
        |--------------------------------------------------------------------------
        */

        return Media::create($data);
    }
}