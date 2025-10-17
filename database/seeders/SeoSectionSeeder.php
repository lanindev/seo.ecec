<?php

namespace Database\Seeders;

use App\Models\SeoSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SeoSectionSeeder extends Seeder
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
                'data' => [
                    "title" => "排名快上升\n關鍵字登頂",
                    "subtitle" => "為正在擴張的香港公司而設的SEO服務。\n於過萬流量關鍵詞Top 3，從未如此簡單",
                    "button1_text" => "立即查詢",
                    "button1_color" => "sky",
                    "button1_link" => "/",
                    "button2_text" => "品牌成功故事",
                    "button2_color" => "green",
                    "button2_link" => "/",
                    "image" => $this->copyImageToStorage("images/seo/img.webp", 'seo_sections/banner')
                ]
            ],
            [
                'key' => 'cases',
                'name' => '客戶個案標題',
                'data' => [
                    "title" => "我們創造持久而遠高於服務收費的價值",
                    "subtitle" => "收費透明，三個月見效。我們團隊會就多達200種信號優化您網站的權威性、相關性、及信任性。"
                ]
            ],
            [
                'key' => 'issues',
                'name' => '你有遇過以下這些難題嗎？',
                'data' =>
                    [
                        "title" => "你有遇過以下這些難題嗎？",
                        "cards" => [
                            "1" => [
                                "icon" => "circle-question",
                                "title" => "對SEO理解不足",
                                "description" => "競爭對手正在透過SEO得取新客戶，但你仍不確定SEO的可取之處。"
                            ],
                            "2" => [
                                "icon" => "trophy",
                                "title" => "無法登上搜尋頭版",
                                "description" => "你希望自己的網站能登上搜尋結果首頁以助擴充客源，卻不果。"
                            ],
                            "3" => [
                                "icon" => "question",
                                "title" => "對SEO無從入手",
                                "description" => "渴望學習SEO，但網上的資訊過於氾濫。"
                            ],
                            "4" => [
                                "icon" => "user-tie",
                                "title" => "無法優化網站內容",
                                "description" => "想優化由第三方軟件設計的網站，如ShopLine，WordPress等。"
                            ]
                        ]
                    ]
            ],
            [
                'key' => 'plans',
                'name' => '我們的優惠方案',
                'data' =>
                    [
                        "title" => "我們的優惠方案",
                        "cards" => [
                            [
                                "icon" => "circle-question",
                                "title" => "流量倍增計劃",
                                "description" => "剛開始做SEO的中小企",
                                "price" => "5000",
                                "duration" => "6",
                                "items" => " 六至八組「中流量」關鍵字 (每月搜尋量500 - 2,000左右)\n 大約三至四個月左右上首頁\n 2000+條反向鏈結，輔助排名上升\n 專人監察成效，每月報告"
                            ],
                            [
                                "icon" => "trophy",
                                "title" => "查詢滾滾來計劃",
                                "description" => "已有相當規模網站的企業",
                                "price" => "6500",
                                "duration" => "6",
                                "items" => "幫你挑選最多流量的關鍵字\n 網站SEO診症及專人修正 (如允許)\n 兩至三組「高流量」關鍵詞 (每月搜尋量2,000+)\n 六至八組「中流量」關鍵字 (每月搜尋量500 - 2,000左右)\n 大約三個月左右上首頁\n 4000+條反向鏈結，輔助排名上升\n 專人監察成效，每月報告"
                            ],
                            [
                                "icon" => "question",
                                "title" => "先聲奪人計劃",
                                "description" => "期望搶佔競爭者生意的企業",
                                "price" => "8000",
                                "duration" => "3",
                                "items" => " 幫你挑選最多流量的關鍵字\n 網站SEO診症及專人修正 (如允許)\n 兩組「高流量」關鍵詞 (每月搜尋量5,000+)\n 四組「中流量」關鍵詞 (每月搜尋量500-5,000左右)\n 五至十組「低流量」關鍵詞 (每月搜尋量<500左右)\n 7000+條反向鏈結，輔助排名上升\n 專人監察成效，每月報告"
                            ]
                        ]
                    ]
            ],
        ];

        foreach ($sections as $section) {
            SeoSection::updateOrCreate(
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
