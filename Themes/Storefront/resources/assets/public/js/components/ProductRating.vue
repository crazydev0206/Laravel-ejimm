<template>
    <div class="product-rating">
        <div class="back-stars">
            <i class="las la-star"></i>
            <i class="las la-star"></i>
            <i class="las la-star"></i>
            <i class="las la-star"></i>
            <i class="las la-star"></i>

            <div class="front-stars" :style="{ width: ratingPercent + '%' }">
                <i class="las la-star"></i>
                <i class="las la-star"></i>
                <i class="las la-star"></i>
                <i class="las la-star"></i>
                <i class="las la-star"></i>
            </div>
        </div>

        <span class="rating-count" v-if="hasReviewCount">({{ this.reviewCount }})</span>
    </div>
</template>

<script>
    export default {
        props: ['ratingPercent', 'reviewCount'],

        computed: {
            hasReviewCount() {
                return this.reviewCount !== undefined;
            },
        },
    };
</script>
