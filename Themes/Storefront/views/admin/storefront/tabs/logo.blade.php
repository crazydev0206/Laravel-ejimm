@include('media::admin.image_picker.single', [
    'title' => trans('storefront::storefront.form.favicon'),
    'inputName' => 'storefront_favicon',
    'file' => $favicon,
])

<div class="media-picker-divider"></div>

@include('media::admin.image_picker.single', [
    'title' => trans('storefront::storefront.form.header_logo'),
    'inputName' => 'translatable[storefront_header_logo]',
    'file' => $headerLogo,
])

<div class="media-picker-divider"></div>

@include('media::admin.image_picker.single', [
    'title' => trans('storefront::storefront.form.mail_logo'),
    'inputName' => 'translatable[storefront_mail_logo]',
    'file' => $mailLogo,
])
