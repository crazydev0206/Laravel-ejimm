@if (setting('newsletter_enabled'))
    <newsletter-subscription inline-template>
        <section class="subscribe-wrap d-flex justify-content-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-14 col-lg-18">
                        <div class="subscribe">
                            <div class="row align-items-center">
                                <div class="col-lg-9 col-md-18">
                                    <div class="subscribe-text">
                                        <span class="title">
                                            {{ trans('storefront::layout.subscribe_to_our_newsletter') }}
                                        </span>

                                        <span class="sub-title">
                                            {{ trans('storefront::layout.subscribe_to_our_newsletter_subtitle') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-9 col-md-18">
                                    <div class="subscribe-field">
                                        <form @submit.prevent="subscribe">
                                            <div class="form-group">
                                                <input
                                                    type="text"
                                                    v-model="email"
                                                    class="form-control"
                                                    placeholder="{{ trans('storefront::layout.enter_your_email_address') }}"
                                                >

                                                <button
                                                    type="submit"
                                                    class="btn btn-primary btn-subscribe"
                                                    v-if="subscribed"
                                                    v-cloak
                                                >
                                                    <i class="las la-check"></i>
                                                    {{ trans('storefront::layout.subscribed') }}
                                                </button>

                                                <button
                                                    type="submit"
                                                    class="btn btn-primary btn-subscribe"
                                                    :class="{ 'btn-loading': subscribing }"
                                                    v-else
                                                    v-cloak
                                                >
                                                    {{ trans('storefront::layout.subscribe') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </newsletter-subscription>
@endif
