<!-- resources/js/components/ProductSearch.vue -->

<script setup lang="ts">
import { computed, ref, watch } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import { onClickOutside, useDebounceFn } from '@vueuse/core'
import {
    ArrowUpRight,
    LoaderCircle,
    Search,
    X,
} from 'lucide-vue-next'

import type { PageProps } from '@/types/page'

const page = usePage<PageProps>()

const root = ref<HTMLElement>()

const query = ref(page.props.filters.q ?? '')
const suggestions = ref<string[]>([])
const loading = ref(false)
const showSuggestions = ref(false)
const selectedIndex = ref(-1)

const hasQuery = computed(() => query.value.trim().length > 0)

const productsUrl = page.props.routes.products.index
const suggestionsUrl = page.props.routes.products.suggestions

const fetchSuggestions = async () => {
    if (!hasQuery.value) {
        suggestions.value = []
        showSuggestions.value = false
        selectedIndex.value = -1
        return
    }

    loading.value = true

    try {
        const response = await fetch(
            `${suggestionsUrl}?q=${encodeURIComponent(query.value)}`
        )

        suggestions.value = await response.json()

        showSuggestions.value = true
        selectedIndex.value = -1
    } catch {
        suggestions.value = []
        showSuggestions.value = false
    } finally {
        loading.value = false
    }
}

const debouncedSearch = useDebounceFn(
    fetchSuggestions,
    300
)

watch(query, () => {
    debouncedSearch()
})

function submit() {
    if (!hasQuery.value) {
        return
    }

    router.get(productsUrl, {
        q: query.value,
    })
}

function selectSuggestion(value: string) {
    router.get(productsUrl, {
        q: value,
    })
}

function clearSearch() {
    query.value = ''
    suggestions.value = []
    selectedIndex.value = -1
    showSuggestions.value = false
}

function onKeydown(event: KeyboardEvent) {
    if (!suggestions.value.length) {
        return
    }

    switch (event.key) {
        case 'ArrowDown':
            event.preventDefault()

            showSuggestions.value = true

            selectedIndex.value =
                (selectedIndex.value + 1) %
                suggestions.value.length

            break

        case 'ArrowUp':
            event.preventDefault()

            showSuggestions.value = true

            selectedIndex.value =
                (selectedIndex.value - 1 + suggestions.value.length) %
                suggestions.value.length

            break

        case 'Enter':
            if (selectedIndex.value >= 0) {
                event.preventDefault()

                selectSuggestion(
                    suggestions.value[selectedIndex.value]
                )
            }

            break

        case 'Escape':
            showSuggestions.value = false
            break
    }
}

function highlight(text: string) {
    if (!query.value) {
        return text
    }

    const escaped = query.value.replace(
        /[.*+?^${}()|[\]\\]/g,
        '\\$&'
    )

    return text.replace(
        new RegExp(`(${escaped})`, 'ig'),
        '<strong>$1</strong>'
    )
}

onClickOutside(root, () => {
    showSuggestions.value = false
})
</script>

<template>
    <div
        ref="root"
        class="relative"
    >
        <form
            class="relative flex items-center gap-2 rounded-xl border border-gray-300 bg-white p-1"
            @submit.prevent="submit"
        >
            <div class="flex-1">
                <div class="relative flex items-center">

                    <div class="flex h-8 w-8 items-center justify-center">
                        <Search class="size-5 text-gray-300" />
                    </div>

                    <input
                        v-model="query"
                        type="search"
                        autocomplete="off"
                        placeholder="Search products, brands and categories"
                        class="w-full border-0 bg-transparent px-2 text-sm outline-none ring-0 focus:ring-0"
                        @focus="showSuggestions = suggestions.length > 0"
                        @keydown="onKeydown"
                    >

                    <button
                        v-if="hasQuery"
                        type="button"
                        class="absolute right-0 flex h-7 w-7 items-center justify-center rounded-lg bg-slate-100 text-slate-600 transition hover:bg-slate-200"
                        @click="clearSearch"
                    >
                        <X class="size-4" />
                    </button>

                </div>
            </div>

            <button
                type="submit"
                class="btn-gradient flex items-center justify-center gap-1 rounded-xl bg-brand-500 p-2 shadow-xl md:px-4 md:py-2"
            >
                <Search class="size-4 text-white" />

                <span class="hidden text-sm font-medium text-white md:block">
                    Search
                </span>
            </button>
        </form>

        <div
            v-if="showSuggestions"
            class="absolute left-0 top-full z-50 mt-3 w-full overflow-hidden rounded-xl bg-white shadow-[0_20px_60px_rgba(15,23,42,.14)]"
        >
            <div
                v-if="loading"
                class="flex items-center justify-center gap-2 p-5 text-sm text-gray-500"
            >
                <LoaderCircle class="size-4 animate-spin" />

                Searching...
            </div>

            <template v-else-if="suggestions.length">

                <button
                    v-for="(item, index) in suggestions"
                    :key="item"
                    type="button"
                    class="flex w-full items-center justify-between px-4 py-3 text-left text-sm transition hover:bg-slate-100"
                    :class="{
                        'bg-slate-100': selectedIndex === index,
                    }"
                    @click="selectSuggestion(item)"
                >
                    <span v-html="highlight(item)" />

                    <ArrowUpRight class="size-4 shrink-0" />
                </button>

            </template>

            <div
                v-else
                class="p-5 text-center text-sm text-gray-500"
            >
                No matching products found.
            </div>
        </div>
    </div>
</template>