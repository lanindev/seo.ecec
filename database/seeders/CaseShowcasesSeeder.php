<?php

namespace Database\Seeders;

use App\Models\CaseShowcase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CaseShowcasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [
            [
                'title' => '搬屋公司 逐件計搬運有限公司',
                'content_components' =>
                    [
                        "color" => "#149280",
                        "logo" => $this->copyImageToStorage('images/case_showcases/1_logo.webp', 'case_showcases'),
                        "image" => $this->copyImageToStorage('images/case_showcases/1_image.webp', 'case_showcases'),
                        "carousel" => [
                            $this->copyImageToStorage('images/case_showcases/1_carousel.webp', 'case_showcases')
                        ],
                        "client_intro" => "逐件計搬運憑藉多年專業經驗與創新精神，設計出透明合理的搬運報價系統。顧客可自助報價、預約搬運，享受簡單快捷又公道的搬運體驗。提供住宅、辦公室、村屋吊運、國際搬運及倉儲等全方位服務。",
                        "solution" => "為 PPS Moving 打造結合線上報價平台與品牌形象的全新網站，展現專業、高效又親民的一站式搬運服務體驗。",
                        "result" => "ECEC 為 PPS Moving 打造的新網站顯著提升了用戶體驗與品牌形象，讓顧客更容易了解並預約搬運服務。\n改版後網站流量與線上詢價量明顯上升，成功帶動整體業績成長。\n同時，網站在行動裝置上的瀏覽體驗大幅優化，進一步提升品牌曝光與信任度。",
                        "statistics" => [
                            [
                                "number" => "50",
                                "unit" => "%",
                                "label" => "客戶聯絡數目提升"
                            ],
                            [
                                "number" => "58",
                                "unit" => "%",
                                "label" => "客戶轉換率"
                            ]
                        ],
                        "button" => [
                            "text" => "免費咨詢專業團隊",
                            "url" => "https://api.whatsapp.com/send/?phone=" . setting('site.whatsapp') . "&text=我想查詢你們的Marketing服務"
                        ]
                    ]
            ],
        ];

        foreach ($rows as $row) {
            CaseShowcase::updateOrCreate(
                ['title' => $row['title']],
                [
                    'content_components' => $row['content_components'],
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
