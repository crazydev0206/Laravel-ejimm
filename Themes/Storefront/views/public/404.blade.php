<!DOCTYPE html>
<html lang="{{ locale() }}">
    <title>404 page not found</title>
    <head>
        <base href="{{ config('app.url') }}">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
        <meta name="keywords" content="Ejimm, Ejimm.de, zubehör, zoll,spielzeug,baby,party,accessoires ,airsoft,anhänger,ankleide,anziehen,aufblasbare,aufkleber,auto,baby,badminton,becher,beleuchtung,besteck,bücher,camping,casual,dart,dekoration,dekorative,draußen,fahrrad,fahrzeuge,figuren,fitness,flaggen,fußball,gepäckträger,geschenk,geschirr,gläser,golf,handschuhe,handtücher,helme,hockey,hunde,hängende,hüte,inch,jacken,jungenfahrräder,kabel,kinder,kissen,kleidung,kotflügel,laufräder,luftballons,make,masken,matten,mädchenfahrräder,mützen,outdoor,party,pendel,pflege,playmobil,pool,pumpen,puppen,puzzles,radfahren,reifen,roller,rucksäcke,räder,schals,scheinwerfer,schlauch,schlösser,schlüsselanhänger,schmuck,schuhe,sets,shirts,sicherheitswesten,skate,skateboards,socken,spiele,spielzeug,sport,stirnbänder,stühle,taschen,taschenlampen,tassen,teile,tiere,tischdekoration,trinkflaschen,uhren,wand,weihnachten,werkzeug,werkzeuge,wohnwagen,zoll,zubehör">
            <title>Ejim Computer Village – Online Shop mit mehr als 1 million Produkten - Ejim Computer Village</title>
             <meta name="description" content="404 error">
 
   
      	<!-- Primary Meta Tags -->
       
         <meta name="title" content="Ejim Computer Village – Online Shop mit mehr als 1 million Produkten - Ejim Computer Village">
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://ejimm.de/">
        <meta property="og:title" content="Ejim Computer Village – Online Shop mit mehr als 1 million Produkten - Ejim Computer Village">
        <meta property="og:description" content="Ejim Computer Village ist der führende Online-Shop für Fahrradteile & Zubehör, Spielzeug, Sport & Freizeit, Outdoor, Haus und Garten, Party, Baby & mehr!">
        <meta property="og:image" content="">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="https://ejimm.de/">
        <meta property="twitter:title" content="Ejim Computer Village – Online Shop mit mehr als 1 million Produkten - Ejim Computer Village">
        <meta property="twitter:description" content="Ejim Computer Village ist der führende Online-Shop für Fahrradteile & Zubehör, Spielzeug, Sport & Freizeit, Outdoor, Haus und Garten, Party, Baby & mehr!">
        <meta property="twitter:image" content="">

        @stack('meta')

        <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500&display=swap" rel="stylesheet">

        @if (is_rtl())
            <link rel="stylesheet" href="{{ v(Theme::url('public/css/app.rtl.css')) }}">
        @else
            <link rel="stylesheet" href="{{ v(Theme::url('public/css/app.css')) }}">
        @endif

        <link rel="shortcut icon" href="{{ url('assets/images/favicon.jpeg') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">

        @stack('styles')

        {!! setting('custom_header_assets') !!}

        <script>
            window.FleetCart = {
                baseUrl: '{{ config("app.url") }}',
                rtl: {{ is_rtl() ? 'true' : 'false' }},
                storeName: '{{ setting("store_name") }}',
                storeLogo: '{{ $logo }}',
                loggedIn: {{ auth()->check() ? 'true' : 'false' }},
                csrfToken: '{{ csrf_token() }}',
                stripePublishableKey: '{{ setting("stripe_publishable_key") }}',
                razorpayKeyId: '{{ setting("razorpay_key_id") }}',
                cart: {!! $cart !!},
                wishlist: {!! $wishlist !!},
                compareList: {!! $compareList !!},
                langs: {
                    'storefront::layout.next': '{{ trans("storefront::layout.next") }}',
                    'storefront::layout.prev': '{{ trans("storefront::layout.prev") }}',
                    'storefront::layout.search_for_products': '{{ trans("storefront::layout.search_for_products") }}',
                    'storefront::layout.all_categories': '{{ trans("storefront::layout.all_categories") }}',
                    'storefront::layout.most_searched': '{{ trans("storefront::layout.most_searched") }}',
                    'storefront::layout.search_for_products': '{{ trans("storefront::layout.search_for_products") }}',
                    'storefront::layout.category_suggestions': '{{ trans("storefront::layout.category_suggestions") }}',
                    'storefront::layout.product_suggestions': '{{ trans("storefront::layout.product_suggestions") }}',
                    'storefront::layout.product_suggestions': '{{ trans("storefront::layout.product_suggestions") }}',
                    'storefront::layout.more_results': '{{ trans("storefront::layout.more_results") }}',
                    'storefront::product_card.out_of_stock': '{{ trans("storefront::product_card.out_of_stock") }}',
                    'storefront::product_card.new': '{{ trans("storefront::product_card.new") }}',
                    'storefront::product_card.add_to_cart': '{{ trans("storefront::product_card.add_to_cart") }}',
                    'storefront::product_card.view_options': '{{ trans("storefront::product_card.view_options") }}',
                    'storefront::product_card.compare': '{{ trans("storefront::product_card.compare") }}',
                    'storefront::product_card.wishlist': '{{ trans("storefront::product_card.wishlist") }}',
                    'storefront::product_card.available': '{{ trans("storefront::product_card.available") }}',
                    'storefront::product_card.sold': '{{ trans("storefront::product_card.sold") }}',
                    'storefront::product_card.years': '{{ trans("storefront::product_card.years") }}',
                    'storefront::product_card.months': '{{ trans("storefront::product_card.months") }}',
                    'storefront::product_card.weeks': '{{ trans("storefront::product_card.weeks") }}',
                    'storefront::product_card.days': '{{ trans("storefront::product_card.days") }}',
                    'storefront::product_card.hours': '{{ trans("storefront::product_card.hours") }}',
                    'storefront::product_card.minutes': '{{ trans("storefront::product_card.minutes") }}',
                    'storefront::product_card.seconds': '{{ trans("storefront::product_card.seconds") }}',
                },
            };
        </script>

        {!! $schemaMarkup->toScript() !!}

        @stack('globals')

        @routes
      
      <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-229740650-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-229740650-1');
