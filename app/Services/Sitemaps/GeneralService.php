<?php

namespace App\Services\Sitemaps;

use App\Models\Page;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GeneralService
{
    public function generate(): Sitemap
    {
        $sitemap = Sitemap::create();

        // Homepage
        $sitemap->add(
            Url::create(route('home'))
                ->setPriority(1.0)
        );

        // About page
        $sitemap->add(
            Url::create(route('frontend.about'))
                ->setPriority(0.7)
        );

        $sitemap->add(
            Url::create(route('frontend.contact-us'))
                ->setPriority(0.7)
        );

        // Published CMS pages
        Page::published()->each(function (Page $page) use ($sitemap) {

            // Only include pages that have a matching named route
            if (! Route::has($page->slug)) {
                return;
            }

            $sitemap->add(
                Url::create(route($page->slug))
                    ->setLastModificationDate($page->updated_at)
                    ->setPriority(0.6)
            );
        });

        return $sitemap;
    }
}