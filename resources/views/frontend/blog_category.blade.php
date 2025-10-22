@extends("frontend.layout")

@section("title", __("frontend.blog"))

@section("content")
    <!-- Header with Gradient -->
    <header class="relative overflow-hidden">
        <div class="container relative mx-auto px-4 py-16 text-center text-gray-700">
            <h1 class="mb-4 text-5xl font-bold drop-shadow-lg md:text-6xl">專欄 Blog</h1>
            <p class="mb-8 text-xl opacity-90">掌握SEO、網站設計和數碼營銷的藝術</p>
            <div class="relative mx-auto max-w-2xl">
                <input
                    type="text"
                    placeholder="搜尋"
                    class="w-full rounded-full px-6 py-4 pr-14 text-gray-800 shadow-md focus:outline-none focus:ring-2 focus:ring-sky-500/50"
                />
                <button
                    class="absolute right-2 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-sky-500 text-white shadow-md transition hover:bg-sky-600"
                >
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </header>

    <div class="mx-auto max-w-7xl px-4 py-8">
        <x-frontend.layout.breadcrumb :breadcrumbs="$breadcrumbs" />

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <!-- Main Content Area -->
            <main class="lg:col-span-2">
                <!-- Featured Article -->
                <div class="mb-12">
                    <h2 class="mb-6 flex items-center text-3xl font-bold text-gray-800">
                        <span class="mr-3 h-8 w-2 rounded-full bg-sky-500"></span>
                        最新文章
                    </h2>
                    @foreach ($articles as $article)
                        <a href="{{ route("blog_id", ["id" => $article->id, "title" => $article->title]) }}">
                            <div class="group relative mb-8 cursor-pointer overflow-hidden rounded-lg bg-white transition-all duration-500">
                                <div class="h-96 overflow-hidden bg-gray-300">
                                    @if (! empty($article->thumbnail))
                                        <img
                                            src="{{ asset("storage/" . $article->thumbnail) }}"
                                            alt="{{ $article->title }}"
                                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                                        />
                                    @else
                                        <div class="flex h-full items-center justify-center">
                                            <i
                                                class="fas fa-image text-8xl text-white opacity-30 transition-transform duration-500 group-hover:scale-110"
                                            ></i>
                                        </div>
                                    @endif
                                </div>

                                <div
                                    class="absolute bottom-0 left-0 right-0 z-20 bg-gradient-to-t from-black/60 via-black/40 to-transparent p-8 text-white"
                                >
                                    <div class="mb-3 flex items-center space-x-3">
                                        <span class="rounded-full bg-amber-500 px-4 py-1 text-sm font-semibold">
                                            {{ $article->category->name }}
                                        </span>
                                        <span class="text-sm text-white">{{ date("Y/m/d", strtotime($article->published_at)) }}</span>
                                    </div>
                                    <h3 class="mb-3 text-3xl font-bold transition group-hover:text-sky-300">
                                        {{ $article->title }}
                                    </h3>
                                    @foreach ($article->content_components as $component)
                                        @if ($component["type"] === "richtext")
                                            <p class="mb-4 line-clamp-1 text-xl text-white/90">
                                                {{ strip_tags($component["data"]["content"]) }}
                                            </p>

                                            @break
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </main>

            <!-- Sidebar -->
            <aside class="space-y-8 lg:col-span-1">
                <div class="rounded-lg bg-white p-6 shadow-md">
                    <h3 class="mb-4 flex items-center text-xl font-bold text-gray-800">文章分類</h3>
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
                </div>

                <div class="rounded-lg bg-white p-6 shadow-md">
                    <h3 class="mb-4 flex items-center text-xl font-bold text-gray-800">最新文章</h3>
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

                <!-- Newsletter -->
                {{-- <div class="rounded-lg bg-gradient-to-br from-sky-500 to-cyan-400 p-6 text-white shadow-md"> --}}
                {{-- <div class="mb-4 text-center"> --}}
                {{-- <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-white"> --}}
                {{-- <i class="fas fa-envelope text-2xl text-sky-500"></i> --}}
                {{-- </div> --}}
                {{-- <h3 class="mb-2 text-xl font-bold">訂閱電子報</h3> --}}
                {{-- <p class="text-sm opacity-90">每週精選內容直送信箱</p> --}}
                {{-- </div> --}}
                {{-- <input --}}
                {{-- type="email" --}}
                {{-- placeholder="輸入你的 Email" --}}
                {{-- class="mb-3 w-full rounded-xl px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-white" --}}
                {{-- /> --}}
                {{-- <button class="w-full rounded-xl bg-white py-3 font-bold text-sky-500 transition hover:bg-gray-100"> --}}
                {{-- <i class="fas fa-paper-plane mr-2"></i> --}}
                {{-- 立即訂閱 --}}
                {{-- </button> --}}
                {{-- </div> --}}

                <!-- Tags Cloud -->
                <div class="rounded-lg bg-white p-6 shadow-md">
                    <h3 class="mb-4 flex items-center text-xl font-bold text-gray-800">
                        <i class="fas fa-tags mr-2 text-sky-500"></i>
                        熱門標籤
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @php
                            $tags = [
                                "SEO",
                                "搜尋優化",
                                "網站排名",
                                "網頁速度",
                                "內部連結",
                                "外部連結",
                                "社群行銷",
                                "品牌經營",
                                "流量分析",
                                "市場趨勢",
                                "數據洞察",
                                "分析工具",
                                "成功個案",
                            ];
                        @endphp

                        @foreach ($tags as $tags_q)
                            <a
                                href="{{ route("blog", ["q" => $tags_q]) }}"
                                class="cursor-pointer rounded-full bg-sky-50 px-4 py-2 text-sm text-sky-600 transition hover:bg-sky-100"
                            >
                                {{ $tags_q }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection
