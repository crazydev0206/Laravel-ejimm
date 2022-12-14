<template>
    <div :href="productUrl" class="vertical-product-card">
        <a :href="productUrl" class="product-image">
            <img :src="baseImage" :class="{ 'image-placeholder': ! hasBaseImage }" alt="product-image">
        </a>

        <div class="product-info">
            <a :href="productUrl" class="product-name">
                <h6>{{ product.name }}</h6>
            </a>

            <div class="product-price" v-html="product.formatted_price"></div>

            <ProductRating :ratingPercent="product.rating_percent" :reviewCount="product.reviews.length"/>
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
