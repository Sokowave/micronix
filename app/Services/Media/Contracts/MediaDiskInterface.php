<?php

namespace App\Services\Media\Contracts;

use Illuminate\Http\UploadedFile;

interface MediaDiskInterface
{
    public function upload(
        UploadedFile $file,
        string $folder
    ): array;
}