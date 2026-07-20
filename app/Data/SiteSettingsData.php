<?php

namespace App\Data;

use App\Data\MediaData;
use App\Models\SiteSetting;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]

class SiteSettingsData extends Data
{
    public function __construct(
        public string $site_name,
        public string $site_url,
        public string $locale,
        public string $theme_color,

        public ?MediaData $site_logo,
        public ?MediaData $site_icon,
        public ?MediaData $apple_touch_icon,

        public string $site_seo_title,
        public string $site_seo_description,
        public ?MediaData $seo_image,

        public string $business_phone,
        public string $whatsapp_number,

        public string $currency_code,
        public string $site_currency,

        public string $homepage_hero_title,
        public string $homepage_hero_description,
    ) {}

    public static function fromSettings(): self
    {
        $settings = SiteSetting::allSettings();

        return new self(
            site_name: $settings['site_name'] ?? config('app.name'),
            site_url: $settings['site_url'] ?? config('app.url'),
            locale: $settings['locale'] ?? app()->getLocale(),
            theme_color: $settings['theme_color'] ?? '#2563eb',

            site_logo: isset($settings['site_logo'])
                ? MediaData::from($settings['site_logo'])
                : null,

            site_icon: isset($settings['site_icon'])
                ? MediaData::from($settings['site_icon'])
                : null,

            apple_touch_icon: isset($settings['apple_touch_icon'])
                ? MediaData::from($settings['apple_touch_icon'])
                : null,

            site_seo_title: $settings['site_seo_title']
                ?? config('app.name'),

            site_seo_description: $settings['site_seo_description']
                ?? '',

            seo_image: isset($settings['seo_image'])
                ? MediaData::from($settings['seo_image'])
                : null,

            business_phone: $settings['business_phone'] ?? '',

            whatsapp_number: $settings['whatsapp_number'] ?? '',

            currency_code: $settings['currency_code'] ?? 'KES',

            site_currency: $settings['site_currency'] ?? 'KSh',

            homepage_hero_title: $settings['homepage_hero_title'] ?? '',

            homepage_hero_description: $settings['homepage_hero_description'] ?? '',
        );
    }
}