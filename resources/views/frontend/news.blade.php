@extends("frontend.layout")

@section("title", __("frontend.news"))

@push("head")

@endpush

@section("content")
    <section class="container mx-auto max-w-6xl px-4 py-16">
        <div class="mb-12 text-center">
            <h1 class="mb-4 text-4xl font-bold text-gray-800 md:text-5xl">媒體報導</h1>
            <p class="mx-auto max-w-2xl text-xl text-gray-600">
                我們一直努力提供最專業的市場營銷服務，被各方媒體廣泛報道，亦得到大型科技企業、非牟利團體所頒發的獎項認可。
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($media_articles as $media_article)
                <a
                    href="{{ route("news_id", ["id" => $media_article->id, "title" => $media_article->title]) }}"
                    class="group cursor-pointer overflow-hidden rounded-lg bg-white shadow-lg transition-shadow duration-300 hover:shadow-2xl"
                >
                    <div class="relative overflow-hidden">
                        <img
                            src="/storage/{{ $media_article->thumbnail }}"
                            alt="media article {{ $media_article->id }}"
                            class="h-70 w-full object-cover object-top transition-transform duration-500 group-hover:scale-110"
                        />
                    </div>

                    <div class="p-6">
                        <h3 class="mb-4 line-clamp-2 text-xl font-bold text-gray-800 transition-colors group-hover:text-sky-500">
                            {{ $media_article->title }}
                        </h3>

                        <button
                            class="group inline-flex items-center font-semibold text-sky-500 transition-colors group-hover:text-sky-600"
                        >
                            閱讀更多
                            <i class="fas fa-chevron-right ml-2 transition-transform group-hover:translate-x-1"></i>
                        </button>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    <section>
        <div class="flex min-h-screen items-center justify-center px-4 py-20 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <div class="relative mx-auto max-w-2xl">
                    <div
                        class="absolute -top-4 left-1/2 h-12 w-48 -translate-x-1/2 rotate-2 transform bg-yellow-100 opacity-60 shadow-md"
                    ></div>
                    <div class="-rotate-1 transform border border-amber-200 bg-amber-50 p-10 shadow-lg">
                        <p class="text-3xl leading-relaxed text-gray-700">
                            行銷唯一的專家是消費者
                            <br />
                            就是你只要能打動消費者就行了。
                        </p>
                    </div>
                </div>

                <div class="my-16 space-y-10 text-gray-700">
                    <p class="whitespace-pre-line text-xl leading-loose sm:text-2xl">
                        近年來，我們ECEC團隊因其高質素的服務而獲得了社會的認可。
                        我們獨特的營銷方法已被領先的媒體所報道，並受到技術公司和非營利組織的讚揚
                        我們亦先後推出了平台、手機App等等，吸引過萬用戶使用，尋找適合的老師，亦為我們技術能力的一大肯定。
                        <br />
                        我們為此感到自豪，但真正激勵我們的是我們對客戶業務的影響。我們致力於提供最專業的營銷服務，幫助我們的客戶實現他們的目標，感謝你考慮讓我們成為你的夥伴。
                    </p>
                </div>

                <div>
                    <button
                        class="rounded-md bg-sky-500 px-12 py-4 text-xl font-semibold text-white transition-all duration-300 hover:bg-sky-600"
                    >
                        <i class="fab fa-whatsapp fa-xl mr-1"></i>

                        立即查詢
                    </button>
                </div>
            </div>
        </div>
    </section>

    <x-frontend.page-content-components.consult-form :case_types_all="$case_types_all" />
@endsection
