<!DOCTYPE html>
<html lang="en" style="-ms-text-size-adjust: 100%;
                    -webkit-text-size-adjust: 100%;
                    -webkit-print-color-adjust: exact;"
>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">

        <style>
            td {
                vertical-align: top;
            }

            @media screen and (max-width: 767px) {
                .order-details {
                    width: 100% !important;
                }

                .shipping-address {
                    width: 100% !important;
                }

                .billing-address {
                    width: 100% !important;
                }
            }
        </style>
    </head>

    <body dir="rtl" style="font-family: 'Open Sans', sans-serif;
                        font-size: 15px;
                        min-width: 320px;
                        color: #555555;
                        margin: 0;"
                        >
        <table style="border-collapse: collapse;
                    min-width: 320px;
                    max-width: 900px;
                    width: 100%;
                    margin: auto;
                    border-bottom: 2px solid {{ mail_theme_color() }};"
        >
            <tbody>
                <tr>
                    <td style="padding: 0;">
                        <table style="border-collapse: collapse;
                                    width: 100%;
                                    background: {{ mail_theme_color() }};"
                        >
                            <tbody>
                                <tr>
                                    <td style="padding: 0 15px; text-align: center;">
                                        @if (is_null($logo))
                                            <h1 style="font-family: 'Open Sans', sans-serif;
                                                    font-weight: 400;
                                                    font-size: 32px;
                                                    line-height: 39px;
                                                    display: inline-block;
                                                    color: #fafafa;
                                                    margin: 17px 0 0;"
                                            >
                                                {{ setting('store_name') }}
                                            </h1>
                                        @else
                                            <div style="display: flex;
                                                        height: 64px;
                                                        width: 200px;
                                                        align-items: center;
                                                        justify-content: center;
                                                        margin: auto;"
                                            >
                                                <img src="{{ $logo }}" style="max-height: 100%; max-width: 100%;" alt="logo">
                                            </div>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 0 15px; text-align: center;">
                                        <span style="font-family: 'Open Sans', sans-serif;
                                                    font-weight: 400;
                                                    font-size: 56px;
                                                    line-height: 68px;
                                                    display: inline-block;
                                                    color: #fafafa;
                                                    margin: 3px 0 5px;"
                                        >
                                            {{ trans('storefront::invoice.invoice') }}
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 0 15px;">
                                        <table style="border-collapse: collapse;
                                                    width: 230px;
                                                    margin: 0 auto 20px;"
                                        >
                                            <tbody>
                                                <tr>
                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                            font-size: 16px;
                                                            font-weight: 400;
                                                            color: #fafafa;
                                                            padding: 0;"
                                                    >
                                                        <span style="float: right;">
                                                            {{ trans('storefront::invoice.order_id') }}:
                                                        </span>

                                                        <span style="float: left;">
                                                            #{{ $order->id }}
                                                        </span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                            font-size: 16px;
                                                            font-weight: 400;
                                                            color: #fafafa;
                                                            padding: 0;"
                                                    >
                                                        <span style="float: right;">
                                                            {{ trans('storefront::invoice.date') }}:
                                                        </span>

                                                        <span style="float: left;">
                                                            {{ $order->created_at->toFormattedDateString() }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 30px 15px;">
                        <table style="border-collapse: collapse;
                                    min-width: 320px;
                                    max-width: 760px;
                                    width: 100%;
                                    margin: auto;"
                        >
                            <tbody>
                                <tr>
                                    <td style="padding: 0; width: 50%;">
                                        <table style="border-collapse: collapse; width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 0;">
                                                        <h5 style="font-family: 'Open Sans', sans-serif;
                                                                font-weight: 600;
                                                                font-size: 18px;
                                                                line-height: 22px;
                                                                margin: 0 0 8px;
                                                                color: #444444;"
                                                        >
                                                            {{ trans('storefront::invoice.order_details') }}
                                                        </h5>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="padding: 0;">
                                                        <table class="order-details" style="border-collapse: collapse; width: 50%;">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                                            font-weight: 400;
                                                                            font-size: 15px;
                                                                            padding: 4px 0;"
                                                                    >
                                                                        {{ trans('storefront::invoice.email') }}:
                                                                    </td>

                                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                                            font-weight: 400;
                                                                            font-size: 15px;
                                                                            padding: 4px 0;
                                                                            word-break: break-all;"
                                                                    >
                                                                        {{ $order->customer_email }}
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                                            font-weight: 400;
                                                                            font-size: 15px;
                                                                            padding: 4px 0;"
                                                                    >
                                                                        {{ trans('storefront::invoice.phone') }}:
                                                                    </td>

                                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                                            font-weight: 400;
                                                                            font-size: 15px;
                                                                            padding: 4px 0;
                                                                            word-break: break-all;"
                                                                    >
                                                                        {{ $order->customer_phone }}
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                                            font-weight: 400;
                                                                            font-size: 15px;
                                                                            padding: 4px 0;"
                                                                    >
                                                                        {{ trans('storefront::invoice.payment_method') }}:
                                                                    </td>

                                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                                            font-weight: 400;
                                                                            font-size: 15px;
                                                                            padding: 4px 0;
                                                                            word-break: break-all;"
                                                                    >
                                                                        {{ $order->payment_method }}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 0;">
                                        <table class="shipping-address" style="border-collapse: collapse;
                                                                            width: 50%;
                                                                            float: left;
                                                                            margin-top: 25px;"
                                        >
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 0;">
                                                        <h5 style="font-family: 'Open Sans', sans-serif;
                                                                font-weight: 600;
                                                                font-size: 18px;
                                                                line-height: 22px;
                                                                margin: 0 0 8px;
                                                                color: #444444;"
                                                        >
                                                            {{ trans('storefront::invoice.shipping_address') }}
                                                        </h5>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                            font-weight: 400;
                                                            font-size: 15px;
                                                            padding: 0;"
                                                    >
                                                        <span style="display: block; padding: 4px 0;">
                                                            {{ $order->shipping_full_name }}
                                                        </span>

                                                        <span style="display: block; padding: 4px 0;">
                                                            {{ $order->shipping_address_1 }}
                                                        </span>

                                                        <span style="display: block; padding: 4px 0;">
                                                            {{ $order->shipping_address_2 }}
                                                        </span>

                                                        <span style="display: block; padding: 4px 0;">
                                                            {{ $order->shipping_city }}, {{ $order->shipping_state_name }} {{ $order->shipping_zip }}
                                                        </span>

                                                        <span style="display: block; padding: 4px 0;">
                                                            {{ $order->shipping_country_name }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <table class="billing-address" style="border-collapse: collapse;
                                                                            width: 50%;
                                                                            float: left;
                                                                            margin-top: 25px;"
                                        >
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 0;">
                                                        <h5 style="font-family: 'Open Sans', sans-serif;
                                                                font-weight: 600;
                                                                font-size: 18px;
                                                                line-height: 22px;
                                                                margin: 0 0 8px;
                                                                color: #444444;"
                                                        >
                                                            {{ trans('storefront::invoice.billing_address') }}
                                                        </h5>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                            font-weight: 400;
                                                            font-size: 15px;
                                                            padding: 0;"
                                                    >
                                                        <span style="display: block; padding: 4px 0;">
                                                            {{ $order->billing_full_name }}
                                                        </span>

                                                        <span style="display: block; padding: 4px 0;">
                                                            {{ $order->billing_address_1 }}
                                                        </span>

                                                        <span style="display: block; padding: 4px 0;">
                                                            {{ $order->billing_address_2 }}
                                                        </span>

                                                        <span style="display: block; padding: 4px 0;">
                                                            {{ $order->billing_city }}, {{ $order->billing_state_name }} {{ $order->billing_zip }}
                                                        </span>

                                                        <span style="display: block; padding: 4px 0;">
                                                            {{ $order->billing_country_name }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 30px 0 0;">
                                        <table style="border-collapse: collapse;
                                                    width: 100%;
                                                    border-bottom: 1px solid #e9e9e9;"
                                        >
                                            <tbody>
                                                @foreach ($order->products as $product)
                                                    <tr style="border-top: 1px solid #f1f1f1;">
                                                        <td style="padding: 14px 0 14px;">
                                                            <table style="border-collapse: collapse;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="padding: 0 0 8px;">
                                                                            <a href="{{ $product->url() }}"
                                                                                style="font-family: 'Open Sans', sans-serif;
                                                                                    font-weight: 400;
                                                                                    font-size: 18px;
                                                                                    line-height: 22px;
                                                                                    color: #444444;
                                                                                    margin: 0;
                                                                                    text-decoration: none;"
                                                                            >
                                                                                {{ $product->name }}
                                                                            </a>
                                                                        </td>
                                                                    </tr>

                                                                    @if ($product->hasAnyOption())
                                                                        <tr>
                                                                            <td style="padding: 0;">
                                                                                <table style="border-collapse: collapse; width: 100%;">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="font-family: 'Open Sans', sans-serif;
                                                                                                    font-weight: 400;
                                                                                                    font-size: 14px;
                                                                                                    padding: 0 0 8px;"
                                                                                            >
                                                                                                @foreach ($product->options as $option)
                                                                                                    <span style="display: block;">
                                                                                                        {{ $option->name }}:

                                                                                                        <span style="color: #9a9a9a; margin-right: 5px;">
                                                                                                            @if ($option->option->isFieldType())
                                                                                                                {{ $option->value }}
                                                                                                            @else
                                                                                                                {{ $option->values->implode('label', ', ') }}
                                                                                                            @endif
                                                                                                        </span>
                                                                                                    </span>
                                                                                                @endforeach
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    @endif

                                                                    <tr>
                                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                                                font-weight: 400;
                                                                                font-size: 16px;
                                                                                padding: 0 0 4px;"
                                                                        >
                                                                            <span>
                                                                                {{ trans('storefront::invoice.unit_price') }}:
                                                                            </span>

                                                                            <span style="margin-right: 5px;">
                                                                                {{ $product->unit_price->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                                                font-weight: 400;
                                                                                font-size: 16px;
                                                                                padding: 0 0 4px;"
                                                                        >
                                                                            <span>
                                                                                {{ trans('storefront::invoice.quantity') }}:
                                                                            </span>

                                                                            <span style="margin-right: 5px;">
                                                                                {{ $product->qty }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                                                font-weight: 400;
                                                                                font-size: 16px;
                                                                                padding: 0 0 4px;"
                                                                        >
                                                                            <span>
                                                                                {{ trans('storefront::invoice.line_total') }}:
                                                                            </span>

                                                                            <span style="margin-right: 5px;">
                                                                                {{ $product->line_total->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 0;">
                                        <table style="border-collapse: collapse;
                                                    width: 300px;
                                                    margin-top: 10px;
                                                    float: left;"
                                        >
                                            <tbody>
                                                <tr>
                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                            font-size: 17px;
                                                            font-weight: 400;
                                                            padding: 5px 0;"
                                                    >
                                                        {{ trans('storefront::invoice.subtotal') }}
                                                    </td>

                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                            font-size: 17px;
                                                            font-weight: 400;
                                                            padding: 5px 0;
                                                            float: left;"
                                                    >
                                                        {{ $order->sub_total->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                                                    </td>
                                                </tr>

                                                @if ($order->hasShippingMethod())
                                                    <tr>
                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                                font-size: 17px;
                                                                font-weight: 400;
                                                                padding: 5px 0;"
                                                        >
                                                            {{ $order->shipping_method }}
                                                        </td>

                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                                font-size: 17px;
                                                                font-weight: 400;
                                                                padding: 5px 0;
                                                                float: left;"
                                                        >
                                                            {{ $order->shipping_cost->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                                                        </td>
                                                    </tr>
                                                @endif

                                                @if ($order->hasCoupon())
                                                    <tr>
                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                                font-size: 17px;
                                                                font-weight: 400;
                                                                padding: 5px 0;"
                                                        >
                                                            {{ trans('storefront::invoice.coupon') }}
                                                            (<span style="color: #444444;">{{ $order->coupon->code }}</span>)
                                                        </td>

                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                                font-size: 17px;
                                                                font-weight: 400;
                                                                padding: 5px 0;
                                                                float: left;"
                                                        >
                                                            {{ $order->discount->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                                                        </td>
                                                    </tr>
                                                @endif

                                                @foreach ($order->taxes as $tax)
                                                    <tr>
                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                                font-size: 17px;
                                                                font-weight: 400;
                                                                padding: 5px 0;"
                                                        >
                                                            {{ $tax->name }}
                                                        </td>

                                                        <td style="font-family: 'Open Sans', sans-serif;
                                                                font-size: 17px;
                                                                font-weight: 400;
                                                                padding: 5px 0;
                                                                float: left;"
                                                        >
                                                            {{ $tax->order_tax->amount->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                <tr style="border-top: 1px solid #e9e9e9;">
                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                            font-size: 17px;
                                                            font-weight: 600;
                                                            padding: 5px 0;"
                                                    >
                                                        {{ trans('storefront::invoice.total') }}
                                                    </td>

                                                    <td style="font-family: 'Open Sans', sans-serif;
                                                            font-size: 17px;
                                                            font-weight: 600;
                                                            padding: 5px 0;
                                                            float: left;"
                                                    >
                                                        {{ $order->total->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
