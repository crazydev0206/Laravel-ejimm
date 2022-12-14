@hasAccess('admin.products.index')
    <div class="form-group">
        <label for="{{ "{$fieldNamePrefix}_product_type" }}" class="col-md-3 control-label text-left">
            {{ trans('storefront::attributes.type') }}
        </label>

        <div class="col-md-9">
            <select name="{{ "{$fieldNamePrefix}_product_type" }}" class="form-control custom-select-black product-type" id="{{ "{$fieldNamePrefix}_product_type" }}">
                <option value="">{{ trans('storefront::storefront.form.please_select') }}</option>

                @hasAccess('admin.categories.index')
                    <option value="category_products" {{ setting("{$fieldNamePrefix}_product_type") === 'category_products' ? 'selected' : '' }}>
                        {{ trans('storefront::storefront.form.product_types.category_products') }}
                    </option>
                @endHasAccess

                @unless ($featuredCategories ?? false)
                    <option value="latest_products" {{ setting("{$fieldNamePrefix}_product_type") === 'latest_products' ? 'selected' : '' }}>
                        {{ trans('storefront::storefront.form.product_types.latest_products') }}
                    </option>

                    <option value="recently_viewed_products" {{ setting("{$fieldNamePrefix}_product_type") === 'recently_viewed_products' ? 'selected' : '' }}>
                        {{ trans('storefront::storefront.form.product_types.recently_viewed_products') }}
                    </option>
                @endunless

                <option value="custom_products" {{ setting("{$fieldNamePrefix}_product_type") === 'custom_products' ? 'selected' : '' }}>
                    {{ trans('storefront::storefront.form.product_types.custom_products') }}
                </option>
            </select>
        </div>
    </div>

    @if (auth()->user()->hasAccess('admin.categories.index') && ! ($featuredCategories ?? false))
        <div class="category-products {{ setting("{$fieldNamePrefix}_product_type") === 'category_products' ? '' : 'hide' }}">
            {{ Form::select("{$fieldNamePrefix}_category_id", trans('storefront::attributes.category'), $errors, $categories, $settings) }}
        </div>
    @endif

    <div class="products-limit {{ in_array(setting("{$fieldNamePrefix}_product_type"), ['latest_products', 'recently_viewed_products']) ? '' : 'hide' }}">
        {{ Form::number("{$fieldNamePrefix}_products_limit", trans('storefront::attributes.products_limit'), $errors, $settings) }}
    </div>

    <div class="custom-products {{ setting("{$fieldNamePrefix}_product_type") === 'custom_products' ? '' : 'hide' }}">
        {{ Form::select("{$fieldNamePrefix}_products", trans('storefront::attributes.products'), $errors, $products, $settings, ['class' => 'selectize prevent-creation', 'data-url' => route('admin.products.index'), 'multiple' => true]) }}
    </div>
@endHasAccess
