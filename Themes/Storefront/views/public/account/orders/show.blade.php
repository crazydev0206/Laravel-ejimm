@extends('public.layout')

@section('title', trans('storefront::account.view_order.view_order'))

@section('breadcrumb')
    <li><a href="{{ route('account.dashboard.index') }}">{{ trans('storefront::account.pages.my_account') }}</a></li>
    <li><a href="{{ route('account.orders.index') }}">{{ trans('storefront::account.pages.my_orders') }}</a></li>
    <li class="active">{{ trans('storefront::account.orders.view_order') }}</li>
@endsection

@section('content')
    <section class="order-details-wrap">
        <div class="container">
            <div class="order-details-top">
                <h3 class="section-title">{{ trans('storefront::account.view_order.view_order') }}</h3>

                <div class="row">
                    @include('public.account.orders.show.order_information')
                    @include('public.account.orders.show.billing_address')
                    @include('public.account.orders.show.shipping_address')
                </div>
            </div>
            @if ( $order->shipping_number!="")
            <div class="panel">
                <div class="panel-body" style="padding:30px">
                    <h3>Shipping Tracking</h3>
                    <hr/>
                    @if ($order->shipping_service=="dhl")
                        @foreach ($tracking["shipments"] as $item)
                            <span>Tracking Number:&nbsp; <b>{{$item["id"]}}</b></span><br/>
                            <span>Service:&nbsp; <b>DHL {{$item["service"]}}</b></span><br/>
                            <span>Origin To Destination:&nbsp; <b>{{$item["origin"]["address"]["countryCode"]}}</b> &nbsp;To&nbsp; <b>{{$item["destination"]["address"]["countryCode"]}}</b></span><br/>
                            <span>Date/Time:&nbsp; <b>{{$item["status"]["timestamp"]}}</b></span><br/>
                            <span>Pracel Location:&nbsp; <b>{{$item["status"]["location"]["address"]["addressLocality"]}}</b></span><br/>
                            <span>Status Code:&nbsp; <b>{{$item["status"]["statusCode"]}}</b></span><br/>
                            <span><b>{{$item["status"]["status"]}}</b></span><br/>
                            <hr/>
                        @endforeach
                    @endif

                </div>
            </div>
            @endif

            @include('public.account.orders.show.items_ordered')
            @include('public.account.orders.show.order_totals')
        </div>
    </section>

  
@endsection
