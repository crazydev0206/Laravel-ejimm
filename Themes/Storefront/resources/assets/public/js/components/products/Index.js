import noUiSlider from 'nouislider';
import { trans } from '../../functions';
import { collapseFilters } from './index/helpers';

export default {
    props: [
        'initialQuery',
        'initialBrandName',
        'initialBrandBanner',
        'initialBrandSlug',
        'initialCategoryName',
        'initialCategoryBanner',
        'initialCategorySlug',
        'initialTagName',
        'initialTagSlug',
        'initialAttribute',
        'maxPrice',
        'initialSort',
        'initialPerPage',
        'initialPage',
        'initialViewMode',
    ],

    data() {
        return {
            fetchingProducts: false,
            products: { data: [] },
            attributeFilters: [],
            brandBanner: this.initialBrandBanner,
            categoryName: this.initialCategoryName,
            categoryBanner: this.initialCategoryBanner,
            viewMode: this.initialViewMode,
            queryParams: {
                query: this.initialQuery,
                brand: this.initialBrandSlug,
                category: this.initialCategorySlug,
                tag: this.initialTagSlug,
                attribute: this.initialAttribute,
                fromPrice: 0,
                toPrice: this.maxPrice,
                sort: this.initialSort,
                perPage: this.initialPerPage,
                page: this.initialPage,
            },
        };
    },

    computed: {
        emptyProducts() {
            return this.products.data.length === 0;
        },

        totalPage() {
            return Math.ceil(this.products.total / this.queryParams.perPage);
        },

        showingResults() {
            if (this.emptyProducts) {
                return;
            }

            return trans('storefront::products.showing_results', {
                from: this.products.from,
                to: this.products.to,
                total: this.products.total,
            });
        },
    },

    mounted() {
        this.addEventListeners();
        this.initPriceFilter();
        this.fetchProducts();
    },

    methods: {
        addEventListeners() {
            $(this.$refs.sortSelect).on('change', (e) => {
                this.queryParams.sort = e.currentTarget.value;

                this.fetchProducts();
            });

            $(this.$refs.perPageSelect).on('change', (e) => {
                this.queryParams.perPage = e.currentTarget.value;

                this.fetchProducts();
            });
        },

        initPriceFilter() {
            noUiSlider.create(this.$refs.priceRange, {
                connect: true,
                direction: window.FleetCart.rtl ? 'rtl' : 'ltr',
                start: [0, this.maxPrice],
                range: {
                    min: [0],
                    max: [this.maxPrice],
                },
            });

            this.$refs.priceRange.noUiSlider.on('update', (values, handle) => {
                let value = Math.round(values[handle]);

                if (handle === 0) {
                    this.queryParams.fromPrice = value;
                } else {
                    this.queryParams.toPrice = value;
                }
            });

            this.$refs.priceRange.noUiSlider.on('change', this.fetchProducts);
        },

        updatePriceRange(fromPrice, toPrice) {
            this.$refs.priceRange.noUiSlider.set([fromPrice, toPrice]);

            this.fetchProducts();
        },

        toggleAttributeFilter(slug, value) {
            if (! this.queryParams.attribute.hasOwnProperty(slug)) {
                this.queryParams.attribute[slug] = [];
            }

            if (this.queryParams.attribute[slug].includes(value)) {
                this.queryParams.attribute[slug].splice(
                    this.queryParams.attribute[slug].indexOf(value),
                    1
                );
            } else {
                this.queryParams.attribute[slug].push(value);
            }

            this.fetchProducts({ updateAttributeFilters: false });
        },

        isFilteredByAttribute(slug, value) {
            if (! this.queryParams.attribute.hasOwnProperty(slug)) {
                return false;
            }

            return this.queryParams.attribute[slug].includes(value);
        },

        changeCategory(category) {
            this.categoryName = category.name;
            this.categoryBanner = category.banner.path;
            this.queryParams.query = null;
            this.queryParams.category = category.slug;
            this.queryParams.attribute = {};
            this.queryParams.page = 1;

            this.fetchProducts();
        },

        changePage(page) {
            this.queryParams.page = page;

            this.fetchProducts();
        },

        fetchProducts(options = { updateAttributeFilters: true }) {
            this.fetchingProducts = true;

            $.ajax({
                url: route('products.index', this.queryParams),
            }).then((response) => {
                this.products = response.products;

                if (options.updateAttributeFilters) {
                    this.attributeFilters = response.attributes;
                }

                this.$nextTick(() => {
                    collapseFilters();
                });
            }).catch((xhr) => {
                this.$notify(xhr.responseJSON.message);
            }).always(() => {
                this.fetchingProducts = false;
            });
        },
    },
};
