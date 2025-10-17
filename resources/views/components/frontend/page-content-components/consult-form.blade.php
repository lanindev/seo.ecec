@props([
    "case_types_all",
])

<section class="bg-gray-100">
    <div class="mx-auto max-w-xl space-y-10 px-4 py-20">
        <div class="text-center text-4xl font-bold text-gray-800 md:text-5xl">免費咨詢專業團隊</div>

        <div class="mb-12 grid grid-cols-2 gap-6">
            <a
                href="https://api.whatsapp.com/send?phone={{ setting("site.whatsapp") }}&text={{ urlencode("我想查詢你們的Marketing服務") }}"
                target="_blank"
                class="group relative flex cursor-pointer items-center justify-center rounded-md bg-sky-500 px-8 py-4 font-semibold text-white transition-all duration-300 hover:bg-sky-600"
            >
                <i class="fab fa-whatsapp fa-xl mr-1"></i>
                立即查詢
            </a>

            <a
                href="/contact"
                class="group relative flex cursor-pointer items-center justify-center rounded-md border-2 border-sky-500 bg-white px-8 py-4 font-bold text-sky-500 transition-all duration-300 hover:bg-sky-50"
            >
                <i class="fas fa-phone mr-1"></i>
                聯絡我們
            </a>
        </div>

        {{-- <div class="mb-8 flex items-center gap-3 text-2xl font-bold text-gray-800"> --}}
        {{-- <div class="h-8 w-1 rounded-full bg-sky-500"></div> --}}
        {{-- 聯絡我們 --}}
        {{-- </div> --}}

        {{-- <div class="space-y-6"> --}}
        {{-- <div> --}}
        {{-- <label class="mb-3 block text-lg font-semibold text-gray-700"> --}}
        {{-- 電郵地址 --}}
        {{-- <span class="text-sky-500">*</span> --}}
        {{-- </label> --}}
        {{-- <div class="relative"> --}}
        {{-- <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4"> --}}
        {{-- <i class="far fa-envelope text-gray-700"></i> --}}
        {{-- </div> --}}
        {{-- <input --}}
        {{-- type="email" --}}
        {{-- placeholder="example@email.com" --}}
        {{-- class="w-full rounded-xl border-2 border-gray-200 py-4 pl-12 pr-4 placeholder-gray-400 transition focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-200" --}}
        {{-- /> --}}
        {{-- </div> --}}
        {{-- </div> --}}

        {{-- <div> --}}
        {{-- <label class="mb-3 block text-lg font-semibold text-gray-700"> --}}
        {{-- 機構名稱或您的姓名 --}}
        {{-- <span class="text-sky-500">*</span> --}}
        {{-- </label> --}}
        {{-- <div class="relative"> --}}
        {{-- <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4"> --}}
        {{-- <i class="far fa-user text-gray-700"></i> --}}
        {{-- </div> --}}
        {{-- <input --}}
        {{-- type="text" --}}
        {{-- placeholder="請輸入您的姓名或機構名稱" --}}
        {{-- class="w-full rounded-xl border-2 border-gray-200 py-4 pl-12 pr-4 placeholder-gray-400 transition focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-200" --}}
        {{-- /> --}}
        {{-- </div> --}}
        {{-- </div> --}}

        {{-- <div> --}}
        {{-- <label class="mb-3 block text-lg font-semibold text-gray-700"> --}}
        {{-- 聯絡電話 --}}
        {{-- <span class="text-sky-500">*</span> --}}
        {{-- </label> --}}
        {{-- <div class="relative"> --}}
        {{-- <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4"> --}}
        {{-- <svg class="h-5 w-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"> --}}
        {{-- <path --}}
        {{-- stroke-linecap="round" --}}
        {{-- stroke-linejoin="round" --}}
        {{-- stroke-width="2" --}}
        {{-- d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" --}}
        {{-- ></path> --}}
        {{-- </svg> --}}
        {{-- </div> --}}
        {{-- <input --}}
        {{-- type="tel" --}}
        {{-- placeholder="+886 912 345 678" --}}
        {{-- class="w-full rounded-xl border-2 border-gray-200 py-4 pl-12 pr-4 placeholder-gray-400 transition focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-200" --}}
        {{-- /> --}}
        {{-- </div> --}}
        {{-- </div> --}}

        {{-- <div> --}}
        {{-- <label class="mb-3 block text-lg font-semibold text-gray-700"> --}}
        {{-- 諮詢類別 --}}
        {{-- <span class="text-sky-500">*</span> --}}
        {{-- </label> --}}
        {{-- <div class="relative"> --}}
        {{-- <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4"> --}}
        {{-- <i class="far fa-comments text-gray-700"></i> --}}
        {{-- </div> --}}
        {{-- <select --}}
        {{-- class="w-full appearance-none rounded-xl border-2 border-gray-200 bg-white py-4 pl-12 pr-4 text-gray-700 transition invalid:text-gray-700 focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-200" --}}
        {{-- > --}}
        {{-- <option value="">請選擇諮詢類別</option> --}}
        {{-- @foreach ($case_types_all as $case_type) --}}
        {{-- <option value="{{ $case_type->id }}">{{ $case_type->name }}</option> --}}
        {{-- @endforeach --}}
        {{-- </select> --}}
        {{-- <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4"> --}}
        {{-- <svg class="h-5 w-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"> --}}
        {{-- <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path> --}}
        {{-- </svg> --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- </div> --}}

        {{-- <div class="pt-6"> --}}
        {{-- <button --}}
        {{-- class="flex w-full items-center justify-center gap-3 rounded-md bg-sky-500 px-8 py-4 text-lg font-semibold text-white transition-all duration-300 hover:bg-sky-600" --}}
        {{-- > --}}
        {{-- 送出 --}}
        {{-- </button> --}}
        {{-- </div> --}}
        {{-- </div> --}}
    </div>
</section>
