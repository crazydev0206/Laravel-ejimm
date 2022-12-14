@if ($latestProducts->isNotEmpty())
    <div class="vertical-products">
        <div class="vertical-products-header">
            <h4 class="section-title">{{ trans('storefront::products.latest_products') }}</h4>
        </div>

        <div class="vertical-products-slider">
            <div class="vertical-products-slide">
                @foreach ($latestProducts as $latestProduct)
                    <product-card-vertical :product="{{ json_encode($latestProduct) }}"></product-card-vertical>
                @endforeach
            </div>
        </div>
    </div>
@endif
