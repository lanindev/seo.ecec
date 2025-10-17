@props([
    "images",
])

<div class="w-full overflow-hidden">
    <div class="swiper brand-swiper">
        <div class="swiper-wrapper">
            {{-- @foreach ($images as $image) --}}
            {{-- <div class="swiper-slide flex-shrink-0"> --}}
            {{-- <img src="{{ $image }}" alt="Brand" class="h-20 object-contain" /> --}}
            {{-- </div> --}}
            {{-- @endforeach --}}

            {{-- @foreach ($images as $image) --}}
            {{-- <div class="swiper-slide flex-shrink-0"> --}}
            {{-- <img src="{{ $image }}" alt="Brand" class="h-20 object-contain" /> --}}
            {{-- </div> --}}
            {{-- @endforeach --}}
        </div>
    </div>
</div>

<script type="module">
    import Swiper, { Autoplay } from 'swiper';
    import 'swiper/css';

    new Swiper('.brand-swiper', {
        modules: [Autoplay],
        slidesPerView: 'auto',
        spaceBetween: 30,
        loop: true,
        speed: 3000,
        autoplay: {
            delay: 0,
            disableOnInteraction: false,
        },
    });
</script>