</script>
      
    </head>

    <body
        class="page-template {{ is_rtl() ? 'rtl' : 'ltr' }}"
        data-theme-color="#{{ $themeColor->getHex() }}"
        style="--color-primary: #{{ $themeColor->getHex() }};
            --color-primary-hover: #{{ $themeColor->darken(8) }};
            --color-primary-transparent: {{ color2rgba($themeColor, 0.8) }};
            --color-primary-transparent-lite: {{ color2rgba($themeColor, 0.3) }};"
    >
        <div class="wrapper" id="app">
            @include('public.layout.top_nav')
            @include('public.layout.header')
            @include('public.layout.navigation')
            @include('public.layout.breadcrumb')

            @yield('content')

            @include('public.home.sections.subscribe')
            @include('public.layout.footer')

            <div class="overlay"></div>

            @include('public.layout.sidebar_menu')
            @include('public.layout.sidebar_cart')
            @include('public.layout.alert')
            @include('public.layout.newsletter_popup')
            @include('public.layout.cookie_bar')
        </div>

        @stack('pre-scripts')

        <script src="{{ v(Theme::url('public/js/app.js')) }}"></script>

        @stack('scripts')
        <!-- TrustBox script -->
        <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
        <!-- End TrustBox script -->
      	
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
        <script>
           var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>

        {!! setting('custom_footer_assets') !!}

        <!-- Facebook Pixel Code -->
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '182698393719133');
  fbq('track', 'PageView');
  fbq('track', 'ViewContent');
  fbq('track', 'Search');
  fbq('track', 'Purchase');
  fbq('track', 'InitiateCheckout');
  fbq('track', 'AddToWishlist');
  fbq('track', 'AddToCart');
</script>
<noscript>
  <img height="1" width="1" style="display:none"
       src="https://www.facebook.com/tr?id=182698393719133&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
    </body>
</html>
