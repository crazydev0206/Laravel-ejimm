<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('storefront_product_tabs_1_section_enabled', trans('storefront::attributes.section_status'), trans('storefront::storefront.form.enable_product_tabs_one_section'), $errors, $settings) }}

        <div class="clearfix"></div>

        <div class="box-content clearfix">
            <h4 class="section-title">{{ trans('storefront::storefront.form.tab_1') }}</h4>

            {{ Form::text('translatable[storefront_product_tabs_1_section_tab_1_title]', trans('storefront::attributes.title'), $errors, $settings) }}

            @include('admin.storefront.tabs.partials.products', [
                'fieldNamePrefix' => 'storefront_product_tabs_1_section_tab_1',
                'products' => $tabOneProducts,
            ])
        </div>

        <div class="box-content clearfix">
            <h4 class="section-title">{{ trans('storefront::storefront.form.tab_2') }}</h4>

            {{ Form::text('translatable[storefront_product_tabs_1_section_tab_2_title]', trans('storefront::attributes.title'), $errors, $settings) }}

            @include('admin.storefront.tabs.partials.products', [
                'fieldNamePrefix' => 'storefront_product_tabs_1_section_tab_2',
                'products' => $tabTwoProducts,
            ])
        </div>

        <div class="box-content clearfix">
            <h4 class="section-title">{{ trans('storefront::storefront.form.tab_3') }}</h4>

            {{ Form::text('translatable[storefront_product_tabs_1_section_tab_3_title]', trans('storefront::attributes.title'), $errors, $settings) }}

            @include('admin.storefront.tabs.partials.products', [
                'fieldNamePrefix' => 'storefront_product_tabs_1_section_tab_3',
                'products' => $tabThreeProducts,
            ])
        </div>

        <div class="box-content clearfix">
            <h4 class="section-title">{{ trans('storefront::storefront.form.tab_4') }}</h4>

            {{ Form::text('translatable[storefront_product_tabs_1_section_tab_4_title]', trans('storefront::attributes.title'), $errors, $settings) }}

            @include('admin.storefront.tabs.partials.products', [
                'fieldNamePrefix' => 'storefront_product_tabs_1_section_tab_4',
                'products' => $tabFourProducts,
            ])
        </div>
    </div>
</div>
