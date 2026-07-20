<!-- resources/js/components/UserMenuItem.vue -->

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import type { Component } from 'vue'

import { DropdownMenuItem } from '@/components/ui/dropdown-menu'

interface Props {
    href: string
    icon: Component
    disabled?: boolean
}

withDefaults(defineProps<Props>(), {
    disabled: false,
})
</script>

<template>
    <DropdownMenuItem
        as-child
        :disabled="disabled"
    >
        <Link
            :href="href"
            class="group flex w-full items-center gap-3 rounded-lg px-3 py-2.5 outline-none transition-colors"
        >
            <div
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-600 transition-colors group-data-[highlighted]:bg-brand-100 group-data-[highlighted]:text-brand-600"
            >
                <component
                    :is="icon"
                    class="size-5"
                />
            </div>

            <span class="flex-1 text-sm font-medium text-slate-700">
                <slot />
            </span>
        </Link>
    </DropdownMenuItem>
</template>