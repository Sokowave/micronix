// resources/js/types/page.ts

import type { PageProps as InertiaPageProps } from '@inertiajs/core'
import type { Settings } from './settings'

export interface FlashMessages {
    success?: string
    error?: string
    warning?: string
    info?: string
}

export interface AppRoutes {
    home: string

    products: {
        index: string
        suggestions: string
    }

    categories: {
        index: string
    }

    brands: {
        index: string
    }

    cart: {
        index: string
    }

    checkout: {
        index: string
    }

    backoffice: {
        dashboard: string
        products: string
        login: string
        logout: string
    }
}

export interface Filters {
    q?: string
    category?: string
    brand?: string
    sort?: string
    page?: number
}

export interface Navigation {
    categories: App.Data.NavigationCategoryData[]
}

export interface PageProps extends InertiaPageProps {
    auth: {
        user: App.Data.Auth.AuthenticatedUserData | null
    }

    navigation: Navigation

    settings: Settings

    routes: AppRoutes

    flash: FlashMessages

    filters: Filters
}