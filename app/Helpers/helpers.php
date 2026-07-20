<?php
//app/Helpers/helpers.php
use App\Models\{
    SiteSetting
};
use App\Lib\BannerSlot;



if (! function_exists('banner_slot')) {

    function banner_slot(string $key): ?\App\Models\Banner
    {
        return BannerSlot::banner($key);
    }
}

if (! function_exists('banner_slot_banners')) {

    function banner_slot_banners(string $key)
    {
        return BannerSlot::banners($key);
    }
}

if (! function_exists('banner_slot_data')) {

    function banner_slot_data(string $key): array
    {
        return BannerSlot::data($key);
    }
}


    if (!function_exists('make_tables_responsive')) {
        function make_tables_responsive(string $html): string
        {
            $html = preg_replace('/<(table|tr|th|td)[^>]*\sstyle="[^"]*"([^>]*)>/i', '<$1$2>', $html);
            $html = preg_replace('/<table(.*?)>/i', '<div class="table-responsive"><table class="table table-bordered table-striped"$1>', $html);
            $html = str_ireplace('</table>', '</table></div>', $html);
            return $html;
        }
    }


    if (!function_exists('setting')) {

        function setting(
            string $key,
            mixed $default = null
        ): mixed {

            return SiteSetting::get(
                $key,
                $default
            );
        }
    }

    if (! function_exists('currency_code')) {

        function currency_code(string $default = 'KES'): string
        {
            return (string) setting('currency_code', $default);
        }
    }


    if (! function_exists('site_currency')) {

        function site_currency(string $default = 'KSh'): string
        {
            return (string) setting('site_currency', $default);
        }
    }




    if (!function_exists('normalize_search_query')) {
        function normalize_search_query(string $query): string
        {
            $query = urldecode($query);
            $query = strtolower($query);
            $query = preg_replace('/\s+/', ' ', $query);
            return trim($query);
        }
    }



    if (! function_exists('lazy_placeholder')) {
        /**
         * Generate an inline SVG placeholder with the correct aspect ratio.
         */
        function lazy_placeholder(?int $width = 1, ?int $height = 1): string
        {
            $width = max(1, (int) ($width ?? 1));
            $height = max(1, (int) ($height ?? 1));

            return sprintf(
                'data:image/svg+xml,%s',
                rawurlencode(
                    sprintf(
                        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 %d %d"></svg>',
                        $width,
                        $height
                    )
                )
            );
        }
    }


