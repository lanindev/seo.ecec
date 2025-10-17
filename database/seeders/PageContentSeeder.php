<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Language;
use App\Models\PageContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class PageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultComponentsBySlug = [
            'contact' => [
                'zh_HK' => [
                    [
                        "type" => "icon_list_block",
                        "data" => [
                            "section_title" => "聯絡我們",
                            "image" => $this->copyImageToStorage('images/contact/map.webp', 'settings/contact'),
                            "image_link" => "https://www.google.com/maps?q=香港新蒲崗雙喜街5號",
                            "items" => [
                                [
                                    "icon" => "envelope",
                                    "description" => "info@ecec.media",
                                    "text_link" => "mailto:info@ecec.media"
                                ],
                                [
                                    "icon" => "location-dot",
                                    "description" => "香港新蒲崗雙喜街5號福和工業大廈5樓全層",
                                    "text_link" => "https://www.google.com/maps?q=香港新蒲崗雙喜街5號"
                                ],
                                [
                                    "icon" => "phone",
                                    "description" => "手機／Whatsapp\n+852 2362 0266\n",
                                    "text_link" => "tel:+85223620266"
                                ]
                            ]
                        ]
                    ],
                ],
            ],

            'privacy_policy' => [
                'zh_HK' => [
                    [
                        "type" => "section_heading",
                        "data" => [
                            "title" => "隱私政策"
                        ]
                    ],
                    [
                        "type" => "richtext",
                        "data" => [
                            "content" => "<p>適用範圍：<br>ECEC 國際網絡推廣（以下簡稱「本公司」）致力於為客戶提供網站優化（SEO）、網絡行銷、內容行銷及數位品牌推廣等服務。<br>本《隱私政策》（以下簡稱「本政策」）適用於本公司所經營之官方網站與相關業務網站（以下統稱「本網站」），旨在說明本公司於提供服務過程中如何蒐集、使用、保護及管理個人資料。<br><br>若您僅瀏覽本網站之公開頁面（例如服務介紹、案例展示、文章專欄），除非您主動提供個人資料（如透過聯絡表單），本公司不會主動蒐集任何可識別個人身分的資訊。<br><br></p><h3>一、個人資料安全與隱私保護</h3><p>本公司尊重每位訪客的隱私權，並依據《個人資料保護法》及相關法規，採取合理的技術與管理措施，以確保您的資料安全。<br>本網站僅於必要時（例如您主動填寫聯絡表單或合作詢問）蒐集個人資料；<br>若您未主動提供，本網站不會蒐集、處理、儲存或傳輸任何個人資料；<br>除必要的網站分析 Cookie 外，不使用具追蹤或個資蒐集目的的 Cookie；<br>不會未經同意分享或出售訪客個資予第三方。<br><br></p><h3>二、資料蒐集與使用說明</h3><p>（一）主動蒐集資料<br>當您透過本網站的聯絡表單、電子郵件或其他方式向本公司提出詢問、合作需求時，可能蒐集以下資料：<br>姓名、公司名稱、聯絡電話、電子郵件信箱；<br>相關業務需求、網站網址或合作說明。<br>蒐集目的僅限於：<br>回覆您的詢問與提供專業建議；<br>進行客戶管理與業務聯繫；<br>改善本公司之服務品質與網站體驗。<br><br>（二）被動蒐集資料<br>為改善網站效能與使用體驗，本網站可能使用必要之分析工具（例如 Google Analytics）。<br>此類工具僅蒐集匿名化統計資料（如瀏覽頁面數、使用裝置類型、停留時間），並不含可識別個人身分之資訊。<br><br>（三）不涉及之行為<br>本網站不會蒐集信用卡、金融帳號或敏感個資；<br>不會要求訪客註冊會員或登入帳號；<br>不使用第三方廣告追蹤或行銷像素（如 Facebook Pixel）。</p><p><br></p><h3>三、資料分享與第三方服務</h3><p>本公司不會將您的個人資料出售、交換或出租給任何第三方。<br>若為提供服務所必要（例如寄送電子郵件、網站代管），本公司可能委託可信任之合作夥伴，並確保其遵守資料保護規範。<br>若法律機關依合法程序要求提供資料，本公司將依法配合。</p><p><br></p><h3>四、外部連結與內容來源</h3><p>本網站可能包含導向其他網站或社交媒體平台之超連結（如客戶案例、合作夥伴網站）；<br>該等外部網站不受本政策約束，請訪客自行參閱其隱私條款；<br>本網站展示之圖片、文字與影片，均經授權或根據合法公開來源取得，版權歸原權利人所有。</p><p><br></p><h3>五、資訊安全措施</h3><p>為保護您的資料安全，本公司採取以下安全機制：<br>使用 HTTPS 加密連線，確保資料傳輸安全；<br>定期更新伺服器與程式環境，防範惡意攻擊與網站入侵；<br>使用防火牆與弱點掃描技術，保障網站運作安全與內容完整性。<br><br></p><h3>六、訪客權利</h3><p>依據相關法令，您對於所提供之個人資料擁有以下權利：<br>查詢或請求閱覽；<br>請求補充或更正；<br>請求停止蒐集、處理或使用；<br>請求刪除個人資料。<br>如您欲行使上述權利，請透過「聯絡我們」方式提出，本公司將於合理期限內處理。<br><br></p><h3>七、隱私政策之更新與公告</h3><p>本公司保留隨時修訂本政策之權利；<br>如有重大變更，將於本網站明顯位置公告更新內容與日期；<br>更新後的政策以本頁最新版本為準。<br><br></p><h3>八、聯絡我們</h3><p>如您對本隱私政策或資料保護有任何疑問、建議或申訴，請與我們聯繫</p>"
                        ]
                    ]
                ],
            ],

            'terms' => [
                'zh_HK' => [
                    [
                        "type" => "section_heading",
                        "data" => [
                            "title" => "使用條款"
                        ]
                    ],
                    [
                        "type" => "richtext",
                        "data" => [
                            "content" => "<p>**適用範圍：**任何使用本網站展示內容、瀏覽樓盤資訊或點擊連結之訪客。<br><br>第一章：總則與接受條款<br>歡迎您使用本公司提供之靜態展示網站（以下簡稱「本網站」）。<br>當您開啟本網站任何頁面，即視為同意遵守以下所有條款與規定，並接受本使用條款所載內容。<br>本公司保留隨時變更、修改或更新本使用條款之權利，更新後將立即公告生效，恕不另行個別通知；建議您定期查看本頁最新版本。</p><p><br>第二章：網站使用與資料參考聲明<br>本網站所提供之房地產樓盤資料，包括圖片、價格、建築面積、交樓標準、交通配套等，僅供參考，不構成法律、投資、購買或財務建議。<br>資訊來源多為開發商官方公開資料或經授權提供，本公司已盡努力核對其真實性與完整性，但不保證資料永遠準確、最新或適合特定個人需求；請以開發商最終通知為準。<br>若您對樓盤資訊條件有疑義，應直接向開發商或其銷售代理進行確認與洽談。<br>網站展示之圖片可能為樣板間示意照或模擬圖，實際交樓物業可能略有差異，敬請理解。<br><br>第三章：智慧財產權規定<br>本網站所有內容（包括但不限於文字、圖片、影片、商標、LOGO、視覺設計、排版結構）均由本公司或相關權利人依法擁有或授權使用。<br>未經事前書面同意，任何個人或法人不得以任何方式複製、重製、散佈、轉載、出售、轉售、修改或公開展示本網站內容；否則本公司有權追究法律責任。<br>若您欲使用本網站內容作報導、引用或其他用途，請事前取得本公司或相關權利人之書面授權並標註來源。<br>若發現他人未經授權使用本網站內容，可聯絡本公司，我們將依法採取適當行動。<br><br>第四章：使用限制與禁止行為<br>您不得以任何方式未經授權進入本網站的技術系統、伺服器、資料庫或後台管理環境；不得嘗試破解、掃描、攻擊本網站。<br>不得將本網站用於發布、不當傳播虛假、誤導、侵權、誹謗、騷擾或違法訊息。<br>不得干擾或破壞本網站之正常運作，包括但不限於濫發流量、分散服務攻擊（DDoS）、機器人自動操作等。<br>若經查證使用者從事違法或不當行為，本公司有權單方終止其使用權限，並保留追究法律責任之權利。<br><br>第五章：責任限制與免責聲明<br>本公司對於因本網站內容錯誤、資料延遲、資訊未更新或系統故障所造成之任何直接、間接、附帶、衍生或懲罰性損害，不負任何法律責任。<br>對於因訪客使用非官方版本瀏覽器或裝置漏洞導致資訊暴漏、資料遺失、惡意程式攻擊等安全事件，本公司不承擔責任；建議您自行保持裝置安全。<br>本公司不對因第三方網站連結之內容正確性、可用性、合法性及隱私保護負責；如您點擊並離開本網站，則該行為所產生之風險需由您自行承擔。<br>本條款不排除或限制法律規定不得排除或限制之責任。<br><br>第六章：條款變更與通知<br>若本公司因業務調整或法規要求修改使用條款內容，將以本頁公告為準；若涉及重大變動（如新增會員系統、開放留言板等），將於網站首頁或重要頁面以顯著方式通知訪客。<br>條款更新時會附上修改說明與生效日期，方便使用者查閱對照歷史版本。<br><br>第七章：適用法律與爭議管轄<br>本使用條款內容及雙方之權利義務，應依香港法律解釋及適用。<br>若因本條款或本網站之使用發生爭議，雙方應先協商解決；協商不成時，應提交本公司註冊地人民法院，作為第一審管轄法院。<br>若本條款的某項條款被依法認定為無效或不可執行，不影響其他條款之有效性。<br><br>第八章：其他條款<br>本條款構成您與本公司關於本網站使用之全部協議，並取代先前任何形式之共識或約定。<br>本條款標題僅為閱讀之便利，不影響條款解釋。<br>如本條款內容衍生英文版本，如中英文版不一致，以中文版為準。<br>若您為法人單位使用者，請確保您有相關權限並已通知公司所有使用者相關條款內容。</p>"
                        ]
                    ]
                ],
            ],
        ];


        $languages = Language::where('is_active', true)->get()->keyBy('code');

        $pages = Page::all();

        foreach ($pages as $page) {
            $slug = $page->slug;

            foreach ($languages as $langCode => $language) {
                $components = $defaultComponentsBySlug[$slug][$langCode] ?? null;

                if ($components) {
                    PageContent::updateOrCreate(
                        [
                            'page_id' => $page->id,
                            'language_id' => $language->id,
                        ],
                        [
                            'content_components' => $components,
                        ]
                    );
                }
            }
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
