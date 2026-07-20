<script setup lang="ts">
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

import { SeoHead } from '@/components/SeoHead'
import type { PageProps } from '@/types/page'

const page = usePage<PageProps>()

const settings = computed(() => page.props.settings)
</script>

<template>
    <SeoHead
        :meta-title="
            settings.site_seo_title ||
            'Micronix Kenya | Phone Accessories, Gadgets & Electronics'
        "
        :meta-description="
            settings.site_seo_description ||
            'Shop genuine phone accessories, chargers, power banks, earphones, smartwatches and electronics with fast delivery across Kenya.'
        "
        :meta-image="settings.seo_image?.url"
    />
</template>