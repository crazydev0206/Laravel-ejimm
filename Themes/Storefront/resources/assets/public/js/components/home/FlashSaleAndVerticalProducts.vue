<template>
    <section class="vertical-products-wrap">
        <div class="container">
            <div class="row">
                <flash-sale
                    :title="data.flash_sale_title"
                    :url="route('storefront.flash_sale_products.index')"
                >
                </flash-sale>

                <vertical-products
                    :title="data.vertical_products_1_title"
                    :url="route('storefront.vertical_products.index', { columnNumber: 1 })"
                >
                </vertical-products>

                <vertical-products
                    :title="data.vertical_products_2_title"
                    :url="route('storefront.vertical_products.index', { columnNumber: 2 })"
                >
                </vertical-products>

                <vertical-products
                    :title="data.vertical_products_3_title"
                    :url="route('storefront.vertical_products.index', { columnNumber: 3 })"
                >
                </vertical-products>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['data'],
    };
</script>
