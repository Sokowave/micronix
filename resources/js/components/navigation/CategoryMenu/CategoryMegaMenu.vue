
<!-- resources/js/components/navigation/CategoryNavbar/CategoryMegaMenu.vue -->

<script setup lang="ts">
defineProps<{
    category: App.Data.NavigationCategoryData
}>()
</script>

<template>
    <div
        class="
            h-full
            w-full
            overflow-y-auto
            bg-white
            p-6
        "
    >
        <!--<div class="mb-6">
            <a
                :href="category.url"
                class="
                    text-lg
                    font-semibold
                    text-slate-900
                    transition-colors
                    hover:text-brand-500
                "
            >
                {{ category.name }}
            </a>
        </div>-->

        <div
            v-if="category.children.length"
            class="grid grid-cols-4 gap-8"
        >
            <section
                v-for="child in category.children"
                :key="child.public_id"
                class="space-y-3"
            >
                <!-- Level 2 -->
                <a
                    :href="child.url"
                    class="
                        block
                        border-b
                        border-brand-100
                        pb-2
                        text-sm
                        font-semibold
                        text-brand-500
                        transition-colors
                        hover:text-brand-600
                    "
                >
                    {{ child.name }}
                </a>

                <!-- Level 3 -->
                <ul
                    v-if="child.children.length"
                    class="space-y-2"
                >
                    <li
                        v-for="grandChild in child.children"
                        :key="grandChild.public_id"
                    >
                        <a
                            :href="grandChild.url"
                            class="
                                block
                                text-sm
                                text-slate-600
                                transition-colors
                                hover:text-brand-500
                            "
                        >
                            {{ grandChild.name }}
                        </a>
                    </li>
                </ul>
            </section>
        </div>

        <div
            v-else
            class="
                py-10
                text-sm
                text-slate-500
            "
        >
            No subcategories available.
        </div>
    </div>
</template>
