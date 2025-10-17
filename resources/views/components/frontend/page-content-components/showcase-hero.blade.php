@props([
    "data",
    "property" => null,
])

<div class="flex flex-col lg:flex-row">
    <div class="relative w-full lg:w-[70%]">
        <img
            src="{{ Str::startsWith($data["image"], "settings/") ? asset("storage/" . $data["image"]) : asset($data["image"]) }}"
            alt=""
            class="h-full w-full object-cover"
        />

        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30">
            <div class="flex items-center">
                <div class="mr-8 hidden h-32 w-1 bg-white sm:block"></div>

                <div class="px-4 text-left sm:px-0">
                    <h1 class="mb-4 text-3xl font-bold tracking-widest text-white sm:text-6xl">{{ $property->name }}</h1>
                    {{-- <div class="text-lg font-light tracking-[0.5em] text-white opacity-90 sm:text-2xl">DEMO</div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="flex w-full flex-col justify-center bg-sky-600 p-8 text-white lg:w-[30%]">
        <div class="space-y-8">
            <h2 class="text-xl font-bold sm:text-2xl">{{ $property->name }}</h2>

            <div class="leading-8">
                {!! $data["content"] !!}
            </div>

            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-white bg-opacity-20">
                        <i class="fas fa-tree-city"></i>
                    </div>
                    <span class="text-blue-100">{{ $property->propertyTypes->pluck("name")->implode(", ") }}</span>
                </div>

                @foreach ($data["icons"] as $icon)
                    <div class="flex items-center space-x-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-white bg-opacity-20">
                            <i class="fas fa-{{ $icon["icon"] }}"></i>
                        </div>
                        <span class="text-blue-100">{{ $icon["text"] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
