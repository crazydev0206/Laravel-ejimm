@extends('public.account.layout')

@section('title', trans('storefront::account.pages.my_reviews'))

@section('account_breadcrumb')
    <li class="active">{{ trans('storefront::account.pages.my_reviews') }}</li>
@endsection

@section('panel')
    <div class="panel">
        <div class="panel-header">
            <h4>{{ trans('storefront::account.pages.my_reviews') }}</h4>
        </div>

        <div class="panel-body">
            @if ($reviews->isEmpty())
                <div class="empty-message">
                    <h3>{{ trans('storefront::account.reviews.no_reviews') }}</h3>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-borderless my-reviews-table">
                        <thead>
                            <tr>
                                <th>{{ trans('storefront::account.image') }}</th>
                                <th>{{ trans('storefront::account.product_name') }}</th>
                                <th>{{ trans('storefront::account.status') }}</th>
                                <th>{{ trans('storefront::account.date') }}</th>
                                <th>{{ trans('storefront::account.reviews.rating') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($reviews as $review)
                                <tr>
                                    <td>
                                        <div class="product-image">
                                            @if ($review->product->base_image->exists)
                                                <img src="{{ $review->product->base_image->path }}" alt="{{ $review->product->name }}">
                                            @else
                                                <img src="{{ asset('themes/storefront/public/images/image-placeholder.png') }}" class="image-placeholder">
                                            @endif
                                        </div>
                                    </td>

                                    <td>
                                        <a href="{{ route('products.show', ['slug' => $review->product->slug]) }}" class="product-name">
                                            {{ $review->product->name }}
                                        </a>
                                    </td>

                                    <td>
                                        <span class="badge {{ $review->is_approved ? 'badge-success' : 'badge-secondary' }}">
                                            {{ $review->status() }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $review->created_at->toFormattedDateString() }}
                                    </td>

                                    <td>
                                        @include('public.account.reviews.partials.product_rating')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="panel-footer">
            {!! $reviews->links() !!}
        </div>
    </div>
@endsection
