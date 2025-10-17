@props([
    "lang" => [],
    "PageTranslations" => [],
])

<!-- Footer -->
<footer class="bg-gray-200">
    <div class="mx-auto max-w-7xl space-y-6 px-6 py-10 text-sm text-gray-500">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset("images/logo.png") }}" alt="Logo" class="mx-auto h-10" />
                </div>
            </div>

            <div>
                <div class="space-y-3">
                    <h3 class="mb-4">Privacy Policy</h3>
                    <a
                        href="{{ route("page.view", ["slug" => "privacy_policy"]) }}"
                        class="block transition-colors duration-200 hover:underline"
                    >
                        {{ __("frontend.privacy_policy") }}
                    </a>
                    <a href="{{ route("page.view", ["slug" => "terms"]) }}" class="block transition-colors duration-200 hover:underline">
                        {{ __("frontend.terms") }}
                    </a>
                </div>
            </div>

            <div>
                <div class="space-y-3">
                    @if (setting("site.email"))
                        <div class="flex items-center space-x-1">
                            <i class="fas fa-envelope text-lg"></i>
                            <div>{{ setting("site.email") }}</div>
                        </div>
                    @endif

                    @if (setting("site.tel"))
                        <div class="flex items-center space-x-1">
                            <i class="fas fa-phone text-lg"></i>
                            <a href="tel:{{ setting("site.tel") }}">{{ formatPhoneNumber(setting("site.tel")) }}</a>
                        </div>
                    @endif

                    @if (setting("site.address"))
                        <div class="flex items-center space-x-1">
                            <i class="fas fa-map-marker-alt text-lg"></i>
                            <a href="https://www.google.com/maps?q={{ setting("site.address") }}"></a>
                            <div>{{ setting("site.address") }}</div>
                        </div>
                    @endif

                    <div class="flex space-x-3">
                        @if (setting("site.whatsapp"))
                            <a href="https://wa.me/{{ setting("site.whatsapp") }}">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    aria-label="WhatsApp"
                                    role="img"
                                    viewBox="0 0 512 512"
                                    width="30"
                                    height="30"
                                >
                                    <rect width="512" height="512" rx="15%" fill="#25d366" />
                                    <path fill="#25d366" stroke="#ffffff" stroke-width="26" d="M123 393l14-65a138 138 0 1150 47z" />
                                    <path
                                        fill="#ffffff"
                                        d="M308 273c-3-2-6-3-9 1l-12 16c-3 2-5 3-9 1-15-8-36-17-54-47-1-4 1-6 3-8l9-14c2-2 1-4 0-6l-12-29c-3-8-6-7-9-7h-8c-2 0-6 1-10 5-22 22-13 53 3 73 3 4 23 40 66 59 32 14 39 12 48 10 11-1 22-10 27-19 1-3 6-16 2-18"
                                    />
                                </svg>
                            </a>
                        @endif

                        @if (setting("site.wechat"))
                            <a href="">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    aria-label="WeChat"
                                    role="img"
                                    viewBox="0 0 512 512"
                                    width="30"
                                    height="30"
                                    fill="#ffffff"
                                >
                                    <rect width="512" height="512" rx="15%" fill="#00c70a" />
                                    <path
                                        d="M402 369c23-17 38 -42 38 -70c0-51 -50 -92 -111 -92s-110 41-110 92s49 92 110 92c13 0 25-2 36 -5c4-1 8 0 9 1l25 14c3 2 6 0 5-4l-6-22c0-3 2 -5 4 -6m-110-85a15 15 0 110-29a15 15 0 010 29m74 0a15 15 0 110-29a15 15 0 010 29"
                                    />
                                    <path
                                        d="m205 105c-73 0-132 50-132 111 0 33 17 63 45 83 3 2 5 5 4 10l-7 24c-1 5 3 7 6 6l30-17c3-2 7-3 11-2 26 8 48 6 51 6-24-84 59-132 123-128-10-52-65-93-131-93m-44 93a18 18 0 1 1 0-35 18 18 0 0 1 0 35m89 0a18 18 0 1 1 0-35 18 18 0 0 1 0 35"
                                    />
                                </svg>
                            </a>
                        @endif

                        @if (setting("site.facebook"))
                            <a href="https://www.facebook.com/{{ setting("site.facebook") }}">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    aria-label="Facebook"
                                    role="img"
                                    viewBox="0 0 512 512"
                                    width="30"
                                    height="30"
                                >
                                    <rect width="512" height="512" rx="15%" fill="#1877f2" />
                                    <path
                                        d="M355.6 330l11.4-74h-71v-48c0-20.2 9.9-40 41.7-40H370v-63s-29.3-5-57.3-5c-58.5 0-96.7 35.4-96.7 99.6V256h-65v74h65v182h80V330h59.6z"
                                        fill="#ffffff"
                                    />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <span>Copyright ©2025 {{ setting("site.site_name") }} All rights reserved</span>
        </div>
    </div>
</footer>
