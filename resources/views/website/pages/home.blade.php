@extends('website.index')
@section('title', 'Male-Fashion | Template ')
@section('meta_keywords', 'Male_Fashion Template, hot sale, flash sale, casual, Male_Fashion, unica, creative')
@section('meta_description', 'Male_Fashion Template, This is an example page showing how to set dynamic meta keywords and description in Laravel.')
@section('content')
    <div class="wrapper">
        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader"></div>
        </div>

        <!-- Offcanvas Menu Begin -->
        @include('website.sections.menu')
        <!-- Offcanvas Menu End -->

        <!-- Hero Section Begin -->
        @include('website.sections.hero')
        <!-- Hero Section End -->

        <!-- Banner Section Begin -->
        @include('website.sections.banner')
        <!-- Banner Section End -->

        <!-- Product Section Begin -->
        @include('website.sections.product')
        <!-- Product Section End -->

        <!-- Categories Section Begin -->
        @include('website.sections.categories')
        <!-- Categories Section End -->

        <!-- Instagram Section Begin -->
        @include('website.sections.instagram')
        <!-- Instagram Section End -->

        <!-- Latest Blog Section Begin -->
        @include('website.sections.latest')
        <!-- Latest Blog Section End -->
    </div>
@endsection
