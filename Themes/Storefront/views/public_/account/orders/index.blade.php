@extends('public.account.layout')

@section('title', trans('storefront::account.pages.my_orders'))

@section('account_breadcrumb')
    <li class="active">{{ trans('storefront::account.pages.my_orders') }}</li>
@endsection

@section('panel')
    <div class="panel">
        <div class="panel-header">
            <h4>{{ trans('storefront::account.pages.my_orders') }}</h4>
        </div>

        <div class="panel-body">
            @if ($orders->isEmpty())
                <div class="empty-message">
                    <h3>{{ trans('storefront::account.orders.no_orders') }}</h3>
                </div>
            @else
                @include('public.account.partials.orders_table')
            @endif
        </div>

        <div class="panel-footer">
            {!! $orders->links() !!}
        </div>
    </div>
@endsection
