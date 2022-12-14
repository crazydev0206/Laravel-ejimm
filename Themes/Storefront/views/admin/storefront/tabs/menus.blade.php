<div class="row">
    <div class="col-md-8">
        {{ Form::text('translatable[storefront_navbar_text]', trans('storefront::attributes.storefront_navbar_text'), $errors, $settings) }}
        {{ Form::select('storefront_primary_menu', trans('storefront::attributes.storefront_primary_menu'), $errors, $menus, $settings) }}
        {{ Form::select('storefront_category_menu', trans('storefront::attributes.storefront_category_menu'), $errors, $menus, $settings) }}
        {{ Form::text('translatable[storefront_footer_menu_one_title]', trans('storefront::attributes.storefront_footer_menu_one_title'), $errors, $settings) }}
        {{ Form::select('storefront_footer_menu_one', trans('storefront::attributes.storefront_footer_menu_one'), $errors, $menus, $settings) }}
        {{ Form::text('translatable[storefront_footer_menu_two_title]', trans('storefront::attributes.storefront_footer_menu_two_title'), $errors, $settings) }}
        {{ Form::select('storefront_footer_menu_two', trans('storefront::attributes.storefront_footer_menu_two'), $errors, $menus, $settings) }}
    </div>
</div>
