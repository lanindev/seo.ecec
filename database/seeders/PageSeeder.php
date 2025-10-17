<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Lang;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            'home',
            'cases',
            'news',
            'seo',
            'blog',
            'contact',
            'privacy_policy',
            'terms',
        ];

        $languages = Language::where('is_active', true)->get();

        foreach ($pages as $slug) {
            $page = Page::firstOrCreate(['slug' => $slug]);

            foreach ($languages as $language) {
                $locale = $language->code;

                $name = Lang::get("frontend.{$slug}", [], $locale);

                $page->translations()->firstOrCreate([
                    'language_id' => $language->id,
                ], [
                    'name' => $name,
                ]);
            }
        }

    }
}
