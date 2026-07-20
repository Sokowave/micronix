<?php

namespace App\Data;

use App\Models\Category;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class NavigationCategoryData extends Data
{
    /**
     * @param NavigationCategoryData[] $children
     */
    public function __construct(
        public string $public_id,
        public string $name,
        public string $slug,
        public string $url,

        /** @var NavigationCategoryData[] */
        public array $children,
    ) {}

    public static function fromModel(Category $category): self
    {
        return new self(
            public_id: $category->public_id,
            name: $category->name,
            slug: $category->slug,
            url: route('category.show', $category->slug),

            children: $category->childrenRecursive
                ->where('is_active', true)
                ->sortBy('name')
                ->values()
                ->map(
                    fn (Category $child): self => self::fromModel($child)
                )
                ->all(),
        );
    }
}