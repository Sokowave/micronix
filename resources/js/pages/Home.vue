<!-- resources/js/pages/Home.vue -->

<script setup lang="ts">
import {
    SeoHead,
    Hero,
    BackgroundDecoration,
} from '@/components/home'

interface Props {
    heroCategories: App.Data.NavigationCategoryData[]
    banners: App.Data.BannerData[]
}

defineProps<Props>()
</script>

<template>
    <SeoHead />
    
    <main class="relative min-h-screen overflow-hidden bg-[#fcfbf8]">
        <!-- Background decorations -->
        <BackgroundDecoration />

        <div class="relative z-10">
            <!-- Hero -->
            <section class="py-6">
                <div class="mx-auto max-w-7xl px-4">
                    <Hero
                        :categories="heroCategories"
                        :banners="banners"
                    />
                </div>
            </section>
        </div>
    </main>
</template>