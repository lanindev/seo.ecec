<!DOCTYPE html>
<html lang="zh-HK">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="{{ setting("site.description") }}" />
        <meta name="keywords" content="{{ setting("site.keywords") }}" />
        <title>@yield("title") - {{ setting("site.site_name") }}</title>
        <link rel="icon" href="{{ asset("storage/" . setting("site.icon")) }}" />
        <link rel="shortcut icon" href="{{ asset("storage/" . setting("site.icon")) }}" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset("storage/" . setting("site.apple-touch-icon")) }}" />

        @stack("head")
        @stack("css")
        @stack("head_scripts")

        @vite(["resources/css/app.css", "resources/js/app.js"])
    </head>
    <body class="flex min-h-screen flex-col bg-gray-50 font-chiron">
        <x-Frontend.Layout.Header :slug="$page?->slug ?? 'default_slug'" />

        {{-- <x-frontend.page-content-components.finisher-header /> --}}

        <main class="w-full flex-grow bg-white pt-[64]">
            @yield("content")
        </main>

        @stack("scripts")

        <x-frontend.layout.footer />

        <x-frontend.layout.floating-action-button />
    </body>
</html>
