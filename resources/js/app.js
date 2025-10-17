import './bootstrap';
import Alpine from 'alpinejs';

import { SwiperInit } from './modules/swiper';
import { initFinisherHeader } from './modules/finisher';
import { GSAP } from './modules/gsap';
import { initCountUp } from './modules/countup';

window.Alpine = Alpine;
Alpine.start();

window.App = {
    SwiperInit,
    initFinisherHeader,
    GSAP,
    initCountUp,
};
