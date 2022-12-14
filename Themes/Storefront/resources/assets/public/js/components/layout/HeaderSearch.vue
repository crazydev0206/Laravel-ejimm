<template>
    <div class="header-search-wrap" v-click-outside="hideSuggestions">
        <div class="header-search">
            <form class="search-form" @submit.prevent="search">
                <div class="header-search-lg">
                    <input
                        type="text"
                        name="query"
                        class="form-control search-input"
                        autocomplete="off"
                        v-model="form.query"
                        :placeholder="$trans('storefront::layout.search_for_products')"
                        @keydown.esc="hideSuggestions"
                        @keydown.down="nextSuggestion"
                        @keydown.up="prevSuggestion"
                    >

                    <div class="header-search-right" @focusin="hideSuggestions">
                        <select
                            name="category"
                            class="header-search-select custom-select-option arrow-black"
                            @nice-select-updated="changeCategory($event.target.value)"
                        >
                            <option value="" :selected="initialCategoryIsNotInCategoryList">
                                {{ $trans('storefront::layout.all_categories') }}
                            </option>

                            <option
                                v-for="category in categories"
                                :key="category.slug"
                                :value="category.slug"
                                :selected="category.slug === initialCategory"
                            >
                                {{ category.name }}
                            </option>
                        </select>

                        <button type="submit" class="btn btn-primary btn-search">
                            <i class="las la-search"></i>
                        </button>
                    </div>
                </div>

                <div class="header-search-sm">
                    <i class="las la-search"></i>
                </div>
            </form>

            <div v-if="mostSearchedKeywords.length !== 0" class="searched-keywords">
                <label>
                    {{ $trans('storefront::layout.most_searched') }}
                </label>

                <ul class="list-inline searched-keywords-list">
                    <li v-for="(mostSearchedKeyword, index) in mostSearchedKeywords" :key="index">
                        <a :href="route('products.index', { query: mostSearchedKeyword })">
                            {{ mostSearchedKeyword }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="header-search-sm-form">
            <form class="search-form" @submit.prevent="search">
                <div class="btn-close">
                    <i class="las la-arrow-left"></i>
                </div>

                <!-- Cannot use v-model due to a bug. See https://github.com/vuejs/vue/issues/8231 -->
                <input
                    type="text"
                    name="query"
                    class="form-control search-input-sm"
                    autocomplete="off"
                    :placeholder="$trans('storefront::layout.search_for_products')"
                    :value="form.query"
                    @input="form.query = $event.target.value"
                    @keydown.esc="hideSuggestions"
                    @keydown.down="nextSuggestion"
                    @keydown.up="prevSuggestion"
                >

                <button type="submit" class="btn btn-search">
                    <i class="las la-search"></i>
                </button>
            </form>
        </div>

        <div class="search-suggestions" v-if="shouldShowSuggestions">
            <div class="search-suggestions-inner custom-scrollbar" ref="searchSuggestionsInner">
                <div class="category-suggestion" v-if="suggestions.categories.length !== 0">
                    <h6 class="title">{{ $trans('storefront::layout.category_suggestions') }}</h6>

                    <ul class="list-inline category-suggestion-list">
                        <li
                            v-for="category in suggestions.categories"
                            :key="category.slug"
                            class="list-item"
                            :class="{ active: isActiveSuggestion(category) }"
                            :ref="category.slug"
                            @mouseover="changeActiveSuggestion(category)"
                            @mouseleave="clearActiveSuggestion"
                        >
                            <a
                                :href="category.url"
                                class="single-item"
                                v-text="category.name"
                                @click="hideSuggestions"
                            >
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="product-suggestion">
                    <h6 class="title">{{ $trans('storefront::layout.product_suggestions') }}</h6>

                    <ul class="list-inline product-suggestion-list">
                        <li
                            v-for="product in suggestions.products"
                            :key="product.slug"
                            class="list-item"
                            :class="{ active: isActiveSuggestion(product) }"
                            :ref="product.slug"
                            @mouseover="changeActiveSuggestion(product)"
                            @mouseleave="clearActiveSuggestion"
                        >
                            <a :href="product.url" class="single-item" @click="hideSuggestions">
                                <div class="product-image">
                                    <img
                                        :src="baseImage(product)"
                                        :class="{ 'image-placeholder': ! hasBaseImage(product) }"
                                        alt="product image"
                                    >
                                </div>

                                <div class="product-info">
                                    <div class="product-info-top">
                                        <h6 class="product-name" v-html="product.name"></h6>

                                        <ul class="list-inline product-badge" v-if="product.is_out_of_stock">
                                            <li class="badge badge-danger">{{ $trans('storefront::product_card.out_of_stock') }}</li>
                                        </ul>
                                    </div>

                                    <div class="product-price" v-html="product.formatted_price"></div>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <a
                        v-if="suggestions.remaining !== 0"
                        :href="moreResultsUrl"
                        @click="hideSuggestions"
                        class="more-results"
                    >
                        {{ $trans('storefront::layout.more_results', { count: this.suggestions.remaining }) }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ProductHelpersMixin from '../../mixins/ProductHelpersMixin';

    export default {
        mixins: [
            ProductHelpersMixin,
        ],

        props: ['categories', 'mostSearchedKeywords', 'initialQuery', 'initialCategory'],

        data() {
            return {
                activeSuggestion: null,
                showSuggestions: false,
                form: {
                    query: this.initialQuery,
                    category: this.initialCategory,
                },
                suggestions: {
                    categories: [],
                    products: [],
                    remaining: 0,
                },
            };
        },

        computed: {
            initialCategoryIsNotInCategoryList() {
                return ! this.categories.includes(this.initialCategory);
            },

            shouldShowSuggestions() {
                if (! this.showSuggestions) {
                    return false;
                }

                return this.hasAnySuggestion;
            },

            moreResultsUrl() {
                if (this.form.category) {
                    return route('categories.products.index', this.form);
                }

                return route('products.index', { query: this.form.query });
            },

            hasAnySuggestion() {
                return this.suggestions.products.length !== 0;
            },

            allSuggestions() {
                return [...this.suggestions.categories, ...this.suggestions.products];
            },

            firstSuggestion() {
                return this.allSuggestions[0];
            },

            lastSuggestion() {
                return this.allSuggestions[this.allSuggestions.length - 1];
            },
        },

        watch: {
            'form.query': function (newQuery) {
                if (newQuery === '') {
                    this.clearSuggestions();
                } else {
                    this.showSuggestions = true;

                    this.fetchSuggestions();
                }
            },
        },

        methods: {
            changeCategory(category) {
                this.form.category = category;

                this.fetchSuggestions();
            },

            fetchSuggestions() {
                $.ajax({
                    method: 'GET',
                    url: route('suggestions.index', this.form),
                }).then((suggestions) => {
                    this.suggestions.categories = suggestions.categories;
                    this.suggestions.products = suggestions.products;
                    this.suggestions.remaining = suggestions.remaining;

                    this.clearActiveSuggestion();
                    this.resetSuggestionScrollBar();
                });
            },

            search() {
                if (! this.form.query) {
                    return;
                }

                if (this.activeSuggestion) {
                    window.location.href = this.activeSuggestion.url;

                    this.hideSuggestions();

                    return;
                }

                if (this.form.category) {
                    window.location.href = route('categories.products.index', this.form);

                    return;
                }

                window.location.href = route('products.index', { query: this.form.query });
            },

            clearSuggestions() {
                this.suggestions.categories = [];
                this.suggestions.products = [];
            },

            hideSuggestions(e) {
                this.showSuggestions = false;

                this.clearActiveSuggestion();
            },

            isActiveSuggestion(suggestion) {
                if (! this.activeSuggestion) {
                    return false;
                }

                return this.activeSuggestion.slug === suggestion.slug;
            },

            changeActiveSuggestion(suggestion) {
                this.activeSuggestion = suggestion;
            },

            clearActiveSuggestion() {
                this.activeSuggestion = null;
            },

            nextSuggestion() {
                if (! this.hasAnySuggestion) {
                    return;
                }

                this.activeSuggestion = this.allSuggestions[this.nextSuggestionIndex()];

                if (! this.activeSuggestion) {
                    this.activeSuggestion = this.firstSuggestion;
                }

                this.adjustSuggestionScrollBar();
            },

            prevSuggestion() {
                if (! this.hasAnySuggestion) {
                    return;
                }

                if (this.prevSuggestionIndex() === -1) {
                    this.clearActiveSuggestion();

                    return;
                }

                this.activeSuggestion = this.allSuggestions[this.prevSuggestionIndex()];

                if (! this.activeSuggestion) {
                    this.activeSuggestion = this.lastSuggestion;
                }

                this.adjustSuggestionScrollBar();
            },

            nextSuggestionIndex() {
                return this.currentSuggestionIndex() + 1;
            },

            prevSuggestionIndex() {
                return this.currentSuggestionIndex() - 1;
            },

            currentSuggestionIndex() {
                return this.allSuggestions.indexOf(this.activeSuggestion);
            },

            adjustSuggestionScrollBar() {
                this.$refs.searchSuggestionsInner.scrollTop = this.$refs[this.activeSuggestion.slug][0].offsetTop - 200;
            },

            resetSuggestionScrollBar() {
                this.$refs.searchSuggestionsInner.scrollTop = 0;
            },
        },
    };
</script>
