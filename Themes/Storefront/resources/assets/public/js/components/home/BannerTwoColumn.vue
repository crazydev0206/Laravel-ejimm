<template>
    <section class="banner-wrap two-column-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <a
                        :href="data.banner_1.call_to_action_url"
                        class="banner"
                        :target="data.banner_1.open_in_new_window ? '_blank' : '_self'"
                    >
                        <img :src="data.banner_1.image.path" alt="banner">
                    </a>
                </div>

                <div class="col-md-9">
                    <a
                        :href="data.banner_2.call_to_action_url"
                        class="banner"
                        :target="data.banner_2.open_in_new_window ? '_blank' : '_self'"
                    >
                        <img :src="data.banner_2.image.path" alt="banner">
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['data'],
    };
</script>
