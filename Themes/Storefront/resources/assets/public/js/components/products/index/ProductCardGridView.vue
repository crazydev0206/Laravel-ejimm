<template>
    <div class="col">
        <ProductCard :product="product"/>
    </div>
</template>

<script>
    import ProductCard from './../../ProductCard.vue';

    export default {
        components: { ProductCard },

        props: ['product'],
    };
</script>
