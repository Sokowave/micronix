<!-- resources/js/components/home/Hero/HeroBannerSlide.vue -->

<script setup lang="ts">
interface Props {
    banner: App.Data.BannerData
}

defineProps<Props>()
</script>

<template>
    <a
        v-if="banner.media?.url"
        :href="banner.url"
        :aria-label="banner.title"
        class="
            group
            block
            h-full
            overflow-hidden
            rounded-xl
            bg-slate-100
            select-none
        "
    >
        <img
            :src="banner.media.url"
            :alt="banner.title"
            class="
                block
                h-full
                w-full
                object-cover
                transition-transform
                duration-500
                ease-out
                group-hover:scale-[1.02]
            "
            loading="lazy"
            decoding="async"
            draggable="false"
        >
    </a>
</template>