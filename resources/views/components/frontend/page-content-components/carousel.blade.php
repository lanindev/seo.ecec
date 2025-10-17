@props([
    "data",
])

@php
    $images = $data["images"] ?? [];
@endphp

@if (count($images))
    <div class="swiper-container-wrapper {{ request()->segment(1) === "property" && is_numeric(request()->segment(2)) ? "py-8" : "" }}">
        <div class="swiper main-swiper mb-6 aspect-video w-full overflow-hidden rounded-lg shadow-lg">
            <div class="swiper-wrapper">
                @foreach ($images as $index => $img)
                    <div class="swiper-slide">
                        <img
                            src="{{ asset("storage/" . $img) }}"
                            class="h-full w-full object-cover"
                            loading="lazy"
                            alt="swiper-slide-{{ $index + 1 }}"
                        />
                    </div>
                @endforeach
            </div>

            <div class="swiper-button-prev !left-2 !z-10 !text-white"></div>
            <div class="swiper-button-next !right-2 !z-10 !text-white"></div>
        </div>
        <div class="swiper thumbs-swiper h-[100px] w-full overflow-hidden rounded-lg">
            <div class="swiper-wrapper">
                @foreach ($images as $index => $img)
                    <div
                        class="swiper-slide cursor-pointer overflow-hidden rounded-md opacity-50 transition-opacity duration-300 hover:opacity-80"
                    >
                        <img
                            src="{{ Str::startsWith($img, "settings/") ? asset("storage/" . $img) : asset($img) }}"
                            class="h-full w-full object-cover"
                            loading="lazy"
                            alt="swiper-slide-thumbs-{{ $index + 1 }}"
                        />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

@push("scripts")
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.App && window.App.SwiperInit) {
                window.App.SwiperInit.gallery();
            }
        });
    </script>
@endpush
