<div class="filter-section-wrap">
    <div class="filter-section-header">
        <h4 class="section-title">
            {{ trans('storefront::products.filters') }}
        </h4>

        <i class="las la-times sidebar-filter-close"></i>
    </div>

    <div class="filter-section-inner custom-scrollbar">
        <div class="filter-section">
            <h6>{{ trans('storefront::products.price') }}</h6>

            <div class="filter-price">
                <form @submit.prevent="fetchProducts">
                    <div class="price-input">
                        <div class="form-group">
                            <input
                                type="number"
                                id="price-from"
                                class="form-control price-from"
                                :value="queryParams.fromPrice"
                                @change="updatePriceRange($event.target.value, null)"
                                ref="fromPrice"
                            >
                        </div>

                        <div class="form-group">
                            <input
                                type="number"
                                id="price-to"
                                class="form-control price-to"
                                :value="queryParams.toPrice"
                                @change="updatePriceRange(null, $event.target.value)"
                                ref="toPrice"
                            >
                        </div>
                    </div>

                    <div ref="priceRange" @change="fetchProducts"></div>
                </form>
            </div>
        </div>

        <div v-for="attribute in attributeFilters" :key="attribute.id" class="filter-section" v-cloak>
            <h6 v-text="attribute.name"></h6>

            <div class="filter-checkbox">
                <div v-for="value in attribute.values" :key="value.id" class="form-check">
                    <input
                        type="checkbox"
                        :name="attribute.slug"
                        :id="'attribute-' + value.id"
                        :checked="isFilteredByAttribute(attribute.slug, value.value)"
                        @click="toggleAttributeFilter(attribute.slug, value.value)"
                    >

                    <label :for="'attribute-' + value.id" v-text="value.value"></label>
                </div>
            </div>
        </div>
    </div>
</div>
