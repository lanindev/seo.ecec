<!-- Floating WhatsApp Button -->
<style>
    .whatsapp-tooltip {
        pointer-events: none;
    }
</style>
<a
    href="https://api.whatsapp.com/send?phone={{ setting("site.whatsapp") }}&text={{ urlencode("我想查詢你們的Marketing服務") }}"
    target="_blank"
    class="group fixed bottom-4 right-4 z-50 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-[#25D366]/30 md:bottom-6 md:right-6 print:hidden"
>
    <span class="absolute inset-0 animate-ping rounded-full bg-green-500/20"></span>

    <span
        class="relative grid h-14 w-14 place-items-center rounded-full bg-[#46c255] shadow-lg shadow-black/20 transition-transform duration-200 hover:scale-105 md:h-16 md:w-16"
    >
        <i class="fab fa-whatsapp text-2xl text-white"></i>
        <span class="sr-only">WhatsApp</span>
    </span>
    <div
        class="whatsapp-tooltip absolute right-16 top-1/2 -translate-y-1/2 transform whitespace-nowrap rounded-lg bg-gray-800 px-3 py-2 text-sm text-white opacity-0 transition-opacity duration-300 group-hover:opacity-100"
    >
        {{ __("frontend.contact_via_whatsapp") }}
        <div
            class="absolute left-full top-1/2 h-0 w-0 -translate-y-1/2 transform border-b-4 border-l-4 border-t-4 border-b-transparent border-l-gray-800 border-t-transparent"
        ></div>
    </div>
</a>
