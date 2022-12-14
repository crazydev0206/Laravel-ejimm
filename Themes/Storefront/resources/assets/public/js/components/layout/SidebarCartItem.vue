<template>
    <div class="sidebar-cart-item">
        <a :href="productUrl(cartItem.product)" class="product-image">
            <img
                :src="baseImage(cartItem.product)"
                :class="{ 'image-placeholder': ! hasBaseImage(cartItem.product) }"
                alt="product image"
            >
        </a>

        <div class="product-info">
            <a :href="productUrl(cartItem.product)" class="product-name" :title="cartItem.product.name">
                {{ cartItem.product.name }}
            </a>

            <ul class="list-inline product-options">
                <li v-for="option in cartItem.options" :key="option.id">
                    <label>{{ option.name }}:</label> {{ optionValues(option) }}
                </li>
            </ul>

            <div class="product-quantity">
                {{ cartItem.qty }} x <span v-html="cartItem.unitPrice.inCurrentCurrency.formatted"></span>
            </div>
        </div>

        <div class="remove-cart-item">
            <button class="btn-remove" @click="remove">
                <i class="las la-times"></i>
            </button>
        </div>
    </div>
</template>

<script>
    import store from '../../store';
    import ProductHelpersMixin from '../../mixins/ProductHelpersMixin';

    export default {
        mixins: [
            ProductHelpersMixin,
        ],

        props: ['cartItem'],

        methods: {
            optionValues(option) {
                let values = [];

                for (let value of option.values) {
                    values.push(value.label);
                }

                return values.join(', ');
            },

            remove() {
                store.removeCartItem(this.cartItem);

                $.ajax({
                    method: 'DELETE',
                    url: route('cart.items.destroy', { cartItemId: this.cartItem.id }),
                }).then((cart) => {
                    store.updateCart(cart);
                });
            },
        },
    };
</script>
