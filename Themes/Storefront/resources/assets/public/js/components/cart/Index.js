import store from '../../store';
import CartHelpersMixin from '../../mixins/CartHelpersMixin';
import ProductHelpersMixin from '../../mixins/ProductHelpersMixin';

export default {
    mixins: [
        CartHelpersMixin,
        ProductHelpersMixin,
    ],

    data() {
        return {
            shippingMethodName: null,
            crossSellProducts: [],
        };
    },

    computed: {
        hasAnyCrossSellProduct() {
            return this.crossSellProducts.length !== 0;
        },
    },

    created() {
        this.$nextTick(() => {
            if (store.state.cart.shippingMethodName) {
                this.changeShippingMethod(store.state.cart.shippingMethodName);
            } else {
                this.updateShippingMethod(this.firstShippingMethod);
            }

            this.fetchCrossSellProducts();
        });
    },

    methods: {
        optionValues(option) {
            let values = [];

            for (let value of option.values) {
                values.push(value.label);
            }

            return values.join(', ');
        },

        updateQuantity(cartItem, qty) {
            if (qty < 1 || this.exceedsMaxStock(cartItem, qty)) {
                return;
            }

            if (isNaN(qty)) {
                qty = 1;
            }

            this.loadingOrderSummary = true;

            cartItem.qty = qty;

            $.ajax({
                method: 'PUT',
                url: route('cart.items.update', { cartItemId: cartItem.id }),
                data: { qty: qty || 1 },
            }).then((cart) => {
                store.updateCart(cart);
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            }).always(() => {
                this.loadingOrderSummary = false;
            });
        },

        exceedsMaxStock(cartItem, qty) {
            return cartItem.product.manage_stock && cartItem.product.qty < qty;
        },

        remove(cartItem) {
            this.loadingOrderSummary = true;

            store.removeCartItem(cartItem);

            if (store.cartIsEmpty()) {
                this.crossSellProducts = [];
            }

            $.ajax({
                method: 'DELETE',
                url: route('cart.items.destroy', { cartItemId: cartItem.id }),
            }).then((cart) => {
                store.updateCart(cart);
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            }).always(() => {
                this.loadingOrderSummary = false;
            });
        },

        clearCart() {
            store.clearCart();

            if (store.cartIsEmpty()) {
                this.crossSellProducts = [];
            }

            $.ajax({
                method: 'POST',
                url: route('cart.clear.store'),
            }).then((cart) => {
                store.updateCart(cart);
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            });
        },

        changeShippingMethod(shippingMethodName) {
            this.shippingMethodName = shippingMethodName;
        },

        fetchCrossSellProducts() {
            $.ajax({
                method: 'GET',
                url: route('cart.cross_sell_products.index'),
            }).then((crossSellProducts) => {
                this.crossSellProducts = crossSellProducts;
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            });
        },
    },
};
