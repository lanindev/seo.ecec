@extends("frontend.layout")

@section("title", $case->title . " | " . __("frontend.cases"))

@push("head")

@endpush

@section("content")
    <style>
        .case-content h2,
        .case-content h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0ea5e9;
        }
    </style>
    <div class="mx-auto max-w-7xl px-4 py-8">
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="flex items-center text-base text-gray-600">
                <li>
                    <a href="{{ route("home") }}" class="flex items-center transition-colors hover:text-sky-600">首頁</a>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chevron-right mx-2 text-xs text-gray-400"></i>
                    <a href="{{ route("cases") }}" class="transition-colors hover:text-sky-600">客戶個案</a>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chevron-right mx-2 text-xs text-gray-400"></i>
                    <span class="font-medium text-gray-900">{{ $case->title }}</span>
                </li>
            </ol>
        </nav>
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
            <article class="rounded-lg bg-white p-4 shadow-md sm:p-8 lg:col-span-3">
                <header class="mb-8">
                    <h1 class="mb-4 text-3xl font-bold leading-tight text-gray-900">
                        {{ $case->title }}
                    </h1>
                </header>

                <div class="mb-8">
                    <img src="{{ asset("storage/" . $case->cover) }}" alt="網頁設計" class="w-full rounded-lg object-cover" />
                </div>

                <div class="case-content space-y-8 text-base">
                    @foreach ($case->content_components as $content_component)
                        @switch($content_component["type"])
                            @case("richtext")
                                <x-frontend.page-content-components.richtext :text="$content_component['data']['content']" />

                                @break
                            @case("image")
                                <x-frontend.page-content-components.image :src="asset('storage/'.$content_component['data']['path'])" />

                                @break
                        @endswitch
                    @endforeach
                </div>
            </article>

            <aside class="lg:col-span-1">
                <div class="sticky top-[64px] rounded-lg bg-white p-6 shadow-md">
                    <div class="mb-4 flex items-center text-base font-semibold text-gray-600">
                        <i class="fas fa-share-alt mr-2 text-sky-500"></i>
                        分享個案
                    </div>

                    <div class="space-y-3">
                        <a
                            href="https://www.facebook.com/sharer/sharer.php?u={{ route("case", ["id" => $case->id, "title" => $case->title]) }}"
                            target="_blank"
                            class="group flex items-center rounded-lg bg-sky-600 p-3 text-white transition-colors hover:bg-sky-700"
                        >
                            <i class="fab fa-facebook-f mr-3 text-xl"></i>
                            <span class="font-normal">Facebook</span>
                            <i class="fas fa-external-link-alt ml-auto opacity-0 transition-opacity group-hover:opacity-100"></i>
                        </a>

                        <a
                            href="https://api.whatsapp.com/send?text={{ urlencode("看看這個個案: " . route("case", ["id" => $case->id, "title" => $case->title])) }}"
                            target="_blank"
                            class="group flex items-center rounded-lg bg-green-500 p-3 text-white transition-colors hover:bg-green-700"
                        >
                            <i class="fab fa-whatsapp mr-3 text-xl"></i>
                            <span class="font-normal">WhatsApp</span>
                            <i class="fas fa-external-link-alt ml-auto opacity-0 transition-opacity group-hover:opacity-100"></i>
                        </a>

                        <button
                            onclick="navigator.clipboard.writeText('{{ request()->fullUrl() }}').then(() => alert('連結已複製！'))"
                            class="group flex w-full items-center rounded-lg bg-gray-600 p-3 text-white transition-colors hover:bg-gray-700"
                        >
                            <i class="fas fa-link mr-3 text-xl"></i>
                            <span class="font-normal">複製連結</span>
                            <i class="fas fa-copy ml-auto opacity-0 transition-opacity group-hover:opacity-100"></i>
                        </button>
                    </div>

                    <hr class="my-6 border-gray-200" />

                    <div class="mb-3 text-base font-medium text-gray-600">相關個案</div>
                    <div class="space-y-3">
                        @forelse ($relatedCases as $relatedCase)
                            <a
                                href="{{ route("case", ["id" => $relatedCase->id, "title" => $relatedCase->title]) }}"
                                class="block rounded-lg border border-gray-200 p-3 transition-colors hover:bg-gray-50"
                            >
                                <h5 class="mb-1 text-sm font-medium text-gray-900">{{ $relatedCase->title }}</h5>
                                <p class="text-xs text-gray-600"></p>
                            </a>
                        @empty
                            <p class="relative my-4 text-center text-sm text-gray-500">
                                <span class="relative z-10 bg-white px-2">尚無相關個案</span>
                                <span class="absolute left-0 top-1/2 -z-0 w-full border-t border-gray-300"></span>
                            </p>
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <script>
        function copyLink() {
            const url = window.location.href;

            if (navigator.clipboard) {
                navigator.clipboard
                    .writeText(url)
                    .then(() => {
                        alert('已複製！');
                    })
                    .catch((err) => {
                        console.error('Clipboard 複製失敗:', err);
                        fallbackCopy(url);
                    });
            } else {
                fallbackCopy(url);
            }
        }

        function fallbackCopy(url) {
            const textarea = document.createElement('textarea');
            textarea.value = url;
            document.body.appendChild(textarea);
            textarea.select();

            try {
                const successful = document.execCommand('copy');
                const message = successful ? '已複製！' : '複製失敗！';
                alert(message);
            } catch (err) {
                console.error('execCommand 複製失敗:', err);
                alert('複製失敗，請手動複製網址列的連結');
            }

            document.body.removeChild(textarea);
        }
    </script>
@endsection
