@extends("frontend.layout")

@section("title", __("frontend.home"))

@section("content")
    <div class="header finisher-header w-100 relative z-0 overflow-hidden" style="height: calc(80vh - 64px)">
        <div class="mx-auto flex h-full max-w-7xl items-center justify-between px-8 lg:px-16">
            <div class="max-w-2xl flex-1">
                <div class="card-shadow border border-white border-opacity-20 bg-white bg-opacity-80 p-8 backdrop-blur-lg lg:p-12">
                    <div class="title mb-6 whitespace-pre-line text-4xl font-bold leading-tight text-gray-800 lg:text-6xl">
                        {{ $banner->data["title"] }}
                    </div>

                    <p class="mb-8 text-lg leading-relaxed text-gray-600 text-opacity-90 lg:text-xl">
                        {{ $banner->data["subtitle"] }}
                    </p>

                    <div class="flex flex-col gap-4 sm:flex-row">
                        <a
                            href="{{ $banner->data["button1_link"] }}"
                            class="bg-{{ $banner->data["button1_color"] }}-500 transform rounded-md px-8 py-4 font-semibold text-white transition-all duration-300 hover:scale-105 hover:shadow-lg"
                        >
                            {{ $banner->data["button1_text"] }}
                        </a>
                        <a
                            href="{{ $banner->data["button2_link"] }}"
                            class="bg-{{ $banner->data["button2_color"] }}-500 transform rounded-md px-8 py-4 font-semibold text-white transition-all duration-300 hover:scale-105 hover:shadow-lg"
                        >
                            {{ $banner->data["button2_text"] }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="relative flex hidden flex-1 items-center justify-center lg:flex">
                <img src="{{ asset("storage/" . $banner->data["image"]) }}" loading="lazy" />
            </div>
        </div>
    </div>

    <!--- logo marquee --->
    <section class="overflow-hidden py-20 pt-10">
        <div class="relative my-5 w-full overflow-hidden whitespace-nowrap">
            <div class="inline-flex animate-marquee items-center gap-16">
                @for ($i=1;$i<=2;$i++)
                    @foreach ($media->data["images"] as $media_img)
                        <div
                            class="inline-flex min-w-[200px] items-center justify-center bg-white px-6 py-4 transition-transform duration-300 hover:-translate-y-1 hover:scale-105"
                        >
                            <img src="{{ asset("storage/" . $media_img) }}" class="block h-20 object-contain" loading="lazy" />
                        </div>
                    @endforeach
                @endfor
            </div>
        </div>

        <div class="marquee z-2 -rotate-2 overflow-hidden whitespace-nowrap bg-yellow-300">
            <div class="marquee_inner flex gap-4">
                @for ($x=1;$x<=3;$x++)
                    <div class="marquee_content text-[clamp(24px,2.5vw,40px)] font-bold text-black">
                        {{ $media->data["title"] }} &nbsp;&nbsp;
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!--- 客戶評價 --->
    <section>
        <div class="container relative mx-auto max-w-6xl px-4 py-16">
            <div class="mb-20 text-center">
                <div class="inline-block">
                    <div
                        class="mb-4 bg-gradient-to-r from-sky-400 via-sky-600 to-sky-700 bg-clip-text text-4xl font-bold leading-tight text-transparent md:text-5xl"
                    >
                        真實客戶評價
                    </div>
                    <div class="mb-8 h-2 w-full rounded-full bg-gradient-to-r from-sky-400 via-sky-600 to-sky-700"></div>
                </div>
                <div class="mx-auto max-w-3xl text-2xl font-medium text-gray-700">我們專注設計頂級用戶體驗的網頁</div>
                <div class="mt-8 flex items-center justify-center space-x-2">
                    <div class="flex text-3xl text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <span class="ml-3 text-xl text-gray-600">來自真實客戶</span>
                </div>
            </div>

            @php
                $testimonials = [
                    [
                        "name" => "Spencer Lam",
                        "title" => "Spencer Lam English 創辦人",
                        "stars" => 5,
                        "video_url" => "https://youtube.com/watch?v=dQw4w9WgXcQ",
                        "cover" => "https://flowdigital.com.hk/wp-content/uploads/2023/05/maxresdefault-1.jpg",
                        "content" =>
                            "非常多謝Ivan幫忙，短短一個月之內可以把我的網站，一年全新，可以放在全港首頁第一位。 <br /><br /> 其實之前用過好多坊間網絡營銷的公司，全港第一的公司都有用過，但是用了半年除了價格貴五倍，而且又未有效果，只係不斷叫我續加半年，而且有沒有跟進。最令我意外的是Ivan會願意在其他時間給予針對性的建議，令到我哋公司有所增長，營業額比起往年增加最少兩倍，大量成功見證 <br /><br /> 因為我比較少會讚人，所以Ivan真的是少有很有能力很有經驗的團隊，希望可以幫助到更多中小企或者大型公司發展。",
                    ],
                    [
                        "name" => "BEN LEE",
                        "title" => "《李維記》老闆",
                        "stars" => 5,
                        "video_url" => "https://youtube.com/watch?v=dQw4w9WgXcQ",
                        "cover" => "https://flowdigital.com.hk/wp-content/uploads/2023/07/Client-Interview-Youtube-Thumbnail.png",
                        "content" =>
                            "首先好多謝FlowDigital幫我們公司去設計了網站，裏面的內容、設計、風格很適合我們。日本的感覺的想法、而且設計都是很美麗的。 <br /><br /> 所以我好滿意，而另外接下來的我都會與FlowDigital繼續合作，會做到我自己本身的品牌李維記集團，而將所有我公司結合在裏面。 <br /><br /> 合作上最重要都是溝通，也是我們最注重的部分，所以這方面您公司是做得非常好的。我也問最後一條問題，如果要為我們的合作評一至十分，您會大概給多少分呢？ <br /><br /> 非常之開心，真的是十分。",
                    ],
                    [
                        "name" => "Leo Tam",
                        "title" => "首席室內設計師",
                        "stars" => 5,
                        "video_url" => "https://youtube.com/watch?v=dQw4w9WgXcQ",
                        "cover" => "https://flowdigital.com.hk/wp-content/uploads/2023/07/dicf1219229_07_600x400_1024.jpg",
                        "content" => "1. 合作過程是否順利？ 超級順利!! <br /><br /> 2. 合作能否滿足您的Marketing需要？ YES! <br /><br /> 3. 對服務是否滿意？ 好滿意! <br /><br /> 4. 最滿意的地方是？ FlowDigital 非常幫手 效率亦很高!! 期待SEO的成果 <br /><br /> 5. 5分滿分會給幾分？ 5 !",
                    ],
                    [
                        "name" => "Ms Priscilla",
                        "title" => "Ms Priscilla English創辦人",
                        "stars" => 5,
                        "video_url" => "https://youtube.com/watch?v=dQw4w9WgXcQ",
                        "cover" => "https://flowdigital.com.hk/wp-content/uploads/2023/07/ms-priscilla-english-learning.webp",
                        "content" => "我推薦這家SEO服務公司！他們的推廣策略和分析快速提供我的網站搜索結果中的排名。",
                    ],
                    [
                        "name" => "BEN LEE",
                        "title" => "《李維記》老闆",
                        "stars" => 5,
                        "video_url" => "https://youtube.com/watch?v=dQw4w9WgXcQ",
                        "cover" => "https://flowdigital.com.hk/wp-content/uploads/2023/07/precise1-1024x683.jpg",
                        "content" =>
                            "感謝Flowdigital為我們公司設計和建構網站。知道Flowdigital在與教育中心合作方面有豐富的經驗，所以我找他們來設計我的網站。和他們團隊的合作過程中感到非常愉快，他們為我客製化各種功能和設定，他們所有員工也非常友善，並樂意協助我修訂網站。 <br /><br /> 另一方面，知道Flowdigital提供SEO搜索引擎排名優化的服務，也讓我非常感興趣使用這家公司。我相信這是長期推廣網站和公司的最佳方式之一。再次感謝Flowdigital幫助我開展教育業務。",
                    ],
                ];
            @endphp

            <div class="columns-1 gap-x-8 md:columns-2">
                @foreach ($testimonials as $t)
                    <div class="mb-8 break-inside-avoid">
                        <div
                            class="transform rounded-3xl border border-white/20 bg-white/80 p-8 shadow-xl backdrop-blur-sm transition-all duration-500 hover:-translate-y-1 hover:shadow-2xl"
                        >
                            <div
                                class="group relative mb-6 cursor-pointer overflow-hidden"
                                onclick="window.open('{{ $t["video_url"] }}', '_blank')"
                            >
                                <img
                                    src="{{ $t["cover"] }}"
                                    alt="video_cover"
                                    class="aspect-[16/9] w-full object-cover transition-transform duration-300 group-hover:scale-105"
                                    loading="lazy"
                                />
                                <div
                                    class="absolute left-1/2 top-1/2 flex h-[60px] w-[60px] -translate-x-1/2 -translate-y-1/2 transform items-center justify-center rounded-full bg-black/70 transition-all duration-300 ease-in-out group-hover:scale-110 group-hover:bg-[rgba(255,0,0,0.9)]"
                                >
                                    <i class="fab fa-youtube text-2xl text-white"></i>
                                </div>
                            </div>
                            <div class="mb-4 flex items-center">
                                <div>
                                    <div class="font-roboto text-2xl font-bold text-sky-500">{{ $t["name"] }}</div>
                                    <p class="font-roboto text-lg text-sky-600">{{ $t["title"] }}</p>
                                    <div class="mt-2 flex text-xl text-yellow-400">
                                        @for ($i = 0; $i < $t['stars']; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <blockquote class="text-lg leading-relaxed text-gray-700">{!! $t["content"] !!}</blockquote>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 text-center md:mt-20">
                <div
                    class="inline-flex items-center rounded-full border border-white/20 bg-white/90 px-12 py-6 shadow-2xl backdrop-blur-sm"
                >
                    <div class="mr-6 text-left">
                        <div class="text-2xl font-bold text-orange-500 md:text-4xl">5星好評</div>
                        <div class="text-gray-600">來自 200+ 真實客戶</div>
                    </div>
                    <div class="flex text-xl text-yellow-400 md:text-3xl">
                        <i class="fas fa-star animate-pulse"></i>
                        <i class="fas fa-star animate-pulse delay-100"></i>
                        <i class="fas fa-star animate-pulse delay-200"></i>
                        <i class="fas fa-star animate-pulse delay-300"></i>
                        <i class="fas fa-star delay-400 animate-pulse"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--- 客戶成功案例 --->
    <section>
        <div
            x-data="{
                activeFilter: '全部',
                portfolioItems: [
                    {
                        title: '香港印刷中心',
                        category: '網頁建立及設計',
                        image: 'https://flowdigital.com.hk/wp-content/uploads/2024/03/FlowDigital-Client-Case-1-768x534.jpg',
                    },
                    {
                        title: 'Panda English',
                        category: 'SEO搜尋引擎優化',
                        image: 'https://flowdigital.com.hk/wp-content/uploads/2023/12/FlowDigital-Client-Case-768x534.jpg',
                    },
                    {
                        title: 'iMath',
                        category: 'SEO搜尋引擎優化',
                        image: 'https://flowdigital.com.hk/wp-content/uploads/2023/11/FlowDigital-Client-Case-30-768x534.png',
                    },
                    {
                        title: '補習配對平台 Upskyler ',
                        category: 'SEO搜尋引擎優化',
                        image: 'https://flowdigital.com.hk/wp-content/uploads/2023/12/FlowDigital-Client-Case-35-768x534.png',
                    },
                    {
                        title: '英文老師Ms Priscilla',
                        category: 'SEO搜尋引擎優化',
                        image: 'https://flowdigital.com.hk/wp-content/uploads/2023/12/FlowDigital-Client-Case-32-768x534.png',
                    },
                    {
                        title: 'Easy Math For Kids 珠心算課程',
                        category: '網頁建立及設計',
                        image: 'https://flowdigital.com.hk/wp-content/uploads/2023/11/FlowDigital-Client-Case-27-768x534.png',
                    },
                    {
                        title: '室內設計公司 Solid Idea',
                        category: '網頁建立及設計',
                        image: 'https://flowdigital.com.hk/wp-content/uploads/2023/12/FlowDigital-Client-Case-37-768x534.png',
                    },
                    {
                        title: '經致中文補習',
                        category: 'SEO搜尋引擎優化',
                        image: 'https://flowdigital.com.hk/wp-content/uploads/2023/12/FlowDigital-Client-Case-33-768x534.png',
                    },
                    {
                        title: 'First clean 滅蟲公司',
                        category: '網頁建立及設計',
                        image: 'https://flowdigital.com.hk/wp-content/uploads/2023/11/FlowDigital-Client-Case-28-768x534.png',
                    },
                ],
                filteredItems: [],
                init() {
                    this.filteredItems = [...this.portfolioItems]
                },
                filterItems(category) {
                    this.activeFilter = category

                    const newFiltered =
                        category === '全部'
                            ? this.portfolioItems
                            : this.portfolioItems.filter((i) => i.category === category)

                    const currentTitles = new Set(this.filteredItems.map((i) => i.title))
                    const newTitles = new Set(newFiltered.map((i) => i.title))

                    this.$refs.portfolioContainer
                        .querySelectorAll('.portfolio-item')
                        .forEach((el) => {
                            const title = el.querySelector('[x-text]').textContent
                            if (! newTitles.has(title)) {
                                el.classList.add('animate-zoom-out')
                            }
                        })

                    setTimeout(() => {
                        this.filteredItems = [...newFiltered]

                        // Zoom-in for newly added items
                        this.$nextTick(() => {
                            this.$refs.portfolioContainer
                                .querySelectorAll('.portfolio-item')
                                .forEach((el) => {
                                    const title = el.querySelector('[x-text]').textContent
                                    if (! currentTitles.has(title)) {
                                        el.classList.add('animate-zoom-in')
                                        el.addEventListener(
                                            'animationend',
                                            () => el.classList.remove('animate-zoom-in'),
                                            { once: true },
                                        )
                                    }
                                })
                        })
                    }, 300)
                },
            }"
            class="container mx-auto max-w-7xl px-6 py-20"
        >
            <div class="mb-12 text-center">
                <div class="mb-4 text-4xl font-bold text-gray-800 md:text-5xl">客戶成功案例</div>
                <p class="mx-auto max-w-2xl text-xl text-gray-600">我們引以自豪，來自香港各行各業的客戶</p>
            </div>

            <div class="mb-12 flex flex-wrap justify-between gap-4 sm:justify-center">
                <template x-for="category in ['全部','SEO搜尋引擎優化','網頁建立及設計']" :key="category">
                    <button
                        @click="filterItems(category)"
                        :class="activeFilter === category ? 'text-sky-500 after:scale-x-100' : 'text-gray-700 after:scale-x-0'"
                        class="relative rounded-full px-0 py-4 text-base font-medium outline-none transition-all duration-300 after:absolute after:bottom-0 after:left-1/2 after:h-[3px] after:w-full after:origin-center after:-translate-x-1/2 after:scale-x-0 after:bg-sky-500 after:transition-transform after:duration-300 after:content-[''] focus:outline-none md:px-6 md:text-2xl"
                        x-text="category"
                    ></button>
                </template>
            </div>

            <div x-ref="portfolioContainer" class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <template x-for="item in filteredItems" :key="item.title">
                    <div
                        class="animate-on-scroll portfolio-item group cursor-pointer overflow-hidden rounded-xl bg-white shadow-lg transition-all duration-300 ease-in-out hover:-translate-y-2 hover:shadow-2xl"
                    >
                        <div class="relative bg-gray-200">
                            <img
                                :src="item.image"
                                :alt="item.title"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                loading="lazy"
                            />
                            <div
                                class="absolute inset-0 flex items-center justify-center bg-sky-500/80 opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                            >
                                <div class="px-4 text-center text-3xl font-bold text-white" x-text="item.title"></div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <div x-show="filteredItems.length === 0" class="py-12 text-center">
                <svg class="mx-auto mb-4 h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                    />
                </svg>
                <p class="text-xl text-gray-500">目前沒有符合此分類的項目</p>
            </div>

            <div class="mt-10 flex justify-center">
                <button
                    class="transform rounded-md bg-sky-500 px-8 py-4 font-semibold text-white transition-all duration-300 hover:scale-105 hover:shadow-lg"
                >
                    更多品牌成功故事
                </button>
            </div>
        </div>
    </section>

    <!--- 全因我們注重技術與數據 打造專業的 Digital Marketing 和 SEO--->
    <section class="relative py-20">
        <div class="text-center">
            <div class="inline-block">
                <div
                    class="mb-4 whitespace-pre-line bg-gradient-to-r from-sky-400 via-sky-600 to-sky-700 bg-clip-text text-2xl font-bold !leading-[1.5] text-transparent md:text-4xl"
                >
                    {{ $tech->data["title"] }}
                </div>
                <div class="mb-8 h-2 w-full rounded-full bg-gradient-to-r from-sky-400 via-sky-600 to-sky-700"></div>
            </div>
        </div>
        <div class="relative my-5 w-full overflow-hidden whitespace-nowrap">
            <div class="inline-flex animate-marquee items-center gap-16">
                @for ($y=1;$y<=2;$y++)
                    @foreach ($tech->data["images"] as $tech_img)
                        <div
                            class="inline-flex min-w-[200px] items-center justify-center bg-white px-6 py-4 transition-transform duration-300 hover:-translate-y-1 hover:scale-105"
                        >
                            <img src="{{ asset("storage/" . $tech_img) }}" class="block h-20 object-contain" loading="lazy" />
                        </div>
                    @endforeach
                @endfor
            </div>
        </div>
    </section>

    <!--- 我們的理念 --->
    <section class="bg-white px-4 py-20">
        <div class="mx-auto max-w-6xl">
            <div class="mb-20 text-center">
                <div class="inline-block">
                    <p class="mb-4 text-2xl font-medium uppercase tracking-[0.3em] text-gray-500">OUR PHILOSOPHY</p>
                    <div
                        class="mb-4 bg-gradient-to-r from-sky-400 via-sky-600 to-sky-700 bg-clip-text text-4xl font-bold !leading-[1.5] text-transparent md:text-5xl"
                    >
                        我們的理念
                    </div>
                    <div class="flex justify-center">
                        <div class="mb-8 h-2 w-full rounded-full bg-gradient-to-r from-sky-400 via-sky-600 to-sky-700"></div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($ourPhilosophy->data["cards"] as $card)
                    <div class="flex h-full flex-col space-y-8 rounded-xl border border-sky-200 bg-white p-10 text-center shadow-lg">
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-sky-500">
                            <i class="fas fa-{{ $card["icon"] }} text-3xl text-white"></i>
                        </div>

                        <div class="text-3xl font-bold text-sky-500">{{ $card["title"] }}</div>

                        <div class="flex-grow whitespace-pre-line text-lg leading-relaxed text-gray-700">
                            {{ $card["content"] }}
                        </div>

                        <div class="flex justify-center">
                            <div class="h-0.5 w-16 bg-sky-500 opacity-50"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 flex justify-center">
                <a
                    href="{{ $ourPhilosophy->data["button_link"] }}"
                    class="transform rounded-md bg-sky-500 px-8 py-4 font-semibold text-white transition-all duration-300 hover:scale-105 hover:shadow-lg"
                >
                    <i class="fas fa-{{ $ourPhilosophy->data["button_icon"] }} mr-3"></i>
                    {{ $ourPhilosophy->data["button_text"] }}
                </a>
            </div>
        </div>
    </section>

    <!--- SEO搜尋引擎排名優化 --->
    <section>
        <div class="container mx-auto max-w-7xl px-6 py-20">
            <div class="mb-12 text-center">
                <div class="mb-4 text-4xl font-bold text-gray-800 md:text-5xl">{{ $seo->data["title"] }}</div>
                <p class="mx-auto max-w-2xl text-xl text-gray-600">{{ $seo->data["subtitle"] }}</p>
            </div>
            <div class="grid items-stretch gap-6 lg:grid-cols-2">
                <div class="space-y-6">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        @foreach ($seo->data["cards"] as $service)
                            <div
                                class="duration-400 group relative overflow-hidden rounded-3xl border-2 border-gray-100 p-8 transition-all hover:border-sky-500 hover:shadow-md"
                            >
                                <div class="flex flex-col items-start space-y-4">
                                    <div
                                        class="flex h-16 w-16 items-center justify-center rounded-full bg-sky-500 transition-transform duration-300 group-hover:scale-110"
                                    >
                                        <i class="fas fa-{{ $service["icon"] }} text-2xl text-white"></i>
                                    </div>

                                    <div class="text-xl font-bold text-gray-900">{{ $service["title"] }}</div>

                                    <p class="leading-relaxed text-gray-600">
                                        {{ $service["content"] }}
                                    </p>
                                </div>

                                <div class="pointer-events-none absolute inset-0 transition-all duration-300"></div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        <div
                            class="mb-6 rounded-md border border-dashed border-gray-300 bg-gray-50 p-3 text-center text-sm italic text-gray-700"
                        >
                            {{ $seo->data["remark"] }}
                        </div>

                        <div class="mt-4 flex justify-center">
                            <a
                                href="{{ $seo->data["button_link"] }}"
                                class="transform rounded-md bg-sky-500 px-8 py-4 font-semibold text-white transition-all duration-300 hover:scale-105 hover:shadow-lg"
                            >
                                {{ $seo->data["button_text"] }}
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="relative flex items-center justify-center overflow-hidden rounded-3xl bg-cover bg-center"
                    style="background-image: url({{ asset("storage/" . $seo->data["right_card_image"]) }})"
                >
                    <div class="absolute inset-0 bg-[#096fac]/75"></div>

                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute left-10 top-10 h-20 w-20 rounded-full border-2 border-white"></div>
                        <div class="absolute right-16 top-12 h-16 w-16 rotate-45 rounded-lg border-2 border-white"></div>
                        <div class="absolute bottom-20 left-20 h-12 w-12 rounded-full border-2 border-white"></div>
                        <div class="absolute bottom-12 right-10 h-24 w-24 rotate-12 rounded-lg border-2 border-white"></div>
                    </div>

                    <div class="z-10 max-w-3xl p-8 text-center text-white">
                        <div class="mb-8 animate-float">
                            <div class="mx-auto mb-4 flex h-24 w-24 items-center justify-center rounded-full bg-white/20 backdrop-blur-sm">
                                <i class="fas fa-rocket text-4xl text-white"></i>
                            </div>
                        </div>

                        <div class="mb-4 bg-white p-2 text-3xl font-bold text-sky-500">{{ $seo->data["right_card_title"] }}</div>
                        <div class="mb-8 whitespace-pre-line text-xl leading-relaxed">
                            {{ $seo->data["right_card_subtitle"] }}
                        </div>

                        {{-- <div class="mt-12 grid grid-cols-3 gap-6"> --}}
                        {{-- <div class="text-center"> --}}
                        {{-- <div class="mb-1 text-2xl font-bold">500+</div> --}}
                        {{-- <div class="text-sm opacity-80">成功案例</div> --}}
                        {{-- </div> --}}
                        {{-- <div class="text-center"> --}}
                        {{-- <div class="mb-1 text-2xl font-bold">95%</div> --}}
                        {{-- <div class="text-sm opacity-80">提升率</div> --}}
                        {{-- </div> --}}
                        {{-- <div class="text-center"> --}}
                        {{-- <div class="mb-1 text-2xl font-bold">24/7</div> --}}
                        {{-- <div class="text-sm opacity-80">監控</div> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}

                        <div class="absolute left-8 top-1/4 animate-float">
                            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white/10 backdrop-blur-sm">
                                <i class="fas fa-search text-2xl text-white"></i>
                            </div>
                        </div>

                        <div class="absolute right-8 top-1/3 animate-float">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/10 backdrop-blur-sm">
                                <i class="fas fa-chart-bar text-xl text-white"></i>
                            </div>
                        </div>

                        <div class="absolute bottom-1/4 left-12 animate-float">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 backdrop-blur-sm">
                                <i class="fas fa-link text-lg text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push("scripts")
    <!-- GSAP + ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.App && window.App.initFinisherHeader) {
                window.App.initFinisherHeader();
            }

            document.querySelectorAll('.marquee').forEach((el) => {
                App.GSAP.marquee(el, el.dataset.marqueeDuration);
            });

            gsap.from('.header img', {
                x: 200,
                opacity: 0,
                duration: 1,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: '.header',
                    start: 'top 80%',
                    toggleActions: 'play none none none',
                },
            });

            gsap.from('.finisher-header .title', {
                scale: 0.5,
                opacity: 0,
                duration: 1,
                ease: 'back.out(1.7)',
                scrollTrigger: {
                    trigger: '.finisher-header',
                    start: 'top 80%',
                    toggleActions: 'play none none none',
                },
            });
        });
    </script>
@endpush
