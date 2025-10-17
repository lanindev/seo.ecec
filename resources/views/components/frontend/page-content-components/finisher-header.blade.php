<div class="header finisher-header w-100 gradient-bg relative overflow-hidden" style="height: calc(80vh - 64px)">
    <div class="mx-auto flex h-full max-w-7xl items-center justify-between px-8 lg:px-16">
        <div class="max-w-2xl flex-1">
            <div class="card-shadow border border-white border-opacity-20 bg-white bg-opacity-80 p-8 backdrop-blur-lg lg:p-12">
                <h1 class="mb-6 text-4xl font-bold leading-tight text-gray-800 lg:text-6xl">
                    讓網絡推動
                    <span class="block bg-clip-text text-gray-800">您的影響力</span>
                </h1>

                <p class="mb-8 text-lg leading-relaxed text-gray-600 text-opacity-90 lg:text-xl">
                    為舉辦活動而設計的網站，令體驗、令影響力指數級成長
                </p>

                <div class="flex flex-col gap-4 sm:flex-row">
                    <button
                        class="transform rounded-md bg-blue-500 px-8 py-4 font-semibold text-white transition-all duration-300 hover:scale-105 hover:shadow-lg"
                    >
                        立即查詢
                    </button>
                    <button
                        class="transform rounded-md bg-green-500 px-8 py-4 font-semibold text-white transition-all duration-300 hover:scale-105 hover:shadow-lg"
                    >
                        品牌成功故事
                    </button>
                </div>
            </div>
        </div>
        <div class="relative flex hidden flex-1 items-center justify-center lg:flex">
            <img src="{{ asset("images/home/seo.png") }}" />
        </div>
    </div>
</div>

@once
    @push("scripts")
        <script src="https://finisher.co/lab/header/assets/finisher-header.es5.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (window.initFinisherHeader) {
                    window.initFinisherHeader();
                }
            });
        </script>
    @endpush
@endonce
