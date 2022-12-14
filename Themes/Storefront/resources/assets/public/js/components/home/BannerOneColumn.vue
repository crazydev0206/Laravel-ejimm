<template>
    <section class="banner-wrap one-column-banner">
        <div class="container">
            <a
                :href="banner.call_to_action_url"
                class="banner"
                :target="banner.open_in_new_window ? '_blank' : '_self'"
            >
                <img :src="banner.image.path" alt="banner">
            </a>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['banner'],
    };
</script>
