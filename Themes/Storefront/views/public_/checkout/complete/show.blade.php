@extends('public.layout')

@section('content')
    <section class="order-complete-wrap">
        <div class="container">
            <div class="order-complete-wrap-inner">
                <div class="order-complete">
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                        <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                    </svg>

                    <h2>{{ trans('storefront::order_complete.order_placed') }}</h2>
                    <span>{!! trans('storefront::order_complete.your_order_has_been_placed', ['id' => $order->id]) !!}</span>
                </div>
            </div>
        </div>
    </section>
@endsection
