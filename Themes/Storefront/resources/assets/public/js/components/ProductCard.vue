<template>
    <div class="product-card">
        <div class="product-card-top">
            <a :href="productUrl" class="product-image">
                <img :src="baseImage" :class="{ 'image-placeholder': ! hasBaseImage }" alt="product image">
            </a>

            <div class="product-card-actions">
                <button
                    class="btn btn-wishlist"
                    :class="{ 'added': inWishlist }"
                    :title="$trans('storefront::product_card.wishlist')"
                    @click="syncWishlist"
                >
                    <i class="la-heart" :class="inWishlist ? 'las' : 'lar'"></i>
                </button>

                <button
                    class="btn btn-compare"
                    :class="{ 'added': inCompareList }"
                    :title="$trans('storefront::product_card.compare')"
                    @click="syncCompareList"
                >
                    <i class="las la-random"></i>
                </button>
            </div>

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
        </div>

        <div class="product-card-middle">
            <ProductRating :ratingPercent="product.rating_percent" :reviewCount="product.reviews.length"/>

            <a :href="productUrl" class="product-name">
                <h6>{{ product.name }}</h6>
            </a>

            <div class="product-price product-price-clone" v-html="product.formatted_price"></div>
        </div>

        <div class="product-card-bottom">
            <div class="product-price" v-html="product.formatted_price"></div>

            <button
                v-if="hasNoOption || product.is_out_of_stock"
                class="btn btn-primary btn-add-to-cart"
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
                class="btn btn-primary btn-add-to-cart"
            >
                <i class="las la-eye"></i>
                {{ $trans('storefront::product_card.view_options') }}
            </a>
        </div>
    </div>
</template>

<script>
    import ProductRating from './ProductRating.vue';
    import ProductCardMixin from '../mixins/ProductCardMixin';

    export default {
        components: { ProductRating },

        mixins: [
            ProductCardMixin,
        ],

        props: ['product'],
    };
</script>
