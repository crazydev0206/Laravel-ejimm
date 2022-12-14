<template>
    <div class="col-xl-4 col-lg-6">
        <div class="vertical-products">
            <div class="vertical-products-header">
                <h4 class="section-title">{{ title }}</h4>
            </div>

            <div class="vertical-products-slider" ref="productsPlaceholder">
                <div v-for="(productChunks, index) in $chunk(products, 5)" :key="index" class="vertical-products-slide">
                    <ProductCardVertical v-for="product in productChunks" :key="product.id" :product="product"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ProductCardVertical from '../ProductCardVertical.vue';

    export default {
        components: { ProductCardVertical },

        props: ['title', 'url'],

        data() {
            return {
                products: [],
            };
        },

        created() {
            $.ajax({
                method: 'GET',
                url: this.url,
            }).then((products) => {
                this.products = products;

                this.$nextTick(() => {
                    $(this.$refs.productsPlaceholder).slick(this.slickOptions());
                });
            });
        },

        methods: {
            slickOptions() {
                return {
                    rows: 0,
                    dots: false,
                    arrows: true,
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    rtl: window.FleetCart.rtl,
                };
            },
        },
    };
</script>
