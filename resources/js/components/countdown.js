export function initCountdowns() {
    document.querySelectorAll('[data-countdown]').forEach((element) => {
        if (element.dataset.countdownInitialized === 'true') {
            return;
        }

        const endsAt = new Date(element.dataset.countdownEndsAt).getTime();

        const daysElement = element.querySelector('[data-countdown-days]');
        const hoursElement = element.querySelector('[data-countdown-hours]');
        const minutesElement = element.querySelector('[data-countdown-minutes]');
        const secondsElement = element.querySelector('[data-countdown-seconds]');

        if (Number.isNaN(endsAt)) {
            return;
        }

        element.dataset.countdownInitialized = 'true';

        let interval = null;

        const update = () => {
            const remaining = Math.max(0, endsAt - Date.now());
            const totalSeconds = Math.floor(remaining / 1000);

            const days = Math.floor(totalSeconds / 86400);
            const hours = Math.floor((totalSeconds % 86400) / 3600);
            const minutes = Math.floor((totalSeconds % 3600) / 60);
            const seconds = totalSeconds % 60;

            if (daysElement) {
                daysElement.textContent = String(days).padStart(2, '0');
            }

            if (hoursElement) {
                hoursElement.textContent = String(hours).padStart(2, '0');
            }

            if (minutesElement) {
                minutesElement.textContent = String(minutes).padStart(2, '0');
            }

            if (secondsElement) {
                secondsElement.textContent = String(seconds).padStart(2, '0');
            }

            if (remaining <= 0 && interval) {
                clearInterval(interval);

                element.dispatchEvent(
                    new CustomEvent('countdown:ended', {
                        bubbles: true,
                    })
                );
            }
        };

        update();

        interval = setInterval(update, 1000);
    });
}