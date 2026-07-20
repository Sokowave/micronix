// resources/js/types/settings.ts

export interface Media {
    id: number
    url: string
}

export interface Settings {
    /*
    |--------------------------------------------------------------------------
    | Site
    |--------------------------------------------------------------------------
    */

    site_name: string
    site_url: string
    locale: string
    theme_color: string

    /*
    |--------------------------------------------------------------------------
    | Branding
    |--------------------------------------------------------------------------
    */

    site_logo: Media | null
    site_icon: Media | null
    apple_touch_icon: Media | null

    /*
    |--------------------------------------------------------------------------
    | Default SEO
    |--------------------------------------------------------------------------
    */

    site_seo_title: string
    site_seo_description: string
    seo_image: Media | null

    /*
    |--------------------------------------------------------------------------
    | Contact
    |--------------------------------------------------------------------------
    */

    business_phone: string
    whatsapp_number: string

    /*
    |--------------------------------------------------------------------------
    | Currency
    |--------------------------------------------------------------------------
    */

    currency_code: string
    site_currency: string

    /*
    |--------------------------------------------------------------------------
    | Homepage
    |--------------------------------------------------------------------------
    */

    homepage_hero_title: string
    homepage_hero_description: string
}