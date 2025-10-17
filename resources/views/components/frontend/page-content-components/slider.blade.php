@props([
    "data",
])

<div>
    <div class="swiper mySwiper relative w-full">
        <div class="swiper-wrapper">
            @foreach ($data["slides"] as $index => $slide)
                <div class="swiper-slide relative">
                    <img
                        src="{{ Str::startsWith($slide["image"], "settings/") ? asset("storage/" . $slide["image"]) : asset($slide["image"]) }}"
                        class="h-[60vh] w-full object-cover lg:h-[100vh]"
                        loading="lazy"
                        alt="Slide {{ $index + 1 }}"
                    />

                    <div class="absolute inset-0 flex flex-col items-center justify-center gap-20 px-4 text-center">
                        @if ($slide["title"])
                            <h1 class="text-4xl font-light text-white md:text-6xl">{{ $slide["title"] }}</h1>
                        @endif

                        @if ($slide["button_text"])
                            <a
                                href="{{ $slide["button_link"] ?? "#" }}"
                                class="bg-red-600 px-8 py-4 font-semibold text-white transition-colors duration-300 hover:bg-red-700"
                            >
                                {{ $slide["button_text"] }}
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@push("scripts")
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.App && window.App.SwiperInit) {
                window.App.SwiperInit.basic();
            }
        });
    </script>
@endpush
