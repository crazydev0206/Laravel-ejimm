import store from '../store';

export default {
    data() {
        return {
            addingToCart: false,
        };
    },

    computed: {
        productUrl() {
            return route('products.show', this.product.slug);
        },

        hasAnyOption() {
            return this.product.options_count > 0;
        },

        hasNoOption() {
            return ! this.hasAnyOption;
        },

        hasBaseImage() {
            return this.product.base_image.length !== 0;
        },

        baseImage() {
            if (this.hasBaseImage) {
                return this.product.base_image.path;
            }

            return `${window.FleetCart.baseUrl}/themes/storefront/public/images/image-placeholder.png`;
        },

        inWishlist() {
            return store.inWishlist(this.product.id);
        },

        inCompareList() {
            return store.inCompareList(this.product.id);
        },
    },

    methods: {
        syncWishlist() {
            store.syncWishlist(this.product.id);
        },

        syncCompareList() {
            store.syncCompareList(this.product.id);
        },

        addToCart() {
            this.addingToCart = true;

            $.ajax({
                method: 'POST',
                url: route('cart.items.store', { product_id: this.product.id, qty: 1 }),
            }).then((cart) => {
                store.updateCart(cart);

                if (document.location.href !== route('cart.index').url()) {
                    $('.header-cart').trigger('click');
                }
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            }).always(() => {
                this.addingToCart = false;
            });
        },
    },
};
