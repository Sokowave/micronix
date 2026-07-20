declare namespace App {
    namespace Data {
        export type BannerData = {
            id: number;
            title: string;
            media: App.Data.MediaData | null;
            url: string;
            location: string;
            priority: number;
        };
        export type BrandData = {
            name: string;
            slug: string;
            logo: App.Data.MediaData | null;
            meta_title: string | null;
            meta_description: string | null;
            status: string;
            url: string;
        };
        export type CartData = object;
        export type CategoryData = {
            public_id: string;
            name: string;
            slug: string;
            full_name: string;
            image: App.Data.MediaData | null;
            meta_title: string | null;
            meta_description: string | null;
            is_featured: boolean;
            is_active: boolean;
            url: string;
        };
        export type MediaData = {
            public_id: string;
            url: string | null;
        };
        export type NavigationCategoryData = {
            public_id: string;
            name: string;
            slug: string;
            url: string;
            children: App.Data.NavigationCategoryData[];
        };
        export type OrderData = object;
        export type PageData = {
            title: string;
            slug: string;
            content: string;
            seo_title: string | null;
            seo_description: string | null;
            is_published: boolean;
            url: string;
        };
        export type ProductCardData = {
            public_id: string;
            title: string;
            slug: string;
            current_price: number;
            sale_price: number | null;
            has_discount: boolean;
            discount_percentage: number | null;
            formatted_price: string;
            formatted_original_price: string;
            primary_image: App.Data.MediaData | null;
            url: string;
        };
        export type ProductDetailsData = {
            public_id: string;
            title: string;
            slug: string;
            short_description: string | null;
            description: string | null;
            specifications: {
                name: string;
                value: string;
            }[];
            sku: string;
            stock: number;
            condition: string | null;
            color: string | null;
            model: string | null;
            warranty: number | null;
            price: number;
            sale_price: number | null;
            current_price: number;
            has_discount: boolean;
            discount_amount: number;
            discount_percentage: number | null;
            savings: number;
            formatted_price: string;
            formatted_original_price: string;
            formatted_savings: string;
            primary_image: App.Data.MediaData | null;
            images: App.Data.MediaData[];
            url: string;
        };
        export type ProductListData = {
            public_id: string;
            title: string;
            slug: string;
            sku: string;
            stock: number;
            current_price: number;
            sale_price: number | null;
            has_discount: boolean;
            discount_percentage: number | null;
            formatted_price: string;
            formatted_original_price: string;
            condition: string | null;
            primary_image: App.Data.MediaData | null;
            url: string;
        };
        export type SiteSettingsData = {
            site_name: string;
            site_url: string;
            locale: string;
            theme_color: string;
            site_logo: App.Data.MediaData | null;
            site_icon: App.Data.MediaData | null;
            apple_touch_icon: App.Data.MediaData | null;
            site_seo_title: string;
            site_seo_description: string;
            seo_image: App.Data.MediaData | null;
            business_phone: string;
            whatsapp_number: string;
            currency_code: string;
            site_currency: string;
            homepage_hero_title: string;
            homepage_hero_description: string;
        };
        export type UserData = {
            entry_no: string;
            f_name: string;
            l_name: string;
            name: string;
            name_initials: string;
            email: string;
            phone: string | null;
            status: string;
        };
        namespace Auth {
            export type AuthenticatedUserData = {
                entry_no: string;
                f_name: string;
                l_name: string;
                name: string;
                name_initials: string;
                email: string;
                phone: string | null;
                status: string;
                user_type: string;
            };
        }
    }
}
