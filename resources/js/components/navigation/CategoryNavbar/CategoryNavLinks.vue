<!-- resources/js/components/navigation/CategoryNavbar/CategoryNavLinks.vue -->

<script setup lang="ts">
import { OverlayScrollbarsComponent } from 'overlayscrollbars-vue'

defineProps<{
    categories: App.Data.NavigationCategoryData[]
}>()

const options = {
    overflow: {
        x: 'scroll',
        y: 'hidden',
    },
    scrollbars: {
        autoHide: 'leave',
        autoHideDelay: 300,
        theme: 'os-theme-dark',
    },
}
</script>

<template>
    <OverlayScrollbarsComponent
        defer
        :options="options"
        class="min-w-0 flex-1"
    >
        <div
            class="
                flex
                gap-2
                whitespace-nowrap
                py-1
            "
        >
            <a
                v-for="category in categories"
                :key="category.public_id"
                :href="category.url"
                class="
                    shrink-0
                    rounded-md
                    px-3
                    py-2
                    text-sm
                    font-medium
                    text-slate-700
                    transition-colors
                    duration-200
                    hover:bg-brand-50
                    hover:text-brand-500
                    focus:outline-none
                    focus-visible:ring-2
                    focus-visible:ring-brand-500
                    focus-visible:ring-offset-2
                "
            >
                {{ category.name }}
            </a>
        </div>
    </OverlayScrollbarsComponent>
</template>