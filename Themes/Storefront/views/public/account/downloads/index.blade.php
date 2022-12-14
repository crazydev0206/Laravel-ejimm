@extends('public.account.layout')

@section('title', trans('storefront::account.pages.my_downloads'))

@section('account_breadcrumb')
    <li class="active">{{ trans('storefront::account.pages.my_downloads') }}</li>
@endsection

@section('panel')
    <div class="panel">
        <div class="panel-header">
            <h4>{{ trans('storefront::account.pages.my_downloads') }}</h4>
        </div>

        <div class="panel-body">
            @if ($downloads->isEmpty())
                <div class="empty-message">
                    <h3>{{ trans('storefront::account.downloads.no_downloadable_files') }}</h3>
                </div>
            @else
                @include('public.account.downloads.partials.downloads_table')
            @endif
        </div>
    </div>
@endsection
