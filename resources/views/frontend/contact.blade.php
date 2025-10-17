@extends("frontend.layout")

@section("title", __("frontend.contact"))

@section("content")
    <x-frontend.page-content-components.section :components="$components" :page_slug="$page->slug" />
@endsection
