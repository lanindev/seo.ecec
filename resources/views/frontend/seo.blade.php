@extends("frontend.layout")

@section("title", __("frontend.seo"))

@section("content")
    <section class="header w-100 relative z-0 h-[60vh] overflow-hidden px-8 md:px-12">
        <div
            class="relative mx-auto flex h-full max-w-7xl items-center justify-between bg-contain bg-right bg-no-repeat"
            style="background-image: url('/storage/{{ $sections["banner"]->data["image"] }}')"
        >
            <div class="max-w-2xl flex-1">
                <div class="card-shadow border border-white border-opacity-20 bg-white bg-opacity-80 p-0 md:p-8 lg:p-12">
                    <div class="title mb-3 whitespace-pre-line text-4xl font-bold leading-tight text-gray-800 lg:text-5xl">
                        {{ $sections["banner"]->data["title"] }}
                    </div>
                    <p class="mb-4 whitespace-pre-line text-lg leading-relaxed text-gray-600 text-opacity-90 lg:text-xl">
                        {{ $sections["banner"]->data["subtitle"] }}
                    </p>

                    <div class="flex flex-col gap-4 sm:flex-row">
                        <a
                            href="{{ $sections["banner"]->data["button1_link"] }}"
                            target="_blank"
                            class="bg-{{ $sections["banner"]->data["button1_color"] }}-500 flex transform items-center justify-center rounded-md px-8 py-4 text-center font-semibold text-white transition-all duration-300 hover:scale-105 hover:shadow-lg"
                        >
                            {{ $sections["banner"]->data["button1_text"] }}
                        </a>
                        <a
                            href="{{ $sections["banner"]->data["button1_link"] }}"
                            target="_blank"
                            class="bg-{{ $sections["banner"]->data["button2_color"] }}-500 flex transform items-center justify-center rounded-md px-8 py-4 text-center font-semibold text-white transition-all duration-300 hover:scale-105 hover:shadow-lg"
                        >
                            {{ $sections["banner"]->data["button2_text"] }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="hidden flex-1 lg:block"></div>
        </div>
    </section>

    <section class="bg-slate-900">
        <div
            x-data="{
                activeFilter: 1,
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
            <div class="mb-12 text-left">
                <div class="mb-4 text-4xl font-bold text-white md:text-5xl">我們創造持久而遠高於服務收費的價值</div>
                <p class="mx-auto text-xl text-white">
                    收費透明，三個月見效。我們團隊會就多達200種信號優化您網站的權威性、相關性、及信任性。
                </p>
            </div>
            <div class="mb-12 flex flex-wrap justify-center gap-4">
                <template x-for="type in caseTypes" :key="type.id">
                    <button
                        @click="filterItems(type.id)"
                        :class="activeFilter === type.id ? 'text-sky-500 after:scale-x-100' : 'text-white after:scale-x-0'"
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
                        class="animate-on-scroll portfolio-item group cursor-pointer overflow-hidden rounded-xl shadow-lg transition-all duration-300 ease-in-out hover:-translate-y-2"
                        :data-id="item.id"
                    >
                        <div class="relative">
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
        <div class="mx-auto max-w-7xl px-6 py-20">
            <div class="mb-12 text-center">
                <div class="mb-4 text-2xl font-bold text-gray-800 md:text-3xl">{{ $sections["issues"]->data["title"] }}</div>
            </div>
            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($sections["issues"]->data["cards"] as $card)
                    <div
                        class="group rounded-2xl bg-white p-8 text-center shadow-md ring-1 ring-gray-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg"
                    >
                        @if ($card["icon"])
                            <div
                                class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-sky-500 text-white shadow-md transition-transform duration-300 group-hover:scale-110"
                            >
                                <i class="fas fa-{{ $card["icon"] }} text-3xl"></i>
                            </div>
                        @endif

                        @if ($card["title"])
                            <div class="mb-3 text-xl font-bold text-gray-800">{{ $card["title"] }}</div>
                        @endif

                        @if ($card["description"])
                            <p class="text-sm leading-relaxed text-gray-600">
                                {{ $card["description"] }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-gray-50">
        <div class="container mx-auto max-w-7xl px-6 py-20">
            <div class="mb-12 text-center">
                <div class="mb-4 text-4xl font-bold text-gray-900">{{ $sections["plans"]->data["title"] }}</div>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                @foreach ($sections["plans"]->data["cards"] as $plan)
                    <div
                        class="overflow-hidden rounded-2xl bg-white shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl"
                    >
                        <div class="p-8">
                            <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-sky-100">
                                <i class="fas fa-arrow-trend-up text-2xl text-sky-600"></i>
                            </div>

                            <div class="mb-2 text-2xl font-bold text-gray-900">{{ $plan["title"] }}</div>
                            <p class="mb-6 text-sm text-gray-600">{{ $plan["description"] }}</p>

                            <div class="mb-6">
                                <div class="flex items-baseline">
                                    <span class="text-4xl font-bold text-gray-900">${{ number_format($plan["price"]) }}</span>
                                </div>
                                <p class="mt-1 text-sm text-gray-600">每月（為期{{ number_format($plan["duration"]) }} 個月或以上）</p>
                            </div>

                            <ul class="mb-8 space-y-4">
                                @foreach (explode("\n", $plan["items"] ?? "") as $item)
                                    <li class="flex items-start">
                                        <i class="fas fa-check mr-3 mt-1 flex-shrink-0 text-green-500"></i>
                                        <span class="text-sm text-gray-700">{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <a
                                href="https://api.whatsapp.com/send?phone={{ setting("site.whatsapp") }}&text={{ urlencode("我想查詢你們的Marketing服務") }}"
                            >
                                <button
                                    class="w-full rounded-lg bg-sky-600 px-6 py-3 font-semibold text-white transition-colors duration-200 hover:bg-sky-700"
                                >
                                    免費諮詢
                                </button>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-frontend.page-content-components.consult-form :case_types_all="$case_types_all" />
@endsection

@push("scripts")

@endpush
