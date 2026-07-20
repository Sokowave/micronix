<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
import type { Settings } from '@/types/settings'

const page = usePage<{
    settings: Settings
}>()
</script>

<template>
    <Link
        href="/"
        :aria-label="page.props.settings.site_name"
        class="flex items-center"
    >
        <img
            v-if="page.props.settings.site_logo"
            :src="page.props.settings.site_logo.url"
            :alt="`${page.props.settings.site_name} logo`"
            class="h-auto w-[130px]"
        >
    </Link>
</template>