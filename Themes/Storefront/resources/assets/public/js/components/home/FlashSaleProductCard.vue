<template>
    <div class="daily-deals-inner">
        <div class="daily-deals-top">
            <a :href="productUrl" class="product-image">
                <img :src="baseImage" :class="{ 'image-placeholder': ! hasBaseImage }" alt="product-image">
            </a>
        </div>

        <a :href="productUrl" class="product-name">
            <h6>{{ product.name }}</h6>
        </a>

        <div class="product-info">
            <div class="product-price" v-html="product.formatted_price"></div>

            <ProductRating :ratingPercent="product.rating_percent" :reviewCount="product.reviews.length"/>
        </div>

        <div class="daily-deals-countdown clearfix"></div>

        <div class="deal-progress">
            <div class="deal-stock">
                <div class="stock-available">
                    {{ $trans('storefront::product_card.available') }}
                    <span>{{ product.pivot.qty }}</span>
                </div>

                <div class="stock-sold">
                    {{ $trans('storefront::product_card.sold') }}
                    <span>{{ product.pivot.sold }}</span>
                </div>
            </div>

            <div class="progress">
                <div class="progress-bar" :style="{ width: progress }"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import ProductRating from '../ProductRating.vue';
    import ProductCardMixin from '../../mixins/ProductCardMixin';

    export default {
        components: { ProductRating },

        mixins: [
            ProductCardMixin,
        ],

        props: ['product'],

        computed: {
            progress() {
                return (this.product.pivot.sold / this.product.pivot.qty * 100) + '%';
            },
        },

        mounted() {
            $(this.$el).find('.daily-deals-countdown').countdown({
                until: new Date(this.product.pivot.end_date),
                format: 'DHMS',
                labels: [
                    this.$trans('storefront::product_card.years'),
                    this.$trans('storefront::product_card.months'),
                    this.$trans('storefront::product_card.weeks'),
                    this.$trans('storefront::product_card.days'),
                    this.$trans('storefront::product_card.hours'),
                    this.$trans('storefront::product_card.minutes'),
                    this.$trans('storefront::product_card.seconds'),
                ],
            });
        },
    };
</script>
