@include('media::admin.image_picker.single', [
    'title' => trans('storefront::storefront.form.newsletter_bg_image'),
    'inputName' => 'storefront_newsletter_bg_image',
    'file' => $newsletterBgImage,
])
