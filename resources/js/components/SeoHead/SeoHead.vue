<!--resources/js/components/SeoHead/SeoHead.vue-->

<script setup lang="ts">
import { computed } from 'vue'
import { Head, usePage } from '@inertiajs/vue3'

import type { PageProps } from '@/types/page'

import StructuredData from './StructuredData.vue'

interface Props {
    metaTitle?: string

    metaDescription?: string

    metaImage?: string

    canonical?: string

    url?: string

    type?: 'website' | 'article' | 'product'

    robots?: string

    structuredData?:
        | Record<string, unknown>
        | Record<string, unknown>[]
}

const props = withDefaults(
    defineProps<Props>(),
    {
        url: '',
        canonical: '',
        metaImage: '',
        type: 'website',
        robots:
            'index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1',
        structuredData: undefined,
    },
)

const page = usePage<PageProps>()

const settings = computed(() => page.props.settings)

const metaTitle = computed(() => {
    return (
        props.metaTitle ||
        settings.value.site_seo_title
    )
})

const metaDescription = computed(() => {
    return (
        props.metaDescription ||
        settings.value.site_seo_description
    )
})

const metaImage = computed(() => {
    return (
        props.metaImage ||
        settings.value.seo_image?.url ||
        ''
    )
})

const pageUrl = computed(() => {
    return props.url || window.location.href
})

const canonicalUrl = computed(() => {
    return props.canonical || pageUrl.value
})
</script>

<template>
    <Head>
        <title>{{ metaTitle }}</title>

        <meta name="description" :content="metaDescription" />
        <meta name="robots" :content="robots" />
        <meta name="theme-color" :content="settings.theme_color" />

        <link rel="canonical" :href="canonicalUrl" />

        <meta property="og:title" :content="metaTitle" />
        <meta property="og:description" :content="metaDescription" />
        <meta property="og:type" :content="type" />
        <meta property="og:url" :content="pageUrl" />
        <meta property="og:site_name" :content="settings.site_name" />
        <meta property="og:locale" :content="settings.locale" />

        <meta v-if="metaImage" property="og:image" :content="metaImage" />
        <meta v-if="metaImage" property="og:image:secure_url" :content="metaImage" />
        <meta v-if="metaImage" property="og:image:type" content="image/webp" />
        <meta v-if="metaImage" property="og:image:width" content="1200" />
        <meta v-if="metaImage" property="og:image:height" content="630" />
        <meta v-if="metaImage" property="og:image:alt" :content="metaTitle" />

        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" :content="metaTitle" />
        <meta name="twitter:description" :content="metaDescription" />
        <meta v-if="metaImage" name="twitter:image" :content="metaImage" />
        <meta v-if="metaImage" name="twitter:image:alt" :content="metaTitle" />

        <StructuredData v-if="structuredData" :data="structuredData" />
    </Head>
</template>