<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Sitemaps\CategoriesService;
use App\Services\Sitemaps\GeneralService;
use App\Services\Sitemaps\ProductsService;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Sitemap as SitemapTag;

class SitemapController extends Controller
{
    public function __construct(
        protected GeneralService $generalService,
        protected ProductsService $productsService,
        protected CategoriesService $categoriesService,
    ) {
    }

    public function index()
    {
        $index = SitemapIndex::create();

        foreach ([
            url('/sitemaps/general.xml'),
            url('/sitemaps/products.xml'),
            url('/sitemaps/categories.xml'),
        ] as $url) {

            $index->add(
                SitemapTag::create($url)
                    ->setLastModificationDate(now())
            );
        }

        return $this->xmlResponse($index->toResponse(request()));
    }

    public function general()
    {
        return $this->sitemapResponse(
            $this->generalService->generate()
        );
    }

    public function products()
    {
        return $this->sitemapResponse(
            $this->productsService->generate()
        );
    }

    public function categories()
    {
        return $this->sitemapResponse(
            $this->categoriesService->generate()
        );
    }

    protected function sitemapResponse($sitemap)
    {
        return $this->xmlResponse(
            $sitemap->toResponse(request())
        );
    }

    protected function xmlResponse($response)
    {
        $response->headers->set('Content-Type', 'application/xml');
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        return $response;
    }
}