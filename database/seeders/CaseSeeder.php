<?php

namespace Database\Seeders;

use App\Models\CaseModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cases_type1 = [
            [
                'title' => 'Panda English',
                'content_components' =>
                    [
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>行業</h3><p>教育業｜英文補習</p><p><br></p><h3>公司業務</h3><p>Panda English 是香港成立的網上英語學習平台(獲政府機構獎項的初創公司)，外籍與本地導師均具備豐富的知識與教學經驗。 課程由幼稚園、小學、中學至成人，小學英語課程主打劍橋英語及本地皇牌課程，皇牌課程是緊貼香港的英文課程內容， 另設到校課程，有助提升學校校內成績。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/1_screenshot.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>方案</h3><p>SEO搜索關鍵詞優化 極速提升網站排名 –<br>ECEC為Panda English行關鍵詞調查，並針對與英文補習相關的關鍵詞實行SEO搜索關鍵詞優化，以增加網站點擊的客戶轉化率。通過每週持續優化他們的網站關鍵詞及加入大量優質反向連結(Backlinks)，令以Panda English獲得更好的搜索引擎排名，幫助他們接觸到更多的學生，增加報讀他們課程的客戶數量。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/1_search.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>成效</h3><p>ECEC團隊針對多組英語課程相關關鍵字加強點擊率。其中「劍橋英語」、「線上英文課程」、「 線上英文拼音課程」三組關鍵字已穩定佔據搜索排名首頁，網站排名流量和流量都獲得明顯的提升。<br><br></p><h3>數據</h3><p>(1個月內) 登上Google排名首頁</p>"
                            ]
                        ]
                    ]
            ],
            [
                'title' => 'iMath',
                'content_components' =>
                    [
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>行業</h3><p>教育業｜數學補習</p><p><br></p><h3>公司業務</h3><p>i-Math Education Centre (數學教室) 是 一間位於將軍澳坑口以及馬鞍山的數學補習中心。i-Math專為幼兒、小學及初中學生提供數學補習服務，i-Math 的本地數學課程是根據教育局的數學課程而編制，與絕大多數的本地學校數學課程完全銜接。同時，i-Math 課程切合國際學校的學生所需，以增強數感及運算技巧。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/2_screenshot.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>方案</h3><p>SEO搜索關鍵詞優化 極速提升網站排名<br>FlowDigital 為i-Math行關鍵詞調查，並針對與數學補習相關的關鍵詞實行SEO搜索關鍵詞優化，以增加網站點擊的客戶轉化率。通過每週持續優化他們的網站關鍵詞及加入大量優質反向連結(Backlinks)，令以i-Math獲得更好的搜索引擎排名，幫助他們接觸到更多的學生，增加報讀他們課程的客戶數量。<br><br>另外，我們亦針對i-Math的地理位置進行了客製化關鍵詞優化，當中包括「將軍澳數學」、「坑口補習」、「油塘補習」等等，以 擴大i-Math主要收學範圍的網絡知名度，符合客戶需求。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/2_search.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>成效</h3><p>ECEC團隊針對多組將軍澳補習相關關鍵字加強點擊率。其中「數學補習」、「將軍澳補習社」、「將軍澳數學補習」三組關鍵字已穩定佔據搜索google 排行榜首頁。該合作獲得成功，網站排名流量和流量都獲得明顯的提升。</p><p><br></p><h3>數據</h3><p>(3個月內) 登上Google 搜索版首頁</p>"
                            ]
                        ]
                    ]
            ],
            [
                'title' => '補習配對平台 Upskyler',
                'content_components' =>
                    [
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>行業</h3><p>教育業</p><h3>公司業務</h3><p>Upskyler是一間免費為學生提供線上配對服務的補習平台，致力以專業貼心、充滿熱誠的團隊，為學生、家長、導師，帶來優越的服務體驗。現時配對服務涵蓋上門補習、網上視像補習，覆蓋課程包括中小學私補、大學生私補、DSE、IELTS、IB、ABRSM、語言、樂器、小組補習等。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/3_screenshot.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>方案</h3><p>SEO搜索關鍵詞優化 極速提升網站排名<br>ECEC 為Upskyler行關鍵詞調查，並針對與DSE、網上課程相關的關鍵詞實行SEO搜索關鍵詞優化，以增加網站點擊的客戶轉化率。通過每週持續優化他們的網站關鍵詞及加入大量優質反向連結(Backlinks)，令以Upskyler獲得更好的搜索引擎排名，幫助他們接觸到更多的學生，增加報讀他們課程的客戶數量。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/3_search.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>成效</h3><p>ECEC團隊針對多組網上課程相關關鍵字加強點擊率。其中關鍵字「補習配對」已穩定佔據搜索排名第一位。該合作獲得成功，網站排名流量和流量都獲得明顯的提升。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/3_search2.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>數據</h3><p>(3個月內) 登上Google搜尋排名第一</p>"
                            ]
                        ]
                    ]
            ],
            [
                'title' => '英文老師Ms Priscilla',
                'content_components' =>
                    [
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>行業</h3><p>教育業｜英文補習<br><br></p><h3>公司業務</h3><p>Ms Priscilla 於香港大學精算系一級榮譽畢業，公開試全科 9A 狀元，每年均考進 Dean’s Honours List (大學優秀榮譽名單)，現為香港文憑試DSE 英文、中學英文、 以及成人英語補習老師。綜合逾 14 年全職教學經驗，深明學習秘訣以及正確讀書之道，教學屢獲好評，累積逾數千學生，贏盡口碑。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/4_screenshot.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>方案</h3><p>SEO搜索關鍵詞優化 極速提升網站排名<br>FlowDigital 為Ms Priscilla行關鍵詞調查，並針對與英文補習相關的關鍵詞實行SEO搜索關鍵詞優化，以增加網站點擊的客戶轉化率。通過每週持續優化他們的網站關鍵詞及加入大量優質反向連結(Backlinks)，令Ms Priscilla獲得更好的搜索引擎排名，幫助他們接觸到更多的學生，增加報讀他們課程的客戶數量。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/4_search.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>成效</h3><p>ECEC團隊針對多組英語課程相關關鍵字加強點擊率。其中「DSE英文補習」、「中學英文補習」、「成人英語」三組關鍵字已穩定佔據搜索排名首頁，網站排名流量和流量都獲得明顯的提升。<br><br></p><h3>數據</h3><p>熱門關鍵字 升至Google排名前三名</p>"
                            ]
                        ]
                    ]
            ],
            [
                'title' => '經致中文補習',
                'content_components' =>
                    [
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>行業</h3><p>教育業｜ 中文補習<br><br></p><h3>公司業務</h3><p>經致中文補習是本地具王牌陣容的中文補習社， 在北角、旺角、 太子均有分校，設立奪星以及補底中文補習課程，適合各程度的中學學生。經致為中文專科教學，導師均擁有豐富中文教學經驗，對中文知識有深入獨到的見解， 亦經常在網站分享不同資源，例如DSE中文科12篇範文的見解。當中， 尤以名牌導師Issac Lo 作為該校課程總監以及首席導師，其教學團隊更用中文碩士級導師 和文史精英。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/5_screenshot.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>方案</h3><p>SEO搜索關鍵詞優化 極速提升網站排名<br>ECEC 為行關鍵詞調查，並針對與中文補習相關的關鍵詞實行SEO搜索關鍵詞優化，以增加網站點擊的客戶轉化率。通過每週持續優化他們的網站關鍵詞及加入大量優質反向連結(Backlinks)，令經致中文補習獲得更好的搜索引擎排名，幫助他們接觸到更多的學生，增加報讀他們課程的客戶數量。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/5_search.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>成效</h3><p>ECEC團隊針對多組中文課程相關關鍵字加強點擊率。其中「DSE中文補習」、「中學中文補習」、「拔尖」、「補底」 等等關鍵字已穩定佔據搜索排名首頁，網站排名流量和流量都獲得明顯的提升。<br><br></p><h3>數據</h3><p>熱門關鍵字 升至Google排名前四名</p>"
                            ]
                        ]
                    ]
            ],
            [
                'title' => 'Upgrade HK',
                'content_components' =>
                    [
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>行業</h3><p>教育業<br><br></p><h3>公司業務</h3><p>Upgrade成立於2020年，是香港首個集自修室及線上網站於一體的自主學習新平台。他們擁有三間自修室，總面積超過8000呎，所有自修室都採用全新Face ID系統，讓客人可以方便快捷地進出。客人可以透過Upgrade獨家網站或App預約座位，查看當日剩餘座位。此外，Upgrade與最具實力的DSE導師團體合作，打造網上學習平台。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/6_screenshot.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>方案</h3><p>SEO搜索關鍵詞優化 極速提升網站排名 –<br>ECEC 為Upgrade行關鍵詞調查，並針對與DSE、網上課程相關的關鍵詞實行SEO搜索關鍵詞優化，以增加網站點擊的客戶轉化率。通過每週持續優化他們的網站關鍵詞及加入大量優質反向連結(Backlinks)，令以Upgrade獲得更好的搜索引擎排名，幫助他們接觸到更多的學生，增加報讀他們課程的客戶數量。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/6_search.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>成效</h3><p>Flowdigital團隊針對多組網上課程相關關鍵字加強點擊率。其中關鍵字「DSE網上課程」已穩定佔據搜索排名第二位。該合作獲得成功，網站排名流量和流量都獲得明顯的提升。<br><br></p><h3>數據</h3><p>(3個月內) 登上Google搜尋排名前三</p>"
                            ]
                        ]
                    ]
            ],
            [
                'title' => '舒適坊-銅鑼灣按摩',
                'content_components' =>
                    [
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>行業</h3><p>美容｜按摩<br><br></p><h3>公司業務</h3><p>Causeway Bay Massage是一家提供按摩和美容服務的公司，其服務包括頸肩背按摩、香薰推油、淋巴排毒按摩、刮痧、拔罐、修腳和耳燭。他們為客戶提供即時預約服務，並確保所有服務的質量。此外，他們還提供上門服務和酒店代訂服務，以滿足客戶的不同需求。<br><br></p><h3>方案</h3><p>SEO搜索關鍵詞優化 極速提升網站排名 –<br>ECEC 為Causewaybay Massage進行關鍵詞調查，並針對與ustd電子貨幣相關的關鍵詞實行SEO搜索關鍵詞優化，以增加網站點擊的客戶轉化率。通過每週持續優化他們的網站關鍵詞及加入大量優質反向連結(Backlinks)，令以Uniplus education獲得更好的搜索引擎排名，幫助他們接觸到更多的客戶，使用他們電子貨幣交易的服務。<br><br></p><h3>成效</h3><p>ECEC團隊針對銅鑼灣、按摩，與行業和地域相關關鍵字加強點擊率。其中Causawaybay Massage已在「銅鑼灣按摩」等關鍵字中登入Google搜尋首頁。該合作獲得成功，網站排名流量和流量都獲得明顯的提升。<br><br></p><h3>數據</h3><p>(3個月內) 登上Google搜尋首頁</p>"
                            ]
                        ]
                    ]
            ],
            [
                'title' => 'Join-in Education',
                'content_components' =>
                    [
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>行業</h3><p>教育業<br><br></p><h3>公司業務</h3><p>進研教育是一所專門提供英文、中文和數學等學科補習的機構。他們堅持小班教學原則，並以”專科專教、概念為本、有教無類”為補習理念。他們致力於教授思考方法、答題技巧和出卷模式，幫助學生提高成績，進而實現他們的學習目標。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/8_screenshot.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>方案</h3><p>SEO搜索關鍵詞優化 極速提升網站排名 –<br>ECEC 為進研教育進行關鍵詞調查，並針對與補習、補習社相關的關鍵詞實行SEO搜索關鍵詞優化，以增加網站點擊的客戶轉化率。通過每週持續優化他們的網站關鍵詞及加入大量優質反向連結(Backlinks)，令進研教育獲得更好的搜索引擎排名。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/8_search.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>成效</h3><p>ECEC團隊針對多組補習相關關鍵字加強點擊率。其中進研教育已在「補英文」這組熱門關鍵字長期穩定佔據搜索排名第一。此外，他還在「補習社」、「中文補習」這些熱門關鍵字中分別佔據搜索排名第二和第三。該合作獲得成功，網站排名流量和流量都獲得明顯的提升。<br><br></p><h3>數據</h3><p>(3個月內) 登上Google排名第一位</p>"
                            ]
                        ]
                    ]
            ],
            [
                'title' => 'Uni+Education',
                'content_components' =>
                    [
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>行業</h3><p>教育業｜中學理科補習<br><br></p><h3>公司業務</h3><p>Uni+ Education是一個提供數據分析和電子化學習系統的教育品牌。他們開辦中學理科的課程。他們的教學方法結合了豐富的教學經驗、獨家電子教學平台和數據分析系統，提升教與學效能，讓學生更能看見自身的強項和進步，並建立可靠的學習新模式。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/9_screenshot.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>方案</h3><p>SEO搜索關鍵詞優化 極速提升網站排名 –<br>ECEC 為Uniplus education行關鍵詞調查，並針對與物理補習相關的關鍵詞實行SEO搜索關鍵詞優化，以增加網站點擊的客戶轉化率。通過每週持續優化他們的網站關鍵詞及加入大量優質反向連結(Backlinks)，令以Uniplus education獲得更好的搜索引擎排名，幫助他們接觸到更多的學生，增加報讀他們課程的客戶數量。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/9_search.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>成效</h3><p>ECEC團隊針對多組物理補習相關關鍵字加強點擊率。其中「physics補習」、「物理補習社」、「物理補習」三組關鍵字已穩定佔據搜索排名前三。該合作獲得成功，網站排名流量和流量都獲得明顯的提升。<br><br></p><h3>數據</h3><p>(3個月內) 登上Google排名第一位</p>"
                            ]
                        ]
                    ]
            ],
        ];

        $cases_type3 = [
            [
                'title' => '搬屋公司 逐件計搬運有限公司',
                'content_components' =>
                    [
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>行業</h3><p>搬屋<br><br></p><h3>公司業務</h3><p>逐件計搬屋公司(PPS Moving Limited) 是一家位於香港的搬屋公司，提供搬屋、辦公室搬運、上門迷你倉和買紙箱等一條龍搬運服務。PPS Moving擁有豐富的經驗和專業團隊，以確保客戶的物品能安全、快速地運送到指定地點。另外，逐件計搬運有限公司採用明碼實價、簡單易計的服務方式，並可透過網上平台輕鬆預約搬屋服務，致力於為客戶提供最優質的搬家服務。服務宗旨為專業、可靠、高效和價格實惠。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/10_screenshot.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>方案</h3><p>重新定義風格和功能，符合企業形象與需求<br>我們重新設計了網站的所有頁面，改用一個較容易管理的網站設計軟件Wordpress，並以最簡單直接的方法吸引消費者 ，為PPS Moving建立既親民又專業可靠的形象。我們設計團隊針對客戶經驗、平台管理和品牌形象三方面的客製化設計網站。 針對PPS Moving的宗旨——專業、可靠、高效和價格實惠，我們採用了親切而正面的設計風格，並以白色、橙色和綠色為主要色調，成功地營造出了一種貼地且可信的氛圍。<br><br>此外，我們在主頁中列出了PPS Moving的所有服務，包括逐件計搬運、辦公室搬運、上門迷你倉等，使服務內容變得更加簡單易明，符合他們的業務推廣目標。其次， 在重新設計結構方面，經過與PPS Moving深入了解和溝通， 我們在PPS Moving 的網站分別加入了「購買包裝物料」和「辦公室服務」兩個分頁面設計，彰顯出他們一條龍服務的品牌理念。 另外，我們 主頁中列出了PPS Moving所有服務包括逐件計搬運、辦公室搬運、上門迷你倉等等，使其服務內容更簡單易明，以符合客戶的業務推廣目標。 整個設計方案基於PPS Moving 原有結構設計， 並進行徹底的改良，現時網頁結構分為七個部分： 主頁、 關於我們、 搬運服務、 搬屋流程、 常見問題、 網上下單和聯絡我們。<br><br>在長遠發展方面，我們亦為客戶PPS moving 提供免費客製化課程， 包括電子版網站使用手冊和1次面對面會議，講述網站編輯方法， 增強客戶對網站使用的知識。</p>"
                            ]
                        ],
                        [
                            "type" => "image",
                            "data" => [
                                "path" => $this->copyImageToStorage('images/cases/10_screenshot2.webp', 'cases')
                            ]
                        ],
                        [
                            "type" => "richtext",
                            "data" => [
                                "content" => "<h3>成效</h3><p>ECEC創建的網站使PPS Moving的客戶更容易在線上瀏覽和了解搬屋流程，令整個網站更加User-friendly，即使在手機查看也非常方便，改善整體品牌形象和線上存在感。在ECEC的幫助之下，PPS Moving網站的瀏覽量大幅上升，有效增加生意額和品牌曝光率。再者， ECEC的客製化課程教導PPS Moving如何編輯網站，從而增強了他們對網站使用的知識，有助於他們在未來更好地管理和更新自己的網站。<br><br>請訪問我們的<a href=\"www.ppsmoving.com.hk\">客戶頁面</a>以獲取更多詳細資訊。</p>"
                            ]
                        ]
                    ]
            ],
        ];

        foreach ($cases_type1 as $row) {
            $case = CaseModel::updateOrCreate(
                [
                    'title' => $row['title'],
                    'case_type_id' => 1,
                ],
                [
                    'content_components' => $row['content_components'],
                ]
            );

            $case->update([
                'cover' => $this->copyImageToStorage("images/cases/{$case->id}_cover.webp", 'cases'),
            ]);
        }

        foreach ($cases_type3 as $row) {
            $case = CaseModel::updateOrCreate(
                [
                    'title' => $row['title'],
                    'case_type_id' => 3,
                ],
                [
                    'content_components' => $row['content_components'],
                ]
            );

            $case->update([
                'cover' => $this->copyImageToStorage("images/cases/{$case->id}_cover.webp", 'cases'),
            ]);
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
