<?php

namespace App\View\Components\Frontend\Layout;

use App\Models\Language;
use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public $pages;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $language = Language::where('code', 'zh_HK')->first();

        $this->pages = Page::with(['translations' => function ($query) use ($language) {
            $query->where('language_id', $language->id ?? 0);
        }])->whereNotIn('slug', ['privacy_policy', 'terms'])
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.layout.header');
    }
}
