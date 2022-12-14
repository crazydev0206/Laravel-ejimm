<div class="product-image-gallery">
    <div class="additional-image-wrap">
        @if (! $product->base_image->exists)
            <div class="additional-image">
                <img src="{{ asset('themes/storefront/public/images/image-placeholder.png') }}" alt="Image placeholder" class="image-placeholder">
            </div>
        @else
            <div class="additional-image">
                <img src="{{ $product->base_image->path }}" alt="Product image">
            </div>
        @endif

        @foreach ($product->additional_images as $additionalImage)
            @if (! $additionalImage->exists)
                <div class="additional-image">
                    <img src="{{ asset('themes/storefront/public/images/image-placeholder.png') }}" alt="Image placeholder" class="image-placeholder">
                </div>
            @else
                <div class="additional-image">
                    <img src="{{ $additionalImage->path }}" alt="product-additional-image">
                </div>
            @endif
        @endforeach
    </div>

    <div class="base-image-wrap">
        <div class="base-image">
            @if (! $product->base_image->exists)
                <div class="base-image-inner">
                    <div class="base-image-slide" data-image="{{ asset('themes/storefront/public/images/image-placeholder.png') }}">
                        <img src="{{ asset('themes/storefront/public/images/image-placeholder.png') }}" alt="Image placeholder" class="image-placeholder">

                        <div class="btn-gallery-trigger">
                            <i class="las la-search-plus"></i>
                        </div>
                    </div>
                </div>
            @else
                <div class="base-image-inner">
                    <div class="base-image-slide" data-image="{{ $product->base_image->path }}">
                        <img src="{{ $product->base_image->path }}" alt="Product image">

                        <div class="btn-gallery-trigger">
                            <i class="las la-search-plus"></i>
                        </div>
                    </div>
                </div>
            @endif

            @foreach ($product->additional_images as $additionalImage)
                @if (! $additionalImage->exists)
                    <div class="base-image-inner">
                        <div class="base-image-slide" data-image="{{ asset('themes/storefront/public/images/image-placeholder.png') }}">
                            <img src="{{ asset('themes/storefront/public/images/image-placeholder.png') }}" alt="Image placeholder" class="image-placeholder">

                            <div class="btn-gallery-trigger">
                                <i class="las la-search-plus"></i>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="base-image-inner">
                        <div class="base-image-slide" data-image="{{ $additionalImage->path }}">
                            <img src="{{ $additionalImage->path }}" alt="Product image">

                            <div class="btn-gallery-trigger">
                                <i class="las la-search-plus"></i>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
