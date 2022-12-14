<template>
    <section class="landscape-products-wrap" v-if="hasAnyProduct">
        <div class="container">
            <div class="products-header">
                <h5 class="section-title">{{ title }}</h5>
            </div>

            <div class="landscape-products" ref="productsPlaceholder">
                <ProductCard v-for="(product, index) in products" :key="index" :product="product"></ProductCard>
            </div>
        </div>
    </section>
</template>

<script>
    import ProductCard from './ProductCard.vue';
    import { slickPrevArrow, slickNextArrow } from '../functions';

    export default {
        components: { ProductCard },

        props: ['title', 'products'],

        computed: {
            hasAnyProduct() {
                return this.products.length !== 0;
            },
        },

        mounted() {
            $(this.$refs.productsPlaceholder).slick({
                rows: 0,
                dots: false,
                arrows: true,
                infinite: true,
                slidesToShow: 6,
                slidesToScroll: 6,
                rtl: window.FleetCart.rtl,
                prevArrow: slickPrevArrow(),
                nextArrow: slickNextArrow(),
                responsive: [
                    {
                        breakpoint: 1761,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 5,
                        },
                    },
                    {
                        breakpoint: 1301,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                        },
                    },
                    {
                        breakpoint: 1051,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        },
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                        },
                    },
                    {
                        breakpoint: 881,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        },
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            dots: true,
                            arrows: false,
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        },
                    },
                    {
                        breakpoint: 641,
                        settings: {
                            dots: true,
                            arrows: false,
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        },
                    },
                ],
            });
        },
    };
</script>
