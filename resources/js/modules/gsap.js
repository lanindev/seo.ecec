// resources/js/modules/gsap.js
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export const GSAP = {
    gsap,
    ScrollTrigger,

    marquee(marqueeElement, duration = 30) {
        const marqueeInner = marqueeElement.querySelector('.marquee_inner');
        const marqueeContent = marqueeInner.querySelector('.marquee_content');

        const containerWidth = marqueeElement.offsetWidth;
        const contentWidth = marqueeContent.offsetWidth;

        let totalWidth = contentWidth;
        while (totalWidth < containerWidth * 2) {
            const clone = marqueeContent.cloneNode(true);
            marqueeInner.append(clone);
            totalWidth += contentWidth;
        }

        gsap.set(marqueeInner, { x: -contentWidth });
        gsap.to(marqueeInner, {
            x: 0,
            repeat: -1,
            duration: duration,
            ease: 'linear',
        });
    },
};
