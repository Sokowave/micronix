<!-- resources/js/components/home/Hero/HeroBannerSlider.vue -->

<script setup lang="ts">
import { computed, onMounted, onUnmounted, ref } from 'vue'
import { ChevronLeft, ChevronRight } from 'lucide-vue-next'
import Autoplay from 'embla-carousel-autoplay'
import useEmblaCarousel from 'embla-carousel-vue'

import HeroBannerSlide from './HeroBannerSlide.vue'

interface Props {
    banners: App.Data.BannerData[]
}

const props = defineProps<Props>()

const autoplay = Autoplay({
    delay: 5000,
    stopOnInteraction: false,
    stopOnMouseEnter: true,
})

const [emblaRef, emblaApi] = useEmblaCarousel(
    {
        loop: true,
        align: 'start',
        containScroll: 'trimSnaps',
    },
    [autoplay],
)

const selectedIndex = ref(0)
const scrollSnaps = ref<number[]>([])

const hasMultipleSlides = computed(() => props.banners.length > 1)

const update = () => {
    if (!emblaApi.value) return

    selectedIndex.value = emblaApi.value.selectedScrollSnap()
    scrollSnaps.value = emblaApi.value.scrollSnapList()
}

onMounted(() => {
    if (!emblaApi.value) return

    update()

    emblaApi.value.on('select', update)
    emblaApi.value.on('reInit', update)
})

onUnmounted(() => {
    if (!emblaApi.value) return

    emblaApi.value.off('select', update)
    emblaApi.value.off('reInit', update)
})

const scrollPrev = () => emblaApi.value?.scrollPrev()
const scrollNext = () => emblaApi.value?.scrollNext()
const scrollTo = (index: number) => emblaApi.value?.scrollTo(index)
</script>

<template>
    <div
        class="
            relative
            h-full
            overflow-hidden
            rounded
            select-none
        "
    >
        <!-- Slider -->
        <div
            ref="emblaRef"
            class="h-full overflow-hidden"
        >
            <div
                class="
                    flex
                    h-full
                    gap-2
                    before:w-2
                    before:shrink-0
                    before:content-['']
                    after:w-2
                    after:shrink-0
                    after:content-['']
                    md:before:hidden
                    md:after:hidden
                "
            >
                <HeroBannerSlide
                    v-for="banner in banners"
                    :key="banner.id"
                    :banner="banner"
                    class="
                        shrink-0
                        basis-[calc(75%_-_0.25rem)]
                        md:basis-full
                    "
                />
            </div>
        </div>

        <!-- Previous -->
        <button
            v-if="hasMultipleSlides"
            type="button"
            aria-label="Previous slide"
            class="
                absolute
                left-4
                top-1/2
                z-10
                hidden
                -translate-y-1/2
                items-center
                justify-center
                rounded-full
                bg-white/90
                p-2
                text-slate-700
                shadow-lg
                backdrop-blur-sm
                transition-colors
                hover:bg-white
                hover:text-brand-500
                lg:flex
            "
            @click="scrollPrev"
        >
            <ChevronLeft class="size-5" />
        </button>

        <!-- Next -->
        <button
            v-if="hasMultipleSlides"
            type="button"
            aria-label="Next slide"
            class="
                absolute
                right-4
                top-1/2
                z-10
                hidden
                -translate-y-1/2
                items-center
                justify-center
                rounded-full
                bg-white/90
                p-2
                text-slate-700
                shadow-lg
                backdrop-blur-sm
                transition-colors
                hover:bg-white
                hover:text-brand-500
                lg:flex
            "
            @click="scrollNext"
        >
            <ChevronRight class="size-5" />
        </button>

        <!-- Pagination -->
        <div
            v-if="hasMultipleSlides"
            aria-live="polite"
            class="
                absolute
                bottom-4
                left-1/2
                z-10
                flex
                -translate-x-1/2
                items-center
                gap-2
            "
        >
            <button
                v-for="(_, index) in scrollSnaps"
                :key="index"
                type="button"
                :aria-label="`Go to slide ${index + 1}`"
                class="
                    h-2
                    rounded-full
                    transition-all
                    duration-300
                "
                :class="
                    selectedIndex === index
                        ? 'w-8 bg-brand-500'
                        : 'w-2 bg-white/80 hover:bg-white'
                "
                @click="scrollTo(index)"
            />
        </div>
    </div>
    <!--My recommendation for Micronix
    Canvas: 1776 × 868 px
    Aspect ratio: 888:434 (≈2.046:1)
    Export: WebP (quality 80–85%)
    Keep all text and CTAs inside the center 70–75% of the banner-->
</template>