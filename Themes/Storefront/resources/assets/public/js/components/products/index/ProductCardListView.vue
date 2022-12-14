<template>
    <div class="list-product-card">
        <div class="list-product-card-inner">
            <div class="product-card-left">
                <a :href="productUrl" class="product-image">
                    <img :src="baseImage" :class="{ 'image-placeholder': ! hasBaseImage }" alt="product-image">

                    <ul class="list-inline product-badge">
                        <li class="badge badge-danger" v-if="product.is_out_of_stock">
                            {{ $trans('storefront::product_card.out_of_stock') }}
                        </li>

                        <li class="badge badge-primary" v-else-if="product.is_new">
                            {{ $trans('storefront::product_card.new') }}
                        </li>

                        <li class="badge badge-success" v-if="product.has_percentage_special_price">
                            -{{ product.special_price_percent }}%
                        </li>
                    </ul>
                </a>
            </div>

            <div class="product-card-right">
                <a :href="productUrl" class="product-name">
                    <h6>{{ product.name }}</h6>
                </a>

                <div class="clearfix"></div>

                <ProductRating :ratingPercent="product.rating_percent" :reviewCount="product.reviews.length"/>

                <div class="product-price" v-html="product.formatted_price"></div>

                <button
                    v-if="hasNoOption || product.is_out_of_stock"
                    class="btn btn-default btn-add-to-cart"
                    :class="{ 'btn-loading': addingToCart }"
                    :disabled="product.is_out_of_stock"
                    @click="addToCart"
                >
                    <i class="las la-cart-arrow-down"></i>
                    {{ $trans('storefront::product_card.add_to_cart') }}
                </button>

                <a
                    v-else
                    :href="productUrl"
                    class="btn btn-default btn-add-to-cart"
                >
                    <i class="las la-eye"></i>
                    {{ $trans('storefront::product_card.view_options') }}
                </a>

                <div class="product-card-actions">
                    <button
                        class="btn btn-wishlist"
                        :class="{ 'added': inWishlist }"
                        @click="syncWishlist"
                    >
                        <i class="la-heart" :class="inWishlist ? 'las' : 'lar'"></i>
                        {{ $trans('storefront::product_card.wishlist') }}
                    </button>

                    <button
                        class="btn btn-compare"
                        :class="{ 'added': inCompareList }"
                        @click="syncCompareList"
                    >
                        <i class="las la-random"></i>
                        {{ $trans('storefront::product_card.compare') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ProductRating from './../../ProductRating.vue';
    import ProductCardMixin from '../../../mixins/ProductCardMixin';

    export default {
        components: { ProductRating },

        mixins: [
            ProductCardMixin,
        ],

        props: ['product'],
    };
</script>
