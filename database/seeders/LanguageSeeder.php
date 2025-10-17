<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::upsert([
            ['code' => 'zh_HK', 'name' => '繁體', 'is_active' => true],
        ], ['code'], ['name', 'is_active']);
    }
}
