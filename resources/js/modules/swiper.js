import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

export const SwiperInit = {
    basic() {
        new Swiper('.mySwiper', {
            loop: true,
            autoplay: { delay: 3000 },
        });
    },

    gallery() {
        document.querySelectorAll('.swiper-container-wrapper').forEach((wrapper) => {
            const thumbsSwiperEl = wrapper.querySelector('.thumbs-swiper');
            const mainSwiperEl = wrapper.querySelector('.main-swiper');

            if (!thumbsSwiperEl || !mainSwiperEl) return;

            const thumbsSwiper = new Swiper(thumbsSwiperEl, {
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: true,
                watchSlidesProgress: true,
            });

            const nextBtn = wrapper.querySelector('.swiper-button-next');
            const prevBtn = wrapper.querySelector('.swiper-button-prev');

            const mainSwiper = new Swiper(mainSwiperEl, {
                spaceBetween: 10,
                navigation:
                    nextBtn && prevBtn
                        ? {
                              nextEl: nextBtn,
                              prevEl: prevBtn,
                          }
                        : false,
                thumbs: {
                    swiper: thumbsSwiper,
                },
            });

            mainSwiper.on('slideChange', () => {
                const slides = thumbsSwiperEl.querySelectorAll('.swiper-slide');
                slides.forEach((slide, idx) => {
                    if (idx === mainSwiper.activeIndex) {
                        slide.classList.add('opacity-100', 'rounded-md');
                        slide.classList.remove('opacity-50');
                    } else {
                        slide.classList.remove('opacity-100');
                        slide.classList.add('opacity-50');
                    }
                });
            });

            mainSwiper.emit('slideChange');
        });
    },

    marquee() {
        new Swiper('.swiperMarquee', {
            loop: true,
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
            },
            spaceBetween: 0,
            centeredSlides: false,
            speed: 3000,
            slidesPerView: 'auto',
            allowTouchMove: false,
        });
    },

    pagination() {
        document.querySelectorAll('.paginationSwiper').forEach((swiperEl, index) => {
            new Swiper(swiperEl, {
                loop: true,
                speed: 600,
                autoplay: false,
                pagination: {
                    el: swiperEl.querySelector('.swiper-pagination'),
                    clickable: true,
                },
                slidesPerView: 1,
                spaceBetween: 20,
            });
        });
    },
};
