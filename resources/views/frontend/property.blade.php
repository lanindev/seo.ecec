@extends("frontend.layout")

@section("title", $title)

@push("head")
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:description" content="{{ setting("site.description") }}" />
    <meta property="og:image" content="{{ asset("images/share_image.jpg") }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
@endpush

@section("content")
    <x-frontend.page-content-components.banner :title="$title" />

    <div x-data="propertyFilter()" class="min-h-screen bg-gray-50">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="mb-8 rounded-2xl border border-white/20 bg-white/80 shadow-lg backdrop-blur-sm">
                <div class="p-6">
                    <div class="flex flex-wrap items-end gap-4 lg:gap-6">
                        <div class="min-w-[200px] flex-1">
                            <label class="mb-2 block text-sm font-medium text-gray-700">
                                <i class="fas fa-location-dot text-red-500"></i>
                                地區
                            </label>
                            <div class="relative">
                                <select
                                    x-model="selectedArea"
                                    class="w-full cursor-pointer appearance-none rounded-xl border-0 bg-gray-50 px-4 py-3 pr-10 text-sm font-medium text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-opacity-50"
                                >
                                    <option value="">選擇地區</option>
                                    @foreach ($cities as $city)
                                        <optgroup label="{{ $city->name }} ({{ $city->areas->flatMap->properties->count() }})">
                                            @foreach ($city->areas as $area)
                                                <option value="{{ $area->id }}">
                                                    {{ $area->name }} ({{ $area->properties()->count() }})
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i class="fas fa-caret-down text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <div class="min-w-[200px] flex-1">
                            <label class="mb-2 block text-sm font-medium text-gray-700">
                                <i class="fas fa-filter text-sky-400"></i>
                                類型
                            </label>
                            <div class="relative">
                                <select
                                    x-model="selectedType"
                                    class="w-full cursor-pointer appearance-none rounded-xl border-0 bg-gray-50 px-4 py-3 pr-10 text-sm font-medium text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-opacity-50"
                                >
                                    <option value="">選擇類型</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }} ({{ $type->properties_count }} )</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i class="fas fa-caret-down text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button
                                @click="selectedArea = ''; selectedType = ''"
                                class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-500 transition-all duration-200 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50"
                                title="清除篩選"
                            >
                                <i class="fas fa-arrows-rotate"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-6 flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    共找到
                    <span x-text="filteredProperties.length" class="font-semibold text-gray-800"></span>
                    個
                </div>
                <div class="text-sm text-gray-500">
                    <span x-show="selectedArea || selectedType">已套用篩選條件</span>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <template x-for="property in filteredProperties" :key="property.id">
                    <a :href="'/property/' + property.id">
                        <div class="group overflow-hidden rounded-xl bg-white shadow-md">
                            <div class="relative h-56 overflow-hidden">
                                <img :src="property.hero_image" alt="" class="h-full w-full object-cover object-top" />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                <div class="absolute right-4 top-4 flex flex-wrap justify-end gap-2">
                                    <template x-for="type in property.types" :key="type">
                                        <span
                                            class="inline-flex items-center rounded-full bg-white/90 px-2.5 py-1 text-xs font-medium text-sky-600 backdrop-blur-sm"
                                        >
                                            <svg class="mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                                                ></path>
                                            </svg>
                                            <span x-text="type"></span>
                                        </span>
                                    </template>
                                </div>
                            </div>

                            <div class="p-5">
                                <div class="mb-3 flex items-start justify-between">
                                    <h3 class="line-clamp-2 text-lg font-semibold text-sky-500" x-text="property.name"></h3>
                                </div>

                                <div class="mb-3 flex items-center text-sm text-gray-500">
                                    <svg class="mr-2 h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                        ></path>
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                        ></path>
                                    </svg>
                                    <span x-text="property.area_name" class="truncate"></span>
                                </div>

                                {{-- <div class="mb-4 flex flex-wrap gap-2"> --}}
                                {{-- <template x-for="type in property.types" :key="type"> --}}
                                {{-- <span --}}
                                {{-- class="inline-flex items-center rounded-full bg-sky-100 px-2.5 py-1 text-xs font-medium text-sky-800" --}}
                                {{-- x-text="type" --}}
                                {{-- ></span> --}}
                                {{-- </template> --}}
                                {{-- </div> --}}

                                <div class="flex space-x-2">
                                    <button
                                        class="flex-1 rounded-lg bg-sky-600 px-4 py-2.5 text-sm font-medium text-white transition-colors duration-200 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2"
                                        class="flex-1 rounded-lg bg-sky-600 px-4 py-2.5 text-sm font-medium text-white transition-colors duration-200 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2"
                                    >
                                        了解詳情
                                    </button>
                                    {{-- <button --}}
                                    {{-- class="rounded-lg border border-gray-300 p-2.5 text-gray-400 transition-colors duration-200 hover:border-red-300 hover:text-red-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2" --}}
                                    {{-- > --}}
                                    {{-- <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"> --}}
                                    {{-- <path --}}
                                    {{-- stroke-linecap="round" --}}
                                    {{-- stroke-linejoin="round" --}}
                                    {{-- stroke-width="2" --}}
                                    {{-- d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" --}}
                                    {{-- ></path> --}}
                                    {{-- </svg> --}}
                                    {{-- </button> --}}
                                </div>
                            </div>
                        </div>
                    </a>
                </template>
            </div>

            <div x-show="filteredProperties.length === 0" class="py-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                    ></path>
                </svg>
                <div class="mt-4 text-lg font-medium text-gray-900">沒有符合條件的資料</div>
                <button
                    @click="selectedArea = ''; selectedType = ''"
                    class="mt-4 inline-flex items-center rounded-lg bg-sky-50 px-4 py-2 text-sm font-medium text-sky-600 transition-colors duration-200 hover:bg-sky-100 focus:outline-none focus:ring-2 focus:ring-sky-500"
                >
                    清除所有篩選
                </button>
            </div>
        </div>
    </div>

    @push("scripts")
        <script>
            function propertyFilter() {
                return {
                    selectedArea: '',
                    selectedType: '',
                    properties: @json($propertiesJson),
                    get filteredProperties() {
                        return this.properties.filter((p) => {
                            const areaMatch = this.selectedArea === '' || p.area_id == this.selectedArea;
                            const typeMatch = this.selectedType === '' || p.type_ids.includes(parseInt(this.selectedType));
                            return areaMatch && typeMatch;
                        });
                    },
                };
            }
        </script>
    @endpush
@endsection
