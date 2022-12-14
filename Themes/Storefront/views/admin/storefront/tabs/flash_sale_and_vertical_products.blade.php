<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('storefront_flash_sale_and_vertical_products_section_enabled', trans('storefront::attributes.section_status'), trans('storefront::storefront.form.enable_flash_sale_and_vertical_products_section'), $errors, $settings) }}

        <div class="box-content clearfix">
            <h4 class="section-title">{{ trans('storefront::storefront.form.flash_sale') }}</h4>

            {{ Form::text('storefront_flash_sale_title', trans('storefront::attributes.title'), $errors, $settings) }}
            {{ Form::select('storefront_active_flash_sale_campaign', trans('storefront::attributes.storefront_active_flash_sale_campaign'), $errors, $flashSales, $settings) }}
        </div>

        <div class="box-content clearfix">
            <h4 class="section-title">{{ trans('storefront::storefront.form.vertical_products_1') }}</h4>

            {{ Form::text('storefront_vertical_products_1_title', trans('storefront::attributes.title'), $errors, $settings) }}

            @include('admin.storefront.tabs.partials.products', ['fieldNamePrefix' => 'storefront_vertical_products_1', 'products' => $verticalProductsOne])
        </div>

        <div class="box-content clearfix">
            <h4 class="section-title">{{ trans('storefront::storefront.form.vertical_products_2') }}</h4>

            {{ Form::text('storefront_vertical_products_2_title', trans('storefront::attributes.title'), $errors, $settings) }}

            @include('admin.storefront.tabs.partials.products', ['fieldNamePrefix' => 'storefront_vertical_products_2', 'products' => $verticalProductsTwo])
        </div>

        <div class="box-content clearfix">
            <h4 class="section-title">{{ trans('storefront::storefront.form.vertical_products_3') }}</h4>

            {{ Form::text('storefront_vertical_products_3_title', trans('storefront::attributes.title'), $errors, $settings) }}

            @include('admin.storefront.tabs.partials.products', ['fieldNamePrefix' => 'storefront_vertical_products_3', 'products' => $verticalProductsThree])
        </div>
    </div>
</div>
