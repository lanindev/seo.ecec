@extends("frontend.layout")

@section("title", __("frontend.cases"))

@section("content")
    <style>
        .paginationSwiper .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            margin: 0 4px;
        }

        .paginationSwiper .swiper-pagination-bullet-active {
            background-color: #4b5563;
        }
    </style>

    <section>
        <div
            x-data="{
                activeFilter: 0,
                caseTypes: @js($case_types->map(fn ($t) => ["id" => $t->id, "name" => $t->name])),
                portfolioItems: @js($cases->map(
                            fn ($c) => [
                                "id" => $c->id,
                                "title" => $c->title,
                                "image" => asset("storage/" . $c->cover),
                                "case_type_id" => $c->case_type_id,
                                "case_type_name" => $c->caseType->name ?? "",
                            ],
                        )),
                filteredItems: [],
                init() {
                    this.filteredItems = [...this.portfolioItems]
                },
                filterItems(typeId) {
                    this.activeFilter = typeId

                    const newFiltered =
                        typeId === 0
                            ? this.portfolioItems
                            : this.portfolioItems.filter((i) => i.case_type_id === typeId)

                    const currentIds = new Set(this.filteredItems.map((i) => i.id))
                    const newIds = new Set(newFiltered.map((i) => i.id))

                    // Zoom-out
                    this.$refs.portfolioContainer
                        .querySelectorAll('.portfolio-item')
                        .forEach((el) => {
                            const id = parseInt(el.getAttribute('data-id'))
                            if (currentIds.has(id) && ! newIds.has(id)) {
                                el.classList.add('animate-zoom-out')
                            }
                        })

                    setTimeout(() => {
                        this.filteredItems = [...newFiltered]

                        // Zoom-in
                        this.$nextTick(() => {
                            this.$refs.portfolioContainer
                                .querySelectorAll('.portfolio-item')
                                .forEach((el) => {
                                    const id = parseInt(el.getAttribute('data-id'))
                                    if (newIds.has(id) && ! currentIds.has(id)) {
                                        el.classList.add('animate-zoom-in')
                                        el.addEventListener(
                                            'animationend',
                                            () => el.classList.remove('animate-zoom-in'),
                                            { once: true },
                                        )
                                    }
                                })
                        })
                    }, 300)
                },
            }"
            class="container mx-auto max-w-7xl px-6 py-20"
        >
            <div class="mb-12 text-center">
                <div class="mb-4 text-4xl font-bold text-gray-800 md:text-5xl">點擊分類，探索ECEC客戶個案</div>
                <p class="mx-auto max-w-2xl text-xl text-gray-600">我們引以自豪，來自香港各行各業的客戶</p>
            </div>
            <div class="mb-12 flex flex-wrap justify-between gap-4 sm:justify-center">
                <template x-for="type in caseTypes" :key="type.id">
                    <button
                        @click="filterItems(type.id)"
                        :class="activeFilter === type.id ? 'text-sky-500 after:scale-x-100' : 'text-gray-700 after:scale-x-0'"
                        class="relative rounded-full px-0 py-4 text-base font-medium outline-none transition-all duration-300 after:absolute after:bottom-0 after:left-1/2 after:h-[3px] after:w-full after:origin-center after:-translate-x-1/2 after:scale-x-0 after:bg-sky-500 after:transition-transform after:duration-300 after:content-[''] focus:outline-none md:px-6 md:text-2xl"
                        x-text="type.name"
                    ></button>
                </template>
            </div>

            <div x-ref="portfolioContainer" class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <template x-for="item in filteredItems" :key="item.id">
                    <a
                        :href="`/case/${item.id}/${encodeURIComponent(item.title)}`"
                        {{-- :href="`{{ route("case", ["id" => "id"]) }}/${item.id}/${encodeURIComponent(item.title)}`" --}}
                        class="animate-on-scroll portfolio-item group cursor-pointer overflow-hidden rounded-xl bg-white shadow-lg transition-all duration-300 ease-in-out hover:-translate-y-2 hover:shadow-2xl"
                        :data-id="item.id"
                    >
                        <div class="relative bg-gray-200">
                            <img
                                :src="item.image"
                                :alt="item.title"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                loading="lazy"
                            />
                            <div
                                class="absolute inset-0 flex items-center justify-center bg-sky-500/80 opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                            >
                                <div class="px-4 text-center text-3xl font-bold text-white" x-text="item.title"></div>
                            </div>
                        </div>
                    </a>
                </template>
            </div>

            <div x-show="filteredItems.length === 0" class="py-12 text-center">
                <svg class="mx-auto mb-4 h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                    />
                </svg>
                <p class="text-xl text-gray-500">目前沒有符合此分類的項目</p>
            </div>
        </div>
    </section>

    <section>
        <div class="bg-gray-600 px-2 py-6 text-center text-lg text-white">
            <p>我們對各行各業的市場營銷策略非常熟悉。</p>
            <p>客戶及合作機構遍佈全港，包括學校、科技機構、企業孵化計劃等等。</p>
        </div>
        <div class="mx-auto flex max-w-7xl justify-center">
            <img src="{{ asset("images/cases/all_logos.png") }}" class="w-100" />
        </div>
    </section>

    <section>
        @foreach ($case_showcases as $i => $case_showcase)
            <div class="flex justify-center py-8" style="background: {{ $case_showcase->content_components["color"] }}">
                <img src="/storage/{{ $case_showcase->content_components["logo"] }}" class="h-[60px]" />
            </div>
            <div class="mx-auto max-w-7xl px-4 py-20">
                <div class="mb-32">
                    <div class="grid items-center gap-12 lg:grid-cols-12">
                        <div class="{{ $i % 2 == 0 ? "lg:order-2" : "lg:order-1" }} order-2 space-y-10 lg:col-span-5">
                            <div>
                                <div class="mb-4 flex items-center gap-3">
                                    <i
                                        class="fas fa-user-tie text-2xl"
                                        style="color: {{ $case_showcase->content_components["color"] }}"
                                    ></i>
                                    <div class="text-2xl font-bold text-gray-600">客戶介紹</div>
                                </div>
                                <div class="space-y-3 pl-11">
                                    @foreach (explode("\n", $case_showcase->content_components["client_intro"] ?? "") as $intro)
                                        @if (trim($intro) !== "")
                                            <div class="flex items-start gap-3">
                                                <i
                                                    class="fas fa-thumbtack mt-1 shrink-0"
                                                    style="color: {{ $case_showcase->content_components["color"] }}"
                                                ></i>
                                                <p class="text-lg text-black">{{ trim($intro) }}</p>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <div class="mb-4 flex items-center gap-3">
                                    <i
                                        class="fas fa-lightbulb text-2xl"
                                        style="color: {{ $case_showcase->content_components["color"] }}"
                                    ></i>
                                    <div class="text-2xl font-bold text-gray-600">方案</div>
                                </div>
                                <div class="space-y-3 pl-11">
                                    @foreach (explode("\n", $case_showcase->content_components["solution"] ?? "") as $solution)
                                        @if (trim($solution) !== "")
                                            <div class="flex items-start gap-3">
                                                <i
                                                    class="fas fa-thumbtack mt-1 shrink-0"
                                                    style="color: {{ $case_showcase->content_components["color"] }}"
                                                ></i>
                                                <p class="text-lg text-black">{{ trim($solution) }}</p>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <div class="mb-4 flex items-center gap-3">
                                    <i
                                        class="fas fa-chart-line text-2xl"
                                        style="color: {{ $case_showcase->content_components["color"] }}"
                                    ></i>
                                    <div class="text-2xl font-bold text-gray-600">成效</div>
                                </div>
                                <p class="mb-6 pl-11 text-lg leading-relaxed text-black">
                                    {{ $case_showcase->content_components["result"] ?? "" }}
                                </p>
                                <div class="grid grid-cols-2 gap-6 pl-11">
                                    @foreach ($case_showcase->content_components["statistics"] as $stat)
                                        <div class="text-center">
                                            <div
                                                class="mb-2 text-5xl font-black"
                                                style="color: {{ $case_showcase->content_components["color"] }}"
                                            >
                                                <span class="countup">{{ $stat["number"] }}</span>
                                                <span class="text-3xl">{{ $stat["unit"] }}</span>
                                            </div>
                                            <div
                                                class="text-xl font-medium"
                                                style="color: {{ $case_showcase->content_components["color"] }}"
                                            >
                                                {{ $stat["label"] }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <a
                                    href="{{ $case_showcase->content_components["button"]["url"] }}"
                                    class="block w-full transform rounded-md px-8 py-4 text-center font-semibold text-white transition-all duration-300 hover:scale-105 hover:shadow-lg"
                                    style="background: {{ $case_showcase->content_components["color"] }}"
                                >
                                    {{ $case_showcase->content_components["button"]["text"] }}
                                </a>
                            </div>
                        </div>
                        <div
                            class="{{ $i % 2 == 0 ? "lg:order-1" : "lg:order-2" }} order-1 w-full max-w-full overflow-hidden lg:col-span-7"
                        >
                            <img src="/storage/{{ $case_showcase->content_components["image"] }}" />

                            <div class="swiper paginationSwiper mt-4 w-full max-w-full overflow-hidden !pb-[40px]">
                                <div class="swiper-wrapper">
                                    @foreach ($case_showcase->content_components["carousel"] as $carousel)
                                        <div class="swiper-slide">
                                            <img src="/storage/{{ $carousel }}" class="h-full w-full rounded-lg object-cover" />
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <x-frontend.page-content-components.consult-form :case_types_all="$case_types_all" />
@endsection

@push("scripts")
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.App && window.App.initCountUp) {
                window.App.initCountUp();
            }

            if (window.App && window.App.SwiperInit) {
                window.App.SwiperInit.pagination();
            }
        });
    </script>
@endpush
