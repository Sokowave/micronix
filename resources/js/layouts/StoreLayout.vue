<script setup lang="ts">
import { usePage } from '@inertiajs/vue3'

import type { PageProps } from '@/types/page'

import TopBanner from '@/components/TopBanner.vue'
import PartnersBar from '@/components/PartnersBar.vue'
import Navbar from '@/components/Navbar.vue'
import CategoryNavbar from '@/components/navigation/CategoryNavbar'

const page = usePage<PageProps>()
</script>

<template>
    <header>
        <TopBanner />

        <PartnersBar />

        <Navbar />

        <CategoryNavbar
            :categories="page.props.navigation.categories"
        />
    </header>

    <main>
        <slot />
    </main>
</template>