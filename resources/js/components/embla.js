// resources/js/components/embla.js

import EmblaCarousel from 'embla-carousel';
import Autoplay from 'embla-carousel-autoplay';

const instances = new WeakMap();

function initCarousel(root) {
    if (instances.has(root)) return;

    const viewport = root.querySelector('[data-embla-viewport]');
    if (!viewport) return;

    const prev = root.querySelector('[data-embla-prev]');
    const next = root.querySelector('[data-embla-next]');
    const dotsContainer = root.querySelector('[data-embla-dots]');

    const type = root.dataset.emblaType ?? 'default';
    const axis = root.dataset.emblaAxis ?? 'x';
    const loop = root.dataset.emblaLoop === 'true';
    const autoplay = root.dataset.emblaAutoplay === 'true';
    const delay = Number(root.dataset.emblaDelay) || 5000;

    const plugins = autoplay
        ? [
            Autoplay({
                delay,
                stopOnInteraction: false,
                stopOnMouseEnter: true,
            }),
        ]
        : [];

    const embla = EmblaCarousel(
        viewport,
        {
            axis,
            align: 'start',
            containScroll: 'trimSnaps',
            loop,
        },
        plugins,
    );

    instances.set(root, embla);

    prev?.addEventListener('click', () => embla.scrollPrev());
    next?.addEventListener('click', () => embla.scrollNext());

    let dots = [];

    const createDots = () => {
        if (!dotsContainer) return;

        dotsContainer.replaceChildren();

        const items = type === 'banner'
            ? embla.slideNodes()
            : embla.scrollSnapList();

        dots = items.map((_, index) => {
            const dot = document.createElement('button');

            dot.type = 'button';
            dot.ariaLabel = `Go to slide ${index + 1}`;
            dot.dataset.emblaDot = '';

            dot.className =
                'size-2 cursor-pointer rounded-full bg-white/70 transition-all duration-300 hover:bg-white';

            dot.addEventListener('click', () => {
                embla.scrollTo(index);
            });

            dotsContainer.appendChild(dot);

            return dot;
        });
    };

    const update = () => {
        if (prev) {
            prev.disabled = !embla.canScrollPrev();
        }

        if (next) {
            next.disabled = !embla.canScrollNext();
        }

        const selected = embla.selectedScrollSnap();

        dots.forEach((dot, index) => {
            const active = index === selected;

            dot.classList.toggle('size-3', active);
            dot.classList.toggle('bg-micronix-500', active);

            dot.classList.toggle('size-2', !active);
            dot.classList.toggle('bg-white/70', !active);

            dot.toggleAttribute('aria-current', active);
        });
    };

    const reInit = () => {
        createDots();
        update();
    };

    createDots();
    update();

    embla.on('select', update);
    embla.on('reInit', reInit);
}

export function initEmbla() {
    document
        .querySelectorAll('[data-embla]')
        .forEach(initCarousel);
}