<?php

namespace App\Models;

use App\Support\MediaUrl;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'file_name',
    'path',
    'disk',
    'file_id',
])]
class Media extends Model
{
    /**
     * Get the public URL for the media file.
     */
    protected function url(): Attribute
    {
        return Attribute::get(
            fn (): ?string => MediaUrl::get($this)
        );
    }
}