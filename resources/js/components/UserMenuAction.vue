<!-- resources/js/components/UserMenuAction.vue -->

<script setup lang="ts">
import type { Component } from 'vue'

import { DropdownMenuItem } from '@/components/ui/dropdown-menu'

interface Props {
    icon: Component
    variant?: 'default' | 'danger'
    disabled?: boolean
}

withDefaults(defineProps<Props>(), {
    variant: 'default',
    disabled: false,
})

const emit = defineEmits<{
    click: []
}>()
</script>

<template>
    <DropdownMenuItem
        as-child
        :disabled="disabled"
    >
        <button
            type="button"
            class="group flex w-full cursor-pointer items-center gap-3 rounded-lg px-3 py-2.5 text-left outline-none transition-colors"
            @click="emit('click')"
        >
            <div
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg transition-colors"
                :class="
                    variant === 'danger'
                        ? 'bg-red-50 text-red-600 group-data-[highlighted]:bg-red-100'
                        : 'bg-slate-100 text-slate-600 group-data-[highlighted]:bg-brand-100 group-data-[highlighted]:text-brand-600'
                "
            >
                <component
                    :is="icon"
                    class="size-5"
                />
            </div>

            <span
                class="flex-1 text-sm font-medium"
                :class="
                    variant === 'danger'
                        ? 'text-red-600'
                        : 'text-slate-700'
                "
            >
                <slot />
            </span>
        </button>
    </DropdownMenuItem>
</template>