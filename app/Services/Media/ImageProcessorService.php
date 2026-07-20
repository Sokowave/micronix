<?php

namespace App\Services\Media;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Encoders\WebpEncoder;
use InvalidArgumentException;
use RuntimeException;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class ImageProcessorService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(
            new Driver()
        );
    }

    /**
     * Process an uploaded image.
     */
    public function process(
        UploadedFile $file,
        string $profile = 'products'
    ): UploadedFile {

        $config = config("media.profiles.{$profile}");

        if (! $config) {
            throw new InvalidArgumentException(
                "Media profile [{$profile}] does not exist."
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Skip unsupported images
        |--------------------------------------------------------------------------
        */

        if (! $this->shouldProcess($file)) {
            return $file;
        }

        /*
        |--------------------------------------------------------------------------
        | Temp directory
        |--------------------------------------------------------------------------
        */

        $directory = config(
            'media.temporary_directory',
            storage_path('app/temp/media')
        );

        if (! File::exists($directory)) {
            File::makeDirectory(
                $directory,
                0755,
                true
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Output path
        |--------------------------------------------------------------------------
        */

        $format = strtolower(
            $config['format']
            ?? config('media.default_format', 'webp')
        );

        $outputPath = $directory
            . DIRECTORY_SEPARATOR
            . uniqid('media_', true)
            . '.'
            . $format;

        /*
        |--------------------------------------------------------------------------
        | Read image
        |--------------------------------------------------------------------------
        */

        $image = $this->manager->decodePath(
            $file->getRealPath()
        );

        /*
        |--------------------------------------------------------------------------
        | Resize (optional)
        |--------------------------------------------------------------------------
        */

        $width = $config['width'] ?? null;
        $height = $config['height'] ?? null;
        $fit = $config['fit'] ?? null;

        if ($width && $height && $fit) {

            switch ($fit) {

                case 'cover':

                    if ($config['upscale']) {
                        $image->cover($width, $height);
                    } else {
                        $image->coverDown($width, $height);
                    }

                    break;

                case 'stretch':

                    if ($config['upscale']) {
                        $image->resize($width, $height);
                    } else {
                        $image->resizeDown($width, $height);
                    }

                    break;

                default:

                    if ($config['upscale']) {

                        $image->contain(
                            $width,
                            $height,
                            $config['background'] ?? '#ffffff'
                        );

                    } else {

                        $image->containDown(
                            $width,
                            $height,
                            $config['background'] ?? '#ffffff'
                        );

                    }

                    break;
            }

        }

        /*
        |--------------------------------------------------------------------------
        | Encode
        |--------------------------------------------------------------------------
        */

        switch ($format) {

            case 'webp':

                $image->save(
                    $outputPath,
                    encoder: new WebpEncoder(
                        quality: $config['quality']
                    )
                );

                break;

            default:

                $image->save($outputPath);
        }

        if (! File::exists($outputPath)) {
            throw new RuntimeException(
                'Unable to process uploaded image.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Optimize
        |--------------------------------------------------------------------------
        */

        if (
            $config['optimize']
            ?? config('media.optimize', true)
        ) {
            OptimizerChainFactory::create()
                ->optimize($outputPath);
        }

        /*
        |--------------------------------------------------------------------------
        | Return UploadedFile
        |--------------------------------------------------------------------------
        */

        return new UploadedFile(
            $outputPath,
            pathinfo(
                $file->getClientOriginalName(),
                PATHINFO_FILENAME
            ) . '.' . $format,
            mime_content_type($outputPath),
            UPLOAD_ERR_OK,
            true
        );
    }

    /**
     * Determine whether image should be processed.
     */
    protected function shouldProcess(
        UploadedFile $file
    ): bool {

        return ! in_array(
            strtolower($file->getClientOriginalExtension()),
            config('media.excluded_extensions', []),
            true
        );
    }
}