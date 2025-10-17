@extends("frontend.layout")

@section("title", $title)

@push("head")
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:description" content="{{ setting("site.description") }}" />
    <meta property="og:image" content="{{ asset("images/share_image.jpg") }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
@endpush

@section("content")
    {{-- @if ($page->slug !== "home") --}}
    {{-- <x-frontend.page-content-components.banner :title="$title" /> --}}
    {{-- @endif --}}

    <x-frontend.page-content-components.section :components="$components" :page_slug="$page->slug" />
@endsection
