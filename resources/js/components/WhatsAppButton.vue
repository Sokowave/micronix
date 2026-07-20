<script setup lang="ts">
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import type { Settings } from '@/types/settings'

const page = usePage<{
    settings: Settings
}>()

const phone = computed(() => {
    return (page.props.settings.whatsapp_number ?? '').replace(/\D/g, '')
})

const formattedPhone = computed(() => {
    return phone.value.replace(
        /^(\d{3})(\d{3})(\d{3})(\d{3})$/,
        '+$1 $2 $3 $4',
    )
})

const whatsappUrl = computed(() => {
    return `https://wa.me/${phone.value}`
})
</script>

<template>
    <a
        :href="whatsappUrl"
        target="_blank"
        rel="noopener noreferrer"
        class="inline-flex items-center gap-3 rounded-xl border border-gray-200 px-2 py-1 transition hover:border-green-500"
    >
        <div class="flex size-6 items-center justify-center">
            <!-- Replace with your preferred icon component -->
            <svg
                class="size-5 text-green-500"
                viewBox="0 0 24 24"
                fill="currentColor"
                aria-hidden="true"
            >
                <path
                    d="M12.04 2C6.52 2 2.04 6.48 2.04 12c0 1.76.46 3.48 1.34 5L2 22l5.15-1.35A9.94 9.94 0 0 0 12.04 22c5.52 0 10-4.48 10-10s-4.48-10-10-10Zm5.82 14.41c-.24.67-1.39 1.29-1.91 1.37-.49.07-1.11.1-1.79-.12-.41-.13-.94-.31-1.62-.6-2.84-1.23-4.69-4.11-4.83-4.3-.14-.19-1.15-1.53-1.15-2.91s.72-2.06.98-2.34c.26-.29.56-.36.75-.36.19 0 .38 0 .55.01.17.01.39-.06.61.47.23.56.78 1.93.85 2.07.07.14.12.31.02.5-.1.19-.14.31-.28.48-.14.17-.29.38-.41.51-.14.14-.29.29-.12.57.17.29.76 1.25 1.63 2.03 1.13 1 2.08 1.31 2.37 1.46.29.14.46.12.63-.07.17-.19.74-.86.94-1.15.19-.29.39-.24.65-.14.27.1 1.69.8 1.98.95.29.14.48.22.55.34.07.12.07.69-.17 1.36Z"
                />
            </svg>
        </div>

        <div class="leading-tight">
            <p class="text-xs font-medium text-gray-700">
                Order via WhatsApp
            </p>

            <p class="text-xs font-bold tracking-tight text-gray-900">
                {{ formattedPhone }}
            </p>
        </div>
    </a>
</template>