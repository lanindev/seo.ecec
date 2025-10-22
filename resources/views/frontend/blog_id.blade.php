@extends("frontend.layout")

@section("title", $article->title . " | " . __("frontend.blog"))

@push("head")

@endpush

@section("content")
    <div class="mx-auto mb-20 max-w-7xl px-4 py-8">
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="flex flex-wrap items-center text-base text-gray-600">
                <li>
                    <a href="{{ route("home") }}" class="flex items-center transition-colors hover:text-sky-600">首頁</a>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chevron-right mx-2 text-xs text-gray-400"></i>
                    <a href="{{ route("blog") }}" class="transition-colors hover:text-sky-600">{{ __("frontend.blog") }}</a>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chevron-right mx-2 text-xs text-gray-400"></i>
                    <a href="#" class="transition-colors hover:text-sky-600">{{ $article->category->name }}</a>
                </li>
                <li class="flex items-center break-words">
                    <i class="fas fa-chevron-right mx-2 text-xs text-gray-400"></i>
                    <span class="break-words font-medium text-gray-900">{{ $article->title }}</span>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
            <div class="rounded-lg bg-white p-4 shadow-md sm:p-8 lg:col-span-3">
                <article>
                    <header class="mb-8">
                        <h1 class="mb-4 text-3xl font-bold leading-tight text-gray-900">
                            {{ $article->title }}
                        </h1>

                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <div class="flex items-center gap-2">
                                <i class="far fa-calendar-alt text-sky-500"></i>
                                <time datetime="{{ $article->published_at }}">
                                    {{ date("Y年m月d日", strtotime($article->published_at)) }}
                                </time>
                            </div>
                            @if ($article->category)
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-folder text-sky-500"></i>
                                    <span>{{ $article->category->name }}</span>
                                </div>
                            @endif
                        </div>
                    </header>

                    @if ($article->thumbnail)
                        <div class="mb-8">
                            <img
                                src="{{ asset("storage/" . $article->thumbnail) }}"
                                alt="thumbnail"
                                class="w-full rounded-lg object-cover"
                            />
                        </div>
                    @endif

                    <div class="space-y-8 text-base">
                        @foreach ($article->content_components as $content_component)
                            @switch($content_component["type"])
                                @case("richtext")
                                    <x-frontend.page-content-components.richtext :text="$content_component['data']['content']" />

                                    @break
                                @case("image")
                                    <x-frontend.page-content-components.image
                                        :src="asset('storage/'.$content_component['data']['path'])"
                                    />

                                    @break
                            @endswitch
                        @endforeach
                    </div>
                </article>
                <div class="mt-8 pt-8">
                    <div class="flex items-center justify-center gap-6">
                        <div class="h-px flex-1 bg-gray-200"></div>
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-medium text-gray-500">分享</span>
                            <a
                                href="https://www.facebook.com/sharer/sharer.php?u={{ route("case", ["id" => $article->id, "title" => $article->title]) }}"
                                target="_blank"
                                class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#1877F2] text-white shadow-sm transition-all hover:scale-110 hover:shadow-md"
                            >
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a
                                href="https://api.whatsapp.com/send?text={{ urlencode("看看這篇文章: " . route("case", ["id" => $article->id, "title" => $article->title])) }}"
                                target="_blank"
                                class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#25D366] text-white shadow-sm transition-all hover:scale-110 hover:shadow-md"
                            >
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <button
                                onclick="navigator.clipboard.writeText('{{ request()->fullUrl() }}').then(() => alert('連結已複製！'))"
                                class="flex h-10 w-10 items-center justify-center rounded-lg bg-gray-600 text-white shadow-sm transition-all hover:scale-110 hover:bg-gray-700 hover:shadow-md"
                            >
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                        <div class="h-px flex-1 bg-gray-200"></div>
                    </div>
                </div>
            </div>

            <aside class="lg:col-span-1">
                <div class="sticky top-[64px] rounded-lg bg-white p-6 shadow-md">
                    <div class="mb-4 flex items-center text-xl font-bold text-gray-800">文章分類</div>
                    <div class="space-y-1">
                        <a
                            href="{{ route("blog") }}"
                            class="{{ ! isset($current_category) ? "text-sky-500 underline" : "text-gray-700 underline hover:text-sky-500" }} flex w-full items-center justify-between rounded-xl px-4 py-3 font-semibold transition"
                        >
                            全部文章
                        </a>

                        @foreach ($post_categories as $post_category)
                            <a
                                href="{{ route("blog_category", ["slug" => $post_category->slug]) }}"
                                class="{{
                                    isset($current_category) && $current_category->slug === $post_category->slug
                                        ? "text-sky-500"
                                        : "text-gray-700 hover:text-sky-500"
                                }} flex w-full items-center justify-between rounded-xl px-4 py-3 font-semibold underline transition"
                            >
                                {{ $post_category->name }}
                            </a>
                        @endforeach
                    </div>

                    <hr class="my-6 border-gray-200" />

                    <div class="mb-4 flex items-center text-xl font-bold text-gray-800">最新文章</div>
                    <div class="space-y-2">
                        @foreach ($latest_articles as $latest_article)
                            <a
                                href="{{ route("blog_id", ["id" => $latest_article->id, "title" => $latest_article->title]) }}"
                                class="group flex items-start gap-3 rounded-lg px-3 py-2 transition hover:bg-sky-50"
                            >
                                <span class="flex-1 font-medium text-gray-700 transition group-hover:text-sky-500">
                                    {{ $latest_article->title }}
                                </span>
                            </a>
                        @endforeach
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
