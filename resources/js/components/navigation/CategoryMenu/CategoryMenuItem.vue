<script setup lang="ts">
import {
    ChevronRight,
    Folder,
} from 'lucide-vue-next'

defineProps<{
    category: App.Data.NavigationCategoryData
    active: boolean
    mode?: 'panel' | 'flyout'
}>()

const emit = defineEmits<{
    (e: 'hover', category: App.Data.NavigationCategoryData): void
}>()
</script>

<template>
    <li>
        <a
            :href="category.url"
            @mouseenter="emit('hover', category)"
            :class="[
                'group flex items-center rounded-md px-3 py-2 text-sm transition-colors duration-200',
                active
                    ? 'bg-brand-50 text-brand-600'
                    : 'text-slate-700 hover:bg-brand-50 hover:text-brand-600',
            ]"
        >
            <!-- Category Icon -->
            <Folder
                class="mr-3 size-4 shrink-0"
                :class="
                    active
                        ? 'text-brand-600'
                        : 'text-slate-400 group-hover:text-brand-500'
                "
            />

            <!-- Category Name -->
            <span class="flex-1 truncate">
                {{ category.name }}
            </span>

            <!-- Arrow -->
            <ChevronRight
                v-if="category.children.length"
                class="ml-auto size-4 transition-all duration-200"
                :class="
                    active
                        ? 'translate-x-1 text-brand-600'
                        : 'text-slate-400 group-hover:translate-x-1 group-hover:text-brand-500'
                "
            />
        </a>
    </li>
</template>