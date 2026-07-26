// resources/js/components/product-gallery.js

import EmblaCarousel from 'embla-carousel';

const instances = new WeakMap();

function initGallery(root) {
    if (instances.has(root)) return;

    const mainViewport = root.querySelector('[data-gallery-viewport]');
    if (!mainViewport) return;

    const thumbsViewport = root.querySelector('[data-gallery-thumbs-viewport]');
    const thumbnails = [...root.querySelectorAll('[data-gallery-thumbnail]')];
    const prev = root.querySelector('[data-gallery-previous]');
    const next = root.querySelector('[data-gallery-next]');
    const counter = root.querySelector('[data-gallery-current]');

    const main = EmblaCarousel(mainViewport, {
        loop: false,
        align: 'start',
        containScroll: 'trimSnaps',
    });

    const thumbs = thumbsViewport
        ? EmblaCarousel(thumbsViewport, {
            axis: 'y',
            dragFree: true,
            containScroll: 'keepSnaps',
            align: 'start',
        })
        : null;

    const setActiveThumbnail = (index) => {
        thumbnails.forEach((thumbnail, i) => {
            const active = i === index;

            thumbnail.classList.toggle('border-micronix-500', active);
            thumbnail.classList.toggle('ring-1', active);
            thumbnail.classList.toggle('ring-micronix-500', active);
            thumbnail.classList.toggle('border-zinc-200', !active);
        });
    };

    const revealThumbnail = (index) => {
        if (!thumbs) return;

        const viewport = thumbsViewport.getBoundingClientRect();
        const thumbnail = thumbnails[index]?.getBoundingClientRect();

        if (!thumbnail) return;

        if (thumbnail.top < viewport.top) {
            thumbs.scrollTo(index);
        } else if (thumbnail.bottom > viewport.bottom) {
            thumbs.scrollTo(index);
        }
    };

    const update = () => {
        const index = main.selectedScrollSnap();

        setActiveThumbnail(index);
        revealThumbnail(index);

        if (counter) counter.textContent = index + 1;

        if (prev) prev.disabled = !main.canScrollPrev();
        if (next) next.disabled = !main.canScrollNext();
    };

    thumbnails.forEach((thumbnail, index) => {
        thumbnail.addEventListener('click', () => main.scrollTo(index));
    });

    prev?.addEventListener('click', () => main.scrollPrev());
    next?.addEventListener('click', () => main.scrollNext());

    main.on('select', update);
    main.on('reInit', update);

    update();

    instances.set(root, { main, thumbs });
}

export function initProductGallery() {
    document
        .querySelectorAll('[data-product-gallery]')
        .forEach(initGallery);
}