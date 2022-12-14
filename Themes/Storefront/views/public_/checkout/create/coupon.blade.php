<div class="coupon-wrap">
    <div class="form-group">
        <div class="form-input">
            <input
                type="text"
                v-model="couponCode"
                placeholder="{{ trans('storefront::cart.enter_coupon_code') }}"
                class="form-control"
                @input="couponError = null"
            >

            <span
                class="error-message"
                v-if="couponError"
                v-text="couponError"
            >
            </span>
        </div>

        <button
            type="button"
            class="btn btn-primary btn-apply-coupon"
            :class="{ 'btn-loading': applyingCoupon }"
            @click.prevent="applyCoupon"
        >
            {{ trans('storefront::cart.apply_coupon') }}
        </button>
    </div>

    <span
        class="error-message"
        v-if="couponError"
        v-text="couponError"
    >
    </span>
</div>
