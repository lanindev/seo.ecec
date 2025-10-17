@extends("frontend.layout")

@section("title", $title)

@section("content")
    <x-frontend.page-content-components.section :components="$components" :property="$property" />
@endsection
