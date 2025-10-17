<?php

namespace App\Providers\Filament;

use App\Filament\Resources\PageContentResource;
use App\Models\Language;
use App\Models\Page;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-presentation-chart-line';
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandLogo(fn() => view('filament.admin.logo'))
            ->brandName(fn() => Schema::hasTable('settings') ? setting('admin.title') : 'Admin title')
            ->brandLogoHeight('3.5rem')
            ->favicon(asset('images/favicon.ico'))
            ->login()
            ->colors([
                'primary' => Color::Sky,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
//                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->darkMode(false)
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->navigationItems($this->customNavigationItems());
    }

    protected function customNavigationItems(): array
    {
        if (!Schema::hasTable('languages') || !Schema::hasTable('pages')) {
            return [];
        }

        $languages = Language::active()->keyBy('code');
        $langCode = app()->getLocale();
        $language = $languages->get($langCode);
        $items = [];

//        if ($language) {
//            $pages = Page::whereHas('contents', function ($query) use ($language) {
//                $query->where('language_id', $language->id);
//            })
//                ->with(['translations' => function ($q) use ($language) {
//                    $q->where('language_id', $language->id);
//                }])
//                ->get();
//
//            foreach ($pages as $page) {
//                $translation = $page->translations->first();
//
//                $label = $translation?->name ?? $page->slug;
//
//                $pageContent = $page->contents()->where('language_id', $language->id)->first();
//
//                $url = fn() => PageContentResource::getUrl('edit', ['record' => $pageContent->id]);
//
//                $items[] = NavigationItem::make($label)
//                    ->icon('heroicon-o-pencil-square')
//                    ->group(__('admin.navigation_group.label') . __('admin.actions.edit'))
//                    ->sort(2 + $page->id)
//                    ->url($url, shouldOpenInNewTab: false)
//                    ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.resources.page-contents.edit') &&
//                        (string)request()->route('record') === (string)$pageContent->id
//                    );
//            }
//        }

        return $items;
    }
}
