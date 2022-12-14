<div class="col-lg-6 col-sm-9">
    <div class="order-billing-details">
        <h4>{{ trans('storefront::account.view_order.billing_address') }}</h4>

        <address>
            <span>{{ $order->billing_full_name }}</span>
            <span>{{ $order->billing_address_1 }}</span>

            @if ($order->billing_address_2)
                <span>{{ $order->billing_address_2 }}</span>
            @endif

            <span>{{ $order->billing_city }}, {{ $order->billing_state_name }} {{ $order->billing_zip }}</span>
            <span>{{ $order->billing_country_name }}</span>
        </address>
    </div>
</div>
