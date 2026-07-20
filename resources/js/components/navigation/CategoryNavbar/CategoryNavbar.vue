<!-- resources/js/components/navigation/CategoryNavbar/CategoryNavbar.vue -->

<script setup lang="ts">
import CategoryNavLinks from './CategoryNavLinks.vue'
import CategoryTrigger from './CategoryTrigger.vue'

defineProps<{
    categories: App.Data.NavigationCategoryData[]
}>()
</script>

<template>
    <nav
        aria-label="Product Categories"
        class="hidden border-b border-slate-200 bg-white lg:block"
    >
        <div
            class="
                mx-auto flex max-w-7xl items-center gap-3
                px-4 py-2
            "
        >
            <CategoryTrigger
                :categories="categories"
            />

            <CategoryNavLinks
                :categories="categories"
            />
        </div>
    </nav>
</template>