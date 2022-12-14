@guest
    <div class="account-details">
        <h4 class="section-title">{{ trans('storefront::checkout.account_details') }}</h4>

        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <label for="email">
                        {{ trans('checkout::attributes.customer_email') }}<span>*</span>
                    </label>

                    <input
                        type="text"
                        name="customer_email"
                        v-model="form.customer_email"
                        id="email"
                        class="form-control"
                    >

                    <span
                        class="error-message"
                        v-if="errors.has('customer_email')"
                        v-text="errors.get('customer_email')"
                    ></span>
                </div>
            </div>

            <div class="col-md-9">
                <div class="form-group">
                    <label for="phone">
                        {{ trans('checkout::attributes.customer_phone') }}<span>*</span>
                    </label>

                    <input
                        type="text"
                        name="customer_phone"
                        v-model="form.customer_phone"
                        id="phone"
                        class="form-control"
                    >

                    <span
                        class="error-message"
                        v-if="errors.has('customer_phone')"
                        v-text="errors.get('customer_phone')"
                    ></span>
                </div>
            </div>

            <div class="col-md-18">
                <div class="form-group create-an-account-label">
                    <div class="form-check">
                        <input
                            type="checkbox"
                            name="create_an_account"
                            v-model="form.create_an_account"
                            id="create-an-account"
                        >

                        <label for="create-an-account" class="form-check-label">
                            {{ trans('checkout::attributes.create_an_account') }}
                        </label>
                    </div>
                </div>

                <div class="create-an-account-form" v-show="form.create_an_account" v-cloak>
                    <span class="helper-text">
                        {{ trans('storefront::checkout.create_an_account_by_entering_the_information_below') }}
                    </span>

                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="password">
                                    {{ trans('checkout::attributes.password') }}<span>*</span>
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    v-model="form.password"
                                    id="password"
                                    class="form-control"
                                >

                                <span
                                    class="error-message"
                                    v-if="errors.has('billing.password')"
                                    v-text="errors.get('billing.password')"
                                >
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <input type="hidden" name="customer_email" v-model="form.customer_email">
@endguest
