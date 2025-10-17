<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Page;
use App\Models\PageTranslation;
use App\Models\PageContent;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function view($slug)
    {
        $languages = Language::active();

        $locale = app()->getLocale();

        $language = Language::where('code', $locale)->first();

        $PageTranslations = PageTranslation::with('page')
            ->where('language_id', $language->id)
            ->get()
            ->map(function ($translation) {
                return [
                    'slug' => $translation->page->slug,
                    'name' => $translation->name,
                ];
            });

        $page = Page::where('slug', $slug)->firstOrFail();

        $translation = $page->translations->where('language_id', $language->id ?? 0)->first();

        $pageContent = PageContent::where('page_id', $page->id)
            ->where('language_id', $language->id ?? 0)
            ->first();

        $title = $translation->name ?? $page->slug;
        $components = $pageContent?->content_components ?? [];

        return view('frontend.page', compact('languages', 'PageTranslations', 'page', 'title', 'components'));
    }
}
