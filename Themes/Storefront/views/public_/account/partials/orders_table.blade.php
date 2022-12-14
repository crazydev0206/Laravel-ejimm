<div class="table-responsive">
    <table class="table table-borderless my-orders-table">
        <thead>
            <tr>
                <th>{{ trans('storefront::account.orders.order_id') }}</th>
                <th>{{ trans('storefront::account.date') }}</th>
                <th>{{ trans('storefront::account.status') }}</th>
                <th>{{ trans('storefront::account.orders.total') }}</th>
                <th>{{ trans('storefront::account.action') }}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>
                        {{ $order->id }}
                    </td>

                    <td>
                        {{ $order->created_at->toFormattedDateString() }}
                    </td>

                    <td>
                        <span class="badge {{ order_status_badge_class($order->status) }}">
                            {{ $order->status() }}
                        </span>
                    </td>

                    <td>
                        {{ $order->total->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                    </td>

                    <td>
                        <a href="{{ route('account.orders.show', $order) }}" class="btn btn-view">
                            <i class="las la-eye"></i>
                            {{ trans('storefront::account.orders.view') }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
