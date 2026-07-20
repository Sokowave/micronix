<script setup lang="ts">
import AppLogo from '@/components/AppLogo.vue'
import ProductSearch from '@/components/ProductSearch.vue'
import WhatsAppButton from '@/components/WhatsAppButton.vue'
import UserMenu from '@/components/UserMenu.vue'
import MobileNavbar from '@/components/MobileNavbar.vue'
</script>

<template>
    <header class="sticky top-0 z-50 hidden bg-white py-1 lg:block">
        <div class="mx-auto max-w-7xl px-1 lg:px-4">
            <div class="flex items-center justify-between gap-4 py-1">

                <AppLogo />

                <ProductSearch class="w-1/2" />

                <div class="flex items-center gap-2 font-medium">
                    <WhatsAppButton />
                    <UserMenu />
                </div>

            </div>
        </div>
    </header>

    <MobileNavbar />
</template>