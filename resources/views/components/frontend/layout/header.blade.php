@props([
    "slug",
])

<nav class="sticky top-0 z-50 bg-white shadow-lg" x-data="{ mobileMenuOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <div class="flex flex-shrink-0 items-center">
                    <div class="flex items-center justify-center">
                        <a href="/" class="flex items-center">
                            <img src="{{ asset("storage/" . setting("site.logo")) }}" alt="Company Logo" class="h-[36px] w-auto" />
                        </a>
                    </div>
                </div>
            </div>

            <!-- Desktop navigation -->
            <div class="hidden items-center space-x-8 md:flex">
                @foreach ($pages as $page)
                    <a
                        href="{{ route("page.view", $page->slug) }}"
                        class="{{ $slug === $page->slug ? "text-sky-500" : "text-gray-700 hover:text-sky-500" }} group relative p-1 text-base font-normal transition-all duration-300"
                    >
                        {{ $page->translations->first()?->name }}
                        <span
                            class="{{ $slug === $page->slug ? "w-full" : "w-0 group-hover:w-full" }} absolute bottom-0 left-0 h-0.5 bg-sky-500 transition-all duration-300"
                        ></span>
                    </a>
                @endforeach

                <div class="ml-8 flex items-center space-x-2">
                    <div class="flex flex-col">
                        <a
                            href="https://wa.me/{{ setting("site.whatsapp") }}"
                            target="_blank"
                            class="text-lg font-light text-gray-800 transition-colors duration-300 hover:text-sky-500"
                        >
                            <svg
                                height="30px"
                                width="30px"
                                version="1.1"
                                id="Capa_1"
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 58 58"
                                xml:space="preserve"
                            >
                                <g>
                                    <path
                                        style="fill: #2cb742"
                                        d="M0,58l4.988-14.963C2.457,38.78,1,33.812,1,28.5C1,12.76,13.76,0,29.5,0S58,12.76,58,28.5 S45.24,57,29.5,57c-4.789,0-9.299-1.187-13.26-3.273L0,58z"
                                    />
                                    <path
                                        style="fill: #ffffff"
                                        d="M47.683,37.985c-1.316-2.487-6.169-5.331-6.169-5.331c-1.098-0.626-2.423-0.696-3.049,0.42 c0,0-1.577,1.891-1.978,2.163c-1.832,1.241-3.529,1.193-5.242-0.52l-3.981-3.981l-3.981-3.981c-1.713-1.713-1.761-3.41-0.52-5.242 c0.272-0.401,2.163-1.978,2.163-1.978c1.116-0.627,1.046-1.951,0.42-3.049c0,0-2.844-4.853-5.331-6.169 c-1.058-0.56-2.357-0.364-3.203,0.482l-1.758,1.758c-5.577,5.577-2.831,11.873,2.746,17.45l5.097,5.097l5.097,5.097 c5.577,5.577,11.873,8.323,17.45,2.746l1.758-1.758C48.048,40.341,48.243,39.042,47.683,37.985z"
                                    />
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="relative flex h-8 w-8 items-center justify-center outline-none">
                    <span
                        class="absolute h-0.5 w-6 bg-sky-700 transition-transform duration-300 ease-in-out"
                        :class="mobileMenuOpen ? 'rotate-45' : '-translate-y-2'"
                    ></span>
                    <span
                        class="absolute h-0.5 w-6 bg-sky-700 transition-opacity duration-300 ease-in-out"
                        :class="mobileMenuOpen ? 'opacity-0' : 'opacity-100'"
                    ></span>
                    <span
                        class="absolute h-0.5 w-6 bg-sky-700 transition-transform duration-300 ease-in-out"
                        :class="mobileMenuOpen ? '-rotate-45' : 'translate-y-2'"
                    ></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile navigation menu -->
    <div x-show="mobileMenuOpen" x-transition class="z-100 fixed w-full md:hidden">
        <div class="space-y-1 border-t bg-white px-2 pb-3 pt-2 sm:px-3">
            @foreach ($pages as $page)
                <a
                    href="{{ route("page.view", $page->slug) }}"
                    class="{{ $slug === $page->slug ? "bg-sky-500 text-white" : "text-gray-700 hover:bg-sky-500 hover:text-white" }} block w-full rounded-md px-3 py-2 text-left text-base font-normal transition duration-200"
                >
                    {{ $page->translations->first()?->name ?? $page->slug }}
                </a>
            @endforeach
        </div>
    </div>
</nav>
