<section class="navigation-wrap">
    <div class="container">
        <div class="navigation-inner">
            @include('public.layout.navigation.category_menu')
            @include('public.layout.navigation.primary_menu')

            <span class="navigation-text">
                {{ setting('storefront_navbar_text') }}
            </span>
        </div>
    </div>
</section>
