// resources/js/app.ts

import { createInertiaApp } from '@inertiajs/vue3'
import StoreLayout from '@/layouts/StoreLayout.vue'
import AdminLayout from '@/layouts/AdminLayout.vue'
import AuthLayout from '@/layouts/AuthLayout.vue'
import { initializeTheme } from '@/composables/useAppearance'
import { initializeFlashToast } from '@/lib/flashToast'

const appName = import.meta.env.VITE_APP_NAME || 'Micronix'

createInertiaApp({
    title: (title) => (title ? `${title} | ${appName}` : appName),

    layout: (name) => {
        if (name.startsWith('Admin/')) {
            return AdminLayout
        }

        if (name.startsWith('Auth/')) {
            return AuthLayout
        }

        return StoreLayout
    },

    progress: {
        color: '#4F39F6',
    },
})

// Initialize application theme before the app is mounted.
initializeTheme()

// Listen for Laravel flash messages and display toast notifications.
initializeFlashToast()