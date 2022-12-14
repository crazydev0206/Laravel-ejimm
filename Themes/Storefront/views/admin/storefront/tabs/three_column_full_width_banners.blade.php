<div class="accordion-box-content">
    <div class="row">
        <div class="col-md-8">
            {{ Form::checkbox('storefront_three_column_full_width_banners_enabled', trans('storefront::attributes.section_status'), trans('storefront::storefront.form.enable_three_column_full_width_banners_section'), $errors, $settings) }}
        </div>
    </div>

    <div class="tab-content clearfix">
        <div class="panel-wrap">
            @include('media::admin.image_picker.single', [
                'title' => trans('storefront::storefront.form.background'),
                'inputName' => 'storefront_three_column_full_width_banners_background_file_id',
                'file' => $banners['background']->image,
            ])

            @include('admin.storefront.tabs.partials.single_banner', [
                'label' => trans('storefront::storefront.form.banner_1'),
                'name' => 'storefront_three_column_full_width_banners_1',
                'banner' => $banners['banner_1'],
            ])

            @include('admin.storefront.tabs.partials.single_banner', [
                'label' => trans('storefront::storefront.form.banner_2'),
                'name' => 'storefront_three_column_full_width_banners_2',
                'banner' => $banners['banner_2'],
            ])

            @include('admin.storefront.tabs.partials.single_banner', [
                'label' => trans('storefront::storefront.form.banner_3'),
                'name' => 'storefront_three_column_full_width_banners_3',
                'banner' => $banners['banner_3'],
            ])
        </div>
    </div>
</div>
