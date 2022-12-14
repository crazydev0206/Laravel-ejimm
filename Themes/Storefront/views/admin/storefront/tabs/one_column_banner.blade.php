<div class="accordion-box-content">
    <div class="row">
        <div class="col-md-8">
            {{ Form::checkbox('storefront_one_column_banner_enabled', trans('storefront::attributes.section_status'), trans('storefront::storefront.form.enable_one_column_banner_section'), $errors, $settings) }}
        </div>
    </div>

    <div class="tab-content clearfix">
        <div class="panel-wrap">
            @include('admin.storefront.tabs.partials.single_banner', [
                'label' => trans('storefront::storefront.form.banner'),
                'name' => 'storefront_one_column_banner',
                'banner' => $banner,
            ])
        </div>
    </div>
</div>
