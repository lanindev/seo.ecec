<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PageContentSeeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'admin.title',
                'value' => __('frontend.site.name') . ' ' . __('admin.admin.panel'),
                'display_name' => '後台名稱',
                'type' => 'text',
                'group' => 'Admin',
            ],
            [
                'key' => 'site.site_name',
                'value' => __('frontend.site.name'),
                'display_name' => '網站名稱',
                'type' => 'text',
                'group' => 'Site',
            ],
            [
                'key' => 'site.site_name_en',
                'value' => __('frontend.site.name_en'),
                'display_name' => '網站名稱(英文)',
                'type' => 'text',
                'group' => 'Site',
            ],
            [
                'key' => 'site.site_name_zh',
                'value' => __('frontend.site.name_zh'),
                'display_name' => '網站名稱(中文)',
                'type' => 'text',
                'group' => 'Site',
            ],
            [
                'key' => 'site.description',
                'value' => null,
                'display_name' => '網站描述',
                'type' => 'richtext',
                'group' => 'Site',
            ],
            [
                'key' => 'site.keywords',
                'value' => null,
                'display_name' => '網站關鍵字',
                'type' => 'richtext',
                'group' => 'Site',
            ],
            [
                'key' => 'site.icon',
                'value' => PageContentSeeder::copyImageToStorage('images/favicon.ico', 'settings'),
                'display_name' => 'Icon',
                'type' => 'image',
                'group' => 'Site',
            ],
            [
                'key' => 'site.logo',
                'value' => PageContentSeeder::copyImageToStorage('images/logo.png', 'settings'),
                'display_name' => 'Logo',
                'type' => 'image',
                'group' => 'Site',
            ],
            [
                'key' => 'site.apple-touch-icon',
                'value' => PageContentSeeder::copyImageToStorage('images/apple-touch-icon.png', 'settings'),
                'display_name' => 'apple-touch-icon',
                'type' => 'image',
                'group' => 'Site',
            ],
            [
                'key' => 'site.email',
                'value' => 'info@ecec.media',
                'display_name' => 'E-mail',
                'type' => 'text',
                'group' => 'Site',
            ],
            [
                'key' => 'site.tel',
                'value' => '+85223620266',
                'display_name' => '電話',
                'type' => 'text',
                'group' => 'Site',
            ],
            [
                'key' => 'site.address',
                'value' => '香港新蒲崗雙喜街5號福和工業大廈5樓全層',
                'display_name' => '地址',
                'type' => 'content',
                'group' => 'Site',
            ],
            [
                'key' => 'site.whatsapp',
                'value' => '85223620266',
                'display_name' => 'WhatsApp',
                'type' => 'text',
                'group' => 'Site',
            ],
            [
                'key' => 'site.facebook',
                'value' => null,
                'display_name' => 'Facebook',
                'type' => 'text',
                'group' => 'Site',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate([
                'key' => $setting['key']
            ],
                $setting
            );
        }
    }
}
