<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::updateOrCreate([
            'email' => 'admin@admin.com',
        ], [
            'name' => 'admin',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            LanguageSeeder::class,
            PageSeeder::class,
            PageContentSeeder::class,
            SettingSeeder::class,
            CaseTypeSeeder::class,
            CaseSeeder::class,
            HomeSectionsSeeder::class,
            CaseShowcasesSeeder::class,
            PostCategorySeeder::class,
            SeoSectionSeeder::class
        ]);
    }
}
