<?php

namespace Database\Seeders;

use App\Models\HomeSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class HomeSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'key' => 'banner',
                'name' => '橫幅',
                'data' =>
                    [
                        "title" => "讓網絡推動\n您的影響力",
                        "subtitle" => "為舉辦活動而設計的網站，令體驗、令影響力指數級成長",
                        "button1_text" => "立即查詢",
                        "button1_color" => "sky",
                        "button1_link" => "/",
                        "button2_text" => "品牌成功故事",
                        "button2_color" => "green",
                        "button2_link" => "/cases",
                        "image" => $this->copyImageToStorage("images/home/seo.webp", 'home_sections/banner')
                    ]
            ],
            [
                'key' => 'media',
                'name' => '媒體機構',
                'data' => [
                    "title" => "超過10次媒體、機構追訪及獲獎",
                    "images" =>
                        [
                            $this->copyImageToStorage("images/home/media/1.webp", 'home_sections/media'),
                            $this->copyImageToStorage("images/home/media/2.webp", 'home_sections/media'),
                            $this->copyImageToStorage("images/home/media/3.webp", 'home_sections/media'),
                            $this->copyImageToStorage("images/home/media/4.webp", 'home_sections/media'),
                            $this->copyImageToStorage("images/home/media/5.webp", 'home_sections/media'),
                            $this->copyImageToStorage("images/home/media/6.webp", 'home_sections/media'),
                            $this->copyImageToStorage("images/home/media/7.webp", 'home_sections/media'),
                            $this->copyImageToStorage("images/home/media/8.webp", 'home_sections/media'),
                            $this->copyImageToStorage("images/home/media/9.webp", 'home_sections/media'),
                            $this->copyImageToStorage("images/home/media/10.webp", 'home_sections/media')
                        ]
                ]
            ],
            [
                'key' => 'tech_and_data',
                'name' => '技術與數據',
                'data' =>
                    [
                        "title" => "全因我們注重技術與數據\n打造專業的 Digital Mark",
                        "images" => [
                            $this->copyImageToStorage("images/home/tech/1.webp", 'home_sections/tech_and_data'),
                            $this->copyImageToStorage("images/home/tech/2.webp", 'home_sections/tech_and_data'),
                            $this->copyImageToStorage("images/home/tech/3.webp", 'home_sections/tech_and_data'),
                            $this->copyImageToStorage("images/home/tech/4.webp", 'home_sections/tech_and_data'),
                            $this->copyImageToStorage("images/home/tech/5.webp", 'home_sections/tech_and_data'),
                            $this->copyImageToStorage("images/home/tech/6.webp", 'home_sections/tech_and_data'),
                            $this->copyImageToStorage("images/home/tech/7.webp", 'home_sections/tech_and_data')
                        ]
                    ]
            ],
            [
                'key' => 'our_philosophy',
                'name' => '我們的理念',
                'data' =>
                    [
                        "cards" => [
                            [
                                "icon" => "chart-line",
                                "title" => "# 數據為本",
                                "content" => "以網站數據的上升證明實力，客戶好評不斷。只接收同行業限定數量的客戶，每個客戶都是VVIP"
                            ],
                            [
                                "icon" => "comments",
                                "title" => "# 溝通",
                                "content" => "為每個客戶進行詳細質詢，合作期間緊密匯報計畫進展，樂意解答所有Marketing問題及互相交流"
                            ],
                            [
                                "icon" => "handshake",
                                "title" => "# 信賴",
                                "content" => "價錢及合作過程透明，無隱藏收費，過程中持續匯報計畫進展和成績，信賴為大部分公司成為我們回頭客的最大原因"
                            ]
                        ],
                        "button_icon" => "paper-plane",
                        "button_text" => "立即查詢",
                        "button_link" => "/"
                    ]
            ],
            [
                'key' => 'seo',
                'name' => 'SEO搜尋引擎排名優化',
                'data' =>
                    [
                        "title" => "SEO搜尋引擎排名優化",
                        "subtitle" => "客製化，度身訂做最有效的自然營銷策略",
                        "cards" => [
                            [
                                "icon" => "search",
                                "title" => "網站關鍵詞問題診斷",
                                "content" => "為客戶找出網站圖文問題，一一提出修改方案，使網站結構符合Google理想排名原則"
                            ],
                            [
                                "icon" => "chart-line",
                                "title" => "關鍵詞分析",
                                "content" => "分析客戶公司業務，行業特性及競爭對手線上策略，揭破最適合客戶的SEO策略"
                            ],
                            [
                                "icon" => "crown",
                                "title" => "關鍵詞選擇",
                                "content" => "詳細分析各關鍵詞搜尋量及競爭力，以數據清楚列出每個關鍵詞的效能，並細心挑選最有效的關鍵詞"
                            ],
                            [
                                "icon" => "link",
                                "title" => "優質反向連結技術",
                                "content" => "合作中密切檢查連結質素，定期加上新優質連結，確保提升顧客網站可信度至最高水平"
                            ]
                        ],
                        "remark" => "*同一個關鍵詞只接受限定數量客戶，確保所有客戶的排名維持在最高水準",
                        "button_text" => "服務詳情",
                        "button_link" => "/",
                        "right_card_title" => "提升網站排名",
                        "right_card_subtitle" => "專業 SEO 策略\n讓您的網站脫穎而出",
                        "right_card_image" => $this->copyImageToStorage("images/home/seo2.webp", 'home_sections/seo')
                    ]
            ],
        ];

        foreach ($sections as $section) {
            HomeSection::updateOrCreate(
                ['key' => $section['key']],
                [
                    'name' => $section['name'],
                    'data' => $section['data'],
                ]
            );
        }
    }

    public static function copyImageToStorage(string $originalPath, string $targetDir): string
    {
        $fullSourcePath = public_path($originalPath);
        $filename = basename($originalPath);
        $newRelativePath = "$targetDir/$filename";

        if (!Storage::disk('public')->exists($newRelativePath) && file_exists($fullSourcePath)) {
            Storage::disk('public')->put(
                $newRelativePath,
                file_get_contents($fullSourcePath)
            );
        }

        return $newRelativePath;
    }
}
