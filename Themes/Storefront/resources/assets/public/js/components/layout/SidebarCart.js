import store from '../../store';
import SidebarCartItem from './SidebarCartItem.vue';

export default {
    components: { SidebarCartItem },

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
    },
};
