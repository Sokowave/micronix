<?php

namespace App\Services\Frontend;

use App\Models\SeoLandingPage as SeoLandingPageModel;
use App\Services\Frontend\Product\Index as ProductIndex;
use Illuminate\Database\Eloquent\Builder;

class SeoLandingPage
{
    public function __construct(
        private readonly ProductIndex $products,
    ) {}

    public function query(SeoLandingPageModel $landingPage): Builder
    {
        $filters = $landingPage->filters ?? [];

        $query = $this->products->query(
            $filters['category_ids'] ?? [],
        );

        $this->applyBrands($query, $filters);
        $this->applyPrice($query, $filters);
        $this->applyConditions($query, $filters);
        $this->applySpecifications($query, $filters);

        return $query;
    }

    private function applyBrands(Builder $query, array $filters): void
    {
        if (empty($filters['brand_ids'])) {
            return;
        }

        $query->whereIn('brand_id', $filters['brand_ids']);
    }

    private function applyPrice(Builder $query, array $filters): void
    {
        $price = $filters['price'] ?? [];

        if (empty($price)) {
            return;
        }

        $currentPrice = <<<'SQL'
            CASE
                WHEN sale_price IS NOT NULL
                    AND sale_price > 0
                    AND sale_price < price
                THEN sale_price
                ELSE price
            END
        SQL;

        if (isset($price['gt'])) {
            $query->whereRaw(
                "($currentPrice) > ?",
                [$price['gt']]
            );
        }

        if (isset($price['gte'])) {
            $query->whereRaw(
                "($currentPrice) >= ?",
                [$price['gte']]
            );
        }

        if (isset($price['lt'])) {
            $query->whereRaw(
                "($currentPrice) < ?",
                [$price['lt']]
            );
        }

        if (isset($price['lte'])) {
            $query->whereRaw(
                "($currentPrice) <= ?",
                [$price['lte']]
            );
        }
    }

    private function applyConditions(Builder $query, array $filters): void
    {
        if (empty($filters['conditions'])) {
            return;
        }

        $query->whereIn('condition', $filters['conditions']);
    }

    private function applySpecifications(
        Builder $query,
        array $filters,
    ): void {
        if (empty($filters['specifications'])) {
            return;
        }

        foreach ($filters['specifications'] as $specificationId => $values) {
            $query->whereHas(
                'specifications',
                function (Builder $query) use ($specificationId, $values): void {
                    $query
                        ->where('specifications.id', $specificationId)
                        ->whereIn(
                            'product_specifications.value',
                            (array) $values,
                        );
                },
            );
        }
    }
}