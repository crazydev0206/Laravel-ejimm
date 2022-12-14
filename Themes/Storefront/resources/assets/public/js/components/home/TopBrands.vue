<template>
    <section class="top-brands-wrap clearfix">
        <div class="container">
            <div class="top-brands clearfix">
                <a
                    v-for="(topBrand, index) in topBrands"
                    :key="index"
                    :href="topBrand.url"
                    class="top-brand-image"
                >
                    <img :src="topBrand.logo.path" alt="brand logo">
                </a>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['topBrands'],
    };
</script>
