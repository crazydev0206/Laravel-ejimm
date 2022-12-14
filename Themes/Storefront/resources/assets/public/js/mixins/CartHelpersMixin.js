import store from '../store';

export default {
    data() {
        return {
            loadingOrderSummary: false,
            shippingMethodName: null,
            applyingCoupon: false,
            couponCode: null,
            couponError: null,
        };
    },

    computed: {
        cart() {
            return store.state.cart;
        },

        cartIsEmpty() {
            return store.cartIsEmpty();
        },

        cartIsNotEmpty() {
            return ! store.cartIsEmpty();
        },

        hasShippingMethod() {
            return store.hasShippingMethod();
        },

        firstShippingMethod() {
            return Object.keys(store.state.cart.availableShippingMethods)[0];
        },

        hasCoupon() {
            return store.state.cart.coupon.code !== undefined;
        },
    },

    methods: {
        applyCoupon() {
            if (! this.couponCode) {
                return;
            }

            this.loadingOrderSummary = true;
            this.applyingCoupon = true;

            $.ajax({
                method: 'POST',
                url: route('cart.coupon.store', { coupon: this.couponCode }),
            }).then((cart) => {
                this.couponCode = null;

                store.updateCart(cart);
            }).catch((xhr) => {
                this.couponError = xhr.responseJSON.message;
            }).always(() => {
                this.loadingOrderSummary = false;
                this.applyingCoupon = false;
            });
        },

        removeCoupon() {
            this.loadingOrderSummary = true;

            $.ajax({
                method: 'DELETE',
                url: route('cart.coupon.destroy'),
            }).then((cart) => {
                store.updateCart(cart);
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            }).always(() => {
                this.loadingOrderSummary = false;
            });
        },

        updateShippingMethod(shippingMethodName) {
            if (! shippingMethodName) {
                return;
            }

            this.loadingOrderSummary = true;

            this.changeShippingMethod(shippingMethodName);

            $.ajax({
                method: 'POST',
                url: route('cart.shipping_method.store', { shipping_method: shippingMethodName }),
            }).then((cart) => {
                store.updateCart(cart);
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            }).always(() => {
                this.loadingOrderSummary = false;
            });
        },
    },
};
