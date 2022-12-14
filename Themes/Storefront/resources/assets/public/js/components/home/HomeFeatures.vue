<template>
    <section class="features-wrap">
        <div class="container">
            <div class="features">
                <div class="feature-list">
                    <div class="single-feature" v-for="(feature, index) in features" :key="index">
                        <div class="feature-icon">
                            <i :class="feature.icon"></i>
                        </div>

                        <div class="feature-details">
                            <h6>{{ feature.title }}</h6>
                            <span>{{ feature.subtitle }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['features'],
    };
</script>
