<template>
    <section class="grid-products-wrap clearfix">
        <div class="container">
            <div class="tab-products-header clearfix">
                <ul class="tabs float-left">
                    <li
                        v-for="(tab, index) in tabs"
                        :key="index"
                        :class="classes(tab)"
                        @click="change(tab)"
                    >
                        {{ tab.label }}
                    </li>
                </ul>
            </div>

            <div class="tab-content grid-products">
                <div v-for="(productChunks, index) in $chunk(products, 12)" :key="index" class="grid-products-inner">
                    <ProductCard v-for="product in productChunks" :key="product.id" :product="product"/>
                </div>
            </div>

            <dynamic-tab
                v-for="(tabLabel, index) in data"
                :key="index"
                :label="tabLabel"
                :url="route('storefront.product_grid.index', { tabNumber: index + 1 })"
            >
            </dynamic-tab>
        </div>
    </section>
</template>

<script>
    import ProductCard from '../ProductCard.vue';
    import DynamicTabsMixin from '../../mixins/DynamicTabsMixin';
    import { slickPrevArrow, slickNextArrow } from '../../functions';

    export default {
        components: { ProductCard },

        mixins: [
            DynamicTabsMixin,
        ],

        props: ['data'],

        methods: {
            selector() {
                return $('.grid-products');
            },

            slickOptions() {
                return {
                    rows: 0,
                    dots: false,
                    arrows: true,
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    rtl: window.FleetCart.rtl,
                    prevArrow: slickPrevArrow(),
                    nextArrow: slickNextArrow(),
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                dots: true,
                                arrows: false,
                            },
                        },
                    ],
                };
            },
        },
    };
</script>
