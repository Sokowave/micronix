<!-- resources/js/components/home/Hero/Hero.vue -->

<script setup lang="ts">
import HeroBannerSlider from './HeroBannerSlider.vue'
import { CategoryMenu } from '@/components/navigation/CategoryMenu'

defineProps<{
    categories: App.Data.NavigationCategoryData[]
    banners: App.Data.BannerData[]
}>()
</script>

<template>
    <section
        class="
            flex
            gap-6
            xl:h-[434px]
        "
    >
        <!-- Category Menu -->
        <aside
            class="
                hidden
                w-72
                shrink-0
                xl:flex
                xl:h-full
            "
        >
            <CategoryMenu
                class="h-full w-full"
                :categories="categories"
                mode="flyout"
            />
        </aside>

        <!-- Hero Banner -->
        <div
            class="
                min-w-0
                flex-1
                xl:h-full
            "
        >
            <HeroBannerSlider
                class="h-full w-full"
                :banners="banners"
            />
        </div>
    </section>
</template>