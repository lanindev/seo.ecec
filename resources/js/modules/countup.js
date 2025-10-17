import { CountUp } from 'countup.js';

export function initCountUp() {
    const items = document.querySelectorAll('.countup');

    if (!items.length) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const targetText = el.textContent.trim();
                    const target = parseFloat(targetText);
                    const decimals = (targetText.split('.')[1] || '').length;

                    el.textContent = '0';

                    const countUp = new CountUp(el, target, {
                        duration: 2,
                        decimalPlaces: decimals,
                        separator: '',
                    });

                    if (!countUp.error) countUp.start();
                    observer.unobserve(el);
                }
            });
        },
        { threshold: 0.5 },
    );

    items.forEach((item) => observer.observe(item));
}
