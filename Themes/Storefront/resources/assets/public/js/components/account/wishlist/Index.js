import store from '../../../store';
import VPagination from '../../VPagination.vue';
import ProductHelpersMixin from '../../../mixins/ProductHelpersMixin';

export default {
    components: { VPagination },

    mixins: [
        ProductHelpersMixin,
    ],

    data() {
        return {
            fetchingWishlist: false,
            products: { data: [] },
            currentPage: 1,
        };
    },

    computed: {
        wishlistIsEmpty() {
            return this.products.data.length === 0;
        },

        totalPage() {
            return Math.ceil(this.products.total / 20);
        },
    },

    created() {
        this.fetchWishlist();
    },

    methods: {
        fetchWishlist() {
            this.fetchingWishlist = true;

            $.ajax({
                method: 'GET',
                url: route('wishlist.products.index', {
                    page: this.currentPage,
                }),
            }).then((products) => {
                this.products = products;
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            }).always(() => {
                this.fetchingWishlist = false;
            });
        },

        remove(product) {
            this.products.data.splice(this.products.data.indexOf(product), 1);
            this.products.total--;

            store.removeFromWishlist(product.id);
        },
    },
};
