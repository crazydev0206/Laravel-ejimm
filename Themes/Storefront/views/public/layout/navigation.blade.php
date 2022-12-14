<section class="navigation-wrap">
    <div class="container-fluid">
      @include('public.layout.navigation.primary_menu')
        <div class="navigation-inner">

        
        @if (trim($__env->yieldContent('title')) != '404')
          <img src="{{url('/assets/images/banner.jpeg')}}" width="100%" height="10%"/>
         @endif
            <span class="navigation-text">
                {{ setting('storefront_navbar_text') }}
            </span>
        </div>
    </div>
</section>
