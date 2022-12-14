@extends('public.layout')

@section('title', trans('storefront::404.404'))

@section('content')
    <section class="error-page-wrap">
        <div class="container">
            <div class="row error-page">
                <div class="col-xl-7 col-lg-8 col-md-18 error-page-left">
                    <h1 class="section-title">{{ trans('storefront::404.page_not_found') }}</h1>

                    <p>{{ trans('storefront::404.unable_to_find_the_page') }}</p>

                    <a href="{{ route('home') }}" class="btn btn-default btn-back-to-home">
                        {{ trans('storefront::404.back_to_home') }}
                    </a>
                </div>

                <div class="col-xl-6 col-lg-7 col-md-18 error-page-right">
                    <img src="{{ Theme::url('public/images/ejimm.webp') }}" class="error-image" alt="error image">
                </div>
            </div>
        </div>
    </section>
@endsection
