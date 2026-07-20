<!-- resources/js/components/navigation/CategoryMenu/CategoryMenu.vue -->

<script setup lang="ts">
import { ref, watch } from 'vue'

import CategoryMegaMenu from './CategoryMegaMenu.vue'
import CategoryMenuItem from './CategoryMenuItem.vue'

const props = withDefaults(
    defineProps<{
        categories: App.Data.NavigationCategoryData[]
        mode?: 'panel' | 'flyout'
    }>(),
    {
        mode: 'panel',
    },
)

const activeCategory = ref<App.Data.NavigationCategoryData | null>(null)

watch(
    () => props.categories,
    (categories) => {
        activeCategory.value =
            props.mode === 'panel'
                ? (categories[0] ?? null)
                : null
    },
    {
        immediate: true,
    },
)

const openCategory = (
    category: App.Data.NavigationCategoryData,
) => {
    activeCategory.value = category
}

const closeCategory = () => {
    if (props.mode === 'flyout') {
        activeCategory.value = null
    }
}

const isActive = (
    category: App.Data.NavigationCategoryData,
) => {
    return (
        props.mode === 'panel' &&
        activeCategory?.value?.public_id === category.public_id
    )
}
</script>

<template>
    <div
        :class="
            mode === 'panel'
                ? 'flex overflow-hidden rounded-lg bg-white shadow-xl'
                : 'relative'
        "
        @mouseleave="closeCategory"
    >
        <!-- ========================================================= -->
        <!-- Left Menu -->
        <!-- ========================================================= -->

        <aside
            :class="
                mode === 'panel'
                    ? 'w-64 border-r border-slate-200'
                    : 'w-72 overflow-hidden hover:rounded-r-0 rounded-xl bg-white'
            "
        >
            <ul
                :class="mode === 'panel' ? 'p-2' : ''"
            >
                <CategoryMenuItem
                    v-for="category in categories"
                    :key="category.public_id"
                    :category="category"
                    :active="isActive(category)"
                    @hover="openCategory"
                />
            </ul>
        </aside>

        <!-- ========================================================= -->
        <!-- Panel Mega Menu -->
        <!-- ========================================================= -->

        <section
            v-if="mode === 'panel'"
            class="
                min-h-[420px]
                w-[992px]
                flex-1
                bg-white
            "
        >
            <CategoryMegaMenu
                v-if="activeCategory"
                :key="activeCategory.public_id"
                :category="activeCategory"
            />
        </section>

        <!-- ========================================================= -->
        <!-- Flyout Mega Menu -->
        <!-- ========================================================= -->

        <Transition
            v-else
            enter-active-class="transition duration-150 ease-out"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition duration-100 ease-in"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <section
                v-if="activeCategory?.children.length"
                class="
                    absolute
                    inset-y-0
                    left-full
                    z-50
                    w-[930px]
                    overflow-hidden
                    rounded-r-xl
                    border
                    border-l-0
                    border-slate-200
                    bg-white
                    shadow-xl
                "
            >
                <CategoryMegaMenu
                    :key="activeCategory.public_id"
                    :category="activeCategory"
                />
            </section>
        </Transition>
    </div>
</template>