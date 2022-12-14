<div class="order-details-bottom">
    <ul class="list-inline order-summary-list">
        <li>
            <label>{{ trans('storefront::account.view_order.subtotal') }}</label>

            <span class="price-amount">
                {{ $order->sub_total->convert($order->currency, $order->currency_rate)->format($order->currency) }}
            </span>
        </li>

        @if ($order->hasShippingMethod())
            <li>
                <label>{{ $order->shipping_method }}</label>

                <span class="price-amount">
                    {{ $order->shipping_cost->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                </span>
            </li>
        @endif

        @foreach ($order->taxes as $tax)
            <li>
                <label>{{ $tax->name }}</label>

                <span class="price-amount">
                    {{ $tax->order_tax->amount->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                </span>
            </li>
        @endforeach

        @if ($order->hasCoupon())
            <li>
                <label>
                    {{ trans('storefront::account.view_order.coupon') }}
                    <span class="coupon-code">[{{ $order->coupon->code }}]</span>
                </label>

                <span class="price-amount">
                    -{{ $order->discount->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                </span>
            </li>
        @endif
    </ul>

    <div class="order-summary-total">
        <label>{{ trans('storefront::account.view_order.total') }}</label>

        <span class="total-price">
            {{ $order->total->convert($order->currency, $order->currency_rate)->format($order->currency) }}
        </span>
    </div>
</div>
