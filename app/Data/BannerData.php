<?php

namespace App\Data;

use App\Models\Banner;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class BannerData extends Data
{
    public function __construct(
        public int $id,

        public string $title,

        public ?MediaData $media,

        public string $url,

        public string $location,

        public int $priority,
    ) {}

    public static function fromModel(Banner $banner): self
    {
        return new self(
            id: $banner->id,

            title: $banner->title ?? '',

            media: $banner->media
                ? MediaData::from($banner->media)
                : null,

            url: $banner->url,

            location: $banner->location,

            priority: $banner->priority,
        );
    }
}