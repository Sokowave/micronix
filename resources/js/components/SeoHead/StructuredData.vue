
<!--resources/js/components/SeoHead/StructuredData.vue-->

<script setup lang="ts">
interface Props {
    data: Record<string, unknown> | Record<string, unknown>[]
}

defineProps<Props>()
</script>

<template>
    <component
        :is="'script'"
        type="application/ld+json"
        v-text="JSON.stringify(data)"
    />
</template>