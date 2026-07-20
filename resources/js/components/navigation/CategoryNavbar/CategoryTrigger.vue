<!-- resources/js/components/navigation/CategoryNavbar/CategoryTrigger.vue -->

<script setup lang="ts">
import { ref } from 'vue'
import { List } from 'lucide-vue-next'

import { CategoryMenu } from '@/components/navigation/CategoryMenu'

defineProps<{
    categories: App.Data.NavigationCategoryData[]
}>()

const isOpen = ref(false)

const open = () => {
    isOpen.value = true
}

const close = () => {
    isOpen.value = false
}
</script>

<template>
    <div
        class="relative"
        @mouseenter="open"
        @mouseleave="close"
    >
        <button
            type="button"
            class="
                flex h-10 items-center gap-2 rounded-md
                border border-brand-500 bg-brand-500
                px-4 text-sm font-medium uppercase
                text-white transition-colors
                hover:bg-white hover:text-brand-500
                focus:outline-none
            "
        >
            <List class="size-5" />

            <span>All Categories</span>
        </button>

        <Transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="translate-y-1 opacity-0"
            enter-to-class="translate-y-0 opacity-100"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="translate-y-0 opacity-100"
            leave-to-class="translate-y-1 opacity-0"
        >
            <div
                v-show="isOpen"
                class="absolute left-0 top-full z-50 mt-1"
            >
                <CategoryMenu
                    :categories="categories"
                    mode="panel"
                />
            </div>
        </Transition>
    </div>
</template>