<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_rows = [
            [
                "name" => "Spencer Lam",
                "title" => "Spencer Lam English 創辦人",
                "stars" => 5,
                "video_url" => "https://www.youtube.com/watch?v=TLQ0ocG1ssg",
                "cover" => $this->copyImageToStorage("images/reviews/1.webp", 'reviews'),
                "comment" => "非常多謝幫忙，短短一個月之內可以把我的網站，一年全新，可以放在全港首頁第一位。\n\n其實之前用過好多坊間網絡營銷的公司，全港第一的公司都有用過，但是用了半年除了價格貴五倍，而且又未有效果，只係不斷叫我續加半年，而且有沒有跟進。最令我意外的是Ivan會願意在其他時間給予針對性的建議，令到我哋公司有所增長，營業額比起往年增加最少兩倍，大量成功見證\n\n因為我比較少會讚人，所以真的是少有很有能力很有經驗的團隊，希望可以幫助到更多中小企或者大型公司發展。",
            ],
            [
                "name" => "BEN LEE",
                "title" => "《李維記》老闆",
                "stars" => 5,
                "video_url" => "https://www.youtube.com/watch?v=pIJsKrG2Fxo",
                "cover" => $this->copyImageToStorage("images/reviews/2.webp", 'reviews'),
                "comment" => "首先好多謝ECEC幫我們公司去設計了網站，裏面的內容、設計、風格很適合我們。日本的感覺的想法、而且設計都是很美麗的。\n\n所以我好滿意，而另外接下來的我都會與ECEC繼續合作，會做到我自己本身的品牌李維記集團，而將所有我公司結合在裏面。\n\n合作上最重要都是溝通，也是我們最注重的部分，所以這方面您公司是做得非常好的。我也問最後一條問題，如果要為我們的合作評一至十分，您會大概給多少分呢？\n\n非常之開心，真的是十分。",
            ],
            [
                "name" => "Leo Tam",
                "title" => "首席室內設計師",
                "stars" => 5,
                "video_url" => null,
                "cover" => $this->copyImageToStorage("images/reviews/3.webp", 'reviews'),
                "comment" => "1. 合作過程是否順利？ 超級順利!!\n\n2. 合作能否滿足您的Marketing需要？ YES!\n\n3. 對服務是否滿意？ 好滿意!\n\n4. 最滿意的地方是？ ECEC 非常幫手 效率亦很高!! 期待SEO的成果\n\n5. 5分滿分會給幾分？ 5 !",
            ],
            [
                "name" => "Ms Priscilla",
                "title" => "Ms Priscilla English創辦人",
                "stars" => 5,
                "video_url" => null,
                "cover" => $this->copyImageToStorage("images/reviews/4.webp", 'reviews'),
                "comment" => "我推薦這家SEO服務公司！他們的推廣策略和分析快速提供我的網站搜索結果中的排名。",
            ],
            [
                "name" => "周Sir",
                "title" => "確一教育創辦人",
                "stars" => 5,
                "video_url" => null,
                "cover" => $this->copyImageToStorage("images/reviews/5.webp", 'reviews'),
                "comment" => "感謝ECEC為我們公司設計和建構網站。知道ECEC在與教育中心合作方面有豐富的經驗，所以我找他們來設計我的網站。和他們團隊的合作過程中感到非常愉快，他們為我客製化各種功能和設定，他們所有員工也非常友善，並樂意協助我修訂網站。\n\n另一方面，知道ECEC提供SEO搜索引擎排名優化的服務，也讓我非常感興趣使用這家公司。我相信這是長期推廣網站和公司的最佳方式之一。再次感謝ECEC幫助我開展教育業務。",
            ]
        ];


        foreach ($data_rows as $row) {
            Review::updateOrCreate(
                [
                    'name' => $row['name'],
                    'title' => $row['title']
                ],
                [
                    'stars' => $row['stars'],
                    'video_url' => $row['video_url'],
                    'cover' => $row['cover'],
                    'comment' => $row['comment'],
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
