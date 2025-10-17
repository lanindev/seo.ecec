<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'SEO搜尋引擎優化', 'slug' => 'seo'],
            ['name' => '最新公告', 'slug' => 'announcements'],
            ['name' => '市場調查', 'slug' => 'research'],
            ['name' => '行銷策略', 'slug' => 'marketing-strategy'],
            ['name' => '社交媒體推廣', 'slug' => 'social-media'],
            ['name' => '科技評比', 'slug' => 'tech'],
            ['name' => '網頁設計', 'slug' => 'web-design'],
        ];

        foreach ($categories as $category) {
            PostCategory::updateOrCreate(
                ['slug' => $category['slug']],
                ['name' => $category['name']]
            );
        }
    }
}
