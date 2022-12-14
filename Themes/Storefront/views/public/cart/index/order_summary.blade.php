<aside class="order-summary-wrap" v-if="cartIsNotEmpty">
    <div class="order-summary">
        <div class="order-summary-top">
            <h3 class="section-title">{{ trans('storefront::cart.order_summary') }}</h3>
        </div>

        <div class="order-summary-middle" :class="{ loading: loadingOrderSummary }">
            <ul class="list-inline order-summary-list">
                <li>
                    <label>{{ trans('storefront::cart.subtotal') }}</label>

                    <span
                        class="price-amount"
                        v-html="cart.subTotal.inCurrentCurrency.formatted"
                    >
                    </span>
                </li>

                <li v-for="tax in cart.taxes">
                    <label v-text="tax.name"></label>

                    <span
                        class="price-amount"
                        v-html="tax.amount.inCurrentCurrency.formatted"
                    >
                    </span>
                </li>

                <li v-if="hasCoupon" v-cloak>
                    <label>
                        {{ trans('storefront::cart.coupon') }}

                        <span class="coupon-code">
                            [@{{ cart.coupon.code }}]
                            <span class="btn-remove-coupon" @click="removeCoupon">
                                <i class="las la-times"></i>
                            </span>
                        </span>
                    </label>

                    <span
                        class="price-amount"
                        v-html="'-' + cart.coupon.value.inCurrentCurrency.formatted"
                    >
                    </span>
                </li>
            </ul>

            <div class="shipping-methods" v-if="hasShippingMethod" v-cloak>
                <h6>{{ trans('storefront::cart.shipping_method') }}</h6>

                <div class="form-group">
                    <div class="form-radio" v-for="shippingMethod in cart.availableShippingMethods">
                        <input
                            type="radio"
                            name="shipping_method"
                            v-model="shippingMethodName"
                            :value="shippingMethod.name"
                            :id="shippingMethod.name"
                            @change="updateShippingMethod(shippingMethod)"
                        >

                        <label :for="shippingMethod.name" v-text="shippingMethod.label"></label>

                        <span
                            class="price-amount"
                            v-html="shippingMethod.cost.inCurrentCurrency.formatted"
                        >
                        </span>
                    </div>
                </div>
            </div>

            <div class="order-summary-total">
                <label>{{ trans('storefront::cart.total') }}</label>
                <span class="total-price" v-html="cart.total.inCurrentCurrency.formatted"></span>
            </div>
        </div>

        <div class="order-summary-bottom">
            <a
                href="{{ route('checkout.create') }}"
                class="btn btn-primary btn-proceed-to-checkout"
            >
                {{ trans('storefront::cart.proceed_to_checkout') }}
            </a>
        </div>
    </div>
</aside>
