@extends('backend.master')

@section('title', $page->seo_title)
@section('description', $page->seo_description)

@section('content')
    @include('backend.pages._templates')
@endsection
