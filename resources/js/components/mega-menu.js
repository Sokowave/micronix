const initialiseMegaMenu = (menu) => {
    if (menu.dataset.megaMenuInitialised === 'true') {
        return;
    }

    menu.dataset.megaMenuInitialised = 'true';

    const triggers = [
        ...menu.querySelectorAll('[data-mega-menu-trigger]'),
    ];

    const panels = [
        ...menu.querySelectorAll('[data-mega-menu-panel]'),
    ];

    if (!triggers.length || !panels.length) {
        return;
    }

    let activeIndex = 0;

    const setActive = (index) => {
        if (activeIndex === index) {
            return;
        }

        activeIndex = index;

        triggers.forEach((trigger, triggerIndex) => {
            const active = triggerIndex === index;

            trigger.classList.toggle('bg-micronix-50', active);
            trigger.classList.toggle('text-micronix-600', active);
            trigger.classList.toggle('text-zinc-700', !active);

            const icon = trigger.querySelector(
                '[data-mega-menu-icon]',
            );

            const arrow = trigger.querySelector(
                '[data-mega-menu-arrow]',
            );

            if (icon) {
                icon.classList.toggle(
                    'text-micronix-600',
                    active,
                );

                icon.classList.toggle(
                    'text-zinc-400',
                    !active,
                );
            }

            if (arrow) {
                arrow.classList.toggle(
                    'translate-x-1',
                    active,
                );

                arrow.classList.toggle(
                    'text-micronix-600',
                    active,
                );

                arrow.classList.toggle(
                    'text-zinc-400',
                    !active,
                );
            }
        });

        panels.forEach((panel, panelIndex) => {
            const active = panelIndex === index;

            if (active) {
                panel.classList.remove(
                    'pointer-events-none',
                    'invisible',
                    'opacity-0',
                );

                panel.classList.add('opacity-100');

                return;
            }

            panel.classList.remove('opacity-100');

            panel.classList.add(
                'pointer-events-none',
                'invisible',
                'opacity-0',
            );
        });
    };

    triggers.forEach((trigger, index) => {
        trigger.addEventListener('mouseenter', () => {
            setActive(index);
        });

        trigger.addEventListener('focus', () => {
            setActive(index);
        });
    });
};

const initialiseMegaMenus = () => {
    document
        .querySelectorAll('[data-mega-menu]')
        .forEach(initialiseMegaMenu);
};

document.addEventListener(
    'DOMContentLoaded',
    initialiseMegaMenus,
);

document.addEventListener(
    'livewire:navigated',
    initialiseMegaMenus,
);