import store from '../../store';
import Errors from '../../Errors';
import ProductRating from '../ProductRating.vue';
import ProductCardMixin from '../../mixins/ProductCardMixin';
import RelatedProducts from './show/RelatedProducts.vue';

export default {
    components: { ProductRating, RelatedProducts },

    mixins: [
        ProductCardMixin,
    ],

    props: ['product', 'reviewCount', 'avgRating'],

    data() {
        return {
            price: this.product.formatted_price,
            activeTab: 'description',
            currentReviewPage: 1,
            fetchingReviews: false,
            reviews: {},
            addingNewReview: false,
            reviewForm: {},
            cartItemForm: {
                product_id: this.product.id,
                qty: 1,
                options: {},
            },
            errors: new Errors(),
        };
    },

    computed: {
        totalReviews() {
            if (! this.reviews.total) {
                return this.reviewCount;
            }

            return this.reviews.total;
        },

        ratingPercent() {
            return (this.avgRating / 5) * 100;
        },

        emptyReviews() {
            return this.totalReviews === 0;
        },

        totalReviewPage() {
            return Math.ceil(this.reviews.total / 4);
        },
    },

    created() {
        this.fetchReviews();
    },

    mounted() {
        $(this.$refs.upSellProducts).slick({
            rows: 0,
            dots: false,
            arrows: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            rtl: window.FleetCart.rtl,
        });
    },

    methods: {
        updateQuantity(qty) {
            if (qty < 1 || this.exceedsMaxStock(qty)) {
                return;
            }

            if (isNaN(qty)) {
                qty = 1;
            }

            this.cartItemForm.qty = qty;
        },

        exceedsMaxStock(qty) {
            return this.product.manage_stock && this.product.qty < qty;
        },

        changeReviewPage(page) {
            this.currentReviewPage = page;

            this.fetchReviews();
        },

        updatePrice() {
            this.$nextTick(() => {
                $.ajax({
                    method: 'POST',
                    url: route('products.price.show', { id: this.product.id }),
                    data: { options: this.cartItemForm.options },
                }).then((price) => {
                    this.price = price;
                }).catch((xhr) => {
                    this.$notify(xhr.responseJSON.message);
                });
            });
        },

        updateSelectTypeOptionValue(optionId, e) {
            this.$set(this.cartItemForm.options, optionId, $(e.target).val());

            this.errors.clear(`options.${optionId}`);
        },

        updateCheckboxTypeOptionValue(optionId, e) {
            let values = $(e.target)
                .parents('.variant-check')
                .find('input[type="checkbox"]:checked')
                .map((_, el) => {
                    return el.value;
                });

            this.$set(this.cartItemForm.options, optionId, values.get());
        },

        customRadioTypeOptionValueIsActive(optionId, valueId) {
            if (! this.cartItemForm.options.hasOwnProperty(optionId)) {
                return false;
            }

            return this.cartItemForm.options[optionId] === valueId;
        },

        syncCustomRadioTypeOptionValue(optionId, valueId) {
            if (this.customRadioTypeOptionValueIsActive(optionId, valueId)) {
                this.$delete(this.cartItemForm.options, optionId);
            } else {
                this.$set(this.cartItemForm.options, optionId, valueId);

                this.errors.clear(`options.${optionId}`);
            }

            this.updatePrice();
        },

        customCheckboxTypeOptionValueIsActive(optionId, valueId) {
            if (! this.cartItemForm.options.hasOwnProperty(optionId)) {
                this.$set(this.cartItemForm.options, optionId, []);

                return false;
            }

            return this.cartItemForm.options[optionId].includes(valueId);
        },

        syncCustomCheckboxTypeOptionValue(optionId, valueId) {
            if (this.customCheckboxTypeOptionValueIsActive(optionId, valueId)) {
                this.cartItemForm.options[optionId].splice(
                    this.cartItemForm.options[optionId].indexOf(valueId),
                    1
                );
            } else {
                this.cartItemForm.options[optionId].push(valueId);

                this.errors.clear(`options.${optionId}`);
            }

            this.updatePrice();
        },

        fetchReviews() {
            this.fetchingReviews = true;

            $.ajax({
                method: 'GET',
                url: route('products.reviews.index', {
                    productId: this.product.id,
                    page: this.currentReviewPage,
                }),
            }).then((reviews) => {
                this.reviews = reviews;
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            }).always(() => {
                this.fetchingReviews = false;
            });
        },

        addNewReview() {
            this.addingNewReview = true;

            $.ajax({
                method: 'POST',
                url: route('products.reviews.store', { productId: this.product.id }),
                data: this.reviewForm,
            }).then((review) => {
                this.reviewForm = {};
                this.reviews.total++;
                this.reviews.data.unshift(review);

                $('.captcha-input').prev('img').trigger('click');
            }).catch((xhr) => {
                if (xhr.status === 422) {
                    this.errors.record(xhr.responseJSON.errors);
                } else {
                    this.$notify(xhr.responseJSON.message);
                }
            }).always(() => {
                this.addingNewReview = false;
            });
        },

        addToCart() {
            this.addingToCart = true;

            $.ajax({
                method: 'POST',
                url: route('cart.items.store', this.cartItemForm),
            }).then((cart) => {
                store.updateCart(cart);

                $('.header-cart').trigger('click');
            }).catch((xhr) => {
                if (xhr.status === 422) {
                    this.errors.record(xhr.responseJSON.errors);
                } else {
                    this.$notify(xhr.responseJSON.message);
                }
            }).always(() => {
                this.addingToCart = false;
            });
        },
    },
};
