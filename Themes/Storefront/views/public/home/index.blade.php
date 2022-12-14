@extends('public.layout')

@section('title', setting('store_tagline'))

@section('content')
    
    <br/>
    <div class="container">
        <div class="feature-content-box row">
            <div class="col-md-6 col-lg-6 col-sm-12 feature-box">
                <a href="https://www.ejimm.de/categories/outdoor-YPD1giaV/products">
                    <img src="{{url('/assets/images/feature-banner-1.jpg')}}" alt="img" width="100%"/>
                    <h3>Volare Kinderfahrräder</h3>
                    <span>Weitere Informationen ></span>
                </a>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 feature-box">
                <a href="https://www.ejimm.de/categories/madchenfahrradermadchenfahrrader-20-zoll/products">
                    <img src="{{url('/assets/images/feature-banner-2.jpg')}}" alt="img" width="100%"/>
                    <h3>Amigo Kinderfahrräder</h3>
                    <span>Sortiment anzeigen ></span>
                </a>
            </div>

            <div class="col-md-6 col-lg-6 col-sm-12 feature-box">
                <a href="https://www.ejimm.de/products/amigo-e-vibe-s1-28-zoll-54-cm-damen-3g-rollerbrakes-mattblau">
                    <img src="{{url('/assets/images/feature-banner-3.jpg')}}" alt="img" width="100%"/>
                    <h3>Amigo E-Bikes</h3>
                    <span>Sortiment anzeigen ></span>
                </a>
            </div>
        </div>
    </div>
    <br/>

    @if (setting('storefront_features_section_enabled'))
        <home-features :features="{{ json_encode($features) }}"></home-features>
    @endif

    @if (setting('storefront_featured_categories_section_enabled'))
        <featured-categories :data="{{ json_encode($featuredCategories) }}"></featured-categories>
    @endif

    @if (setting('storefront_three_column_full_width_banners_enabled'))
        <banner-three-column-full-width :data="{{ json_encode($threeColumnFullWidthBanners) }}"></banner-three-column-full-width>
    @endif

    @if (setting('storefront_product_tabs_1_section_enabled'))
        <product-tabs-one :data="{{ json_encode($productTabsOne) }}"></product-tabs-one>
    @endif

    @if (setting('storefront_top_brands_section_enabled') && $topBrands->isNotEmpty())
        <top-brands :top-brands="{{ json_encode($topBrands) }}"></top-brands>
    @endif
    <br/>
    @if (setting('storefront_one_column_banner_enabled'))
        <banner-one-column :banner="{{ json_encode($oneColumnBanner) }}"></banner-one-column>
    @endif
    <br/>
    @if (setting('storefront_flash_sale_and_vertical_products_section_enabled'))
        <flash-sale-and-vertical-products :data="{{ json_encode($flashSaleAndVerticalProducts) }}"></flash-sale-and-vertical-products>
    @endif

    @if (setting('storefront_two_column_banners_enabled'))
        <banner-two-column :data="{{ json_encode($twoColumnBanners) }}"></banner-two-column>
    @endif

    @if (setting('storefront_product_grid_section_enabled'))
        <product-grid :data="{{ json_encode($productGrid) }}"></product-grid>
    @endif

    @if (setting('storefront_three_column_banners_enabled'))
        <banner-three-column :data="{{ json_encode($threeColumnBanners) }}"></banner-three-column>
    @endif

    @if (setting('storefront_product_tabs_2_section_enabled'))
        <product-tabs-two :data="{{ json_encode($tabProductsTwo) }}"></product-tabs-two>
    @endif

    <br/>
    <div class="homepage-text-content">
        <div class="container">
            <h3>Campingausrüstung online kaufen</h3>
            <h1>Ejim Computer Village</h1>
            <h3>Das sind wir – professionell und engagiert</h3>
            <p>Im Januar 2019 ging der Onlineshop Ejim Computer Village mit Sitz im hessischen Biblis an den Start. Ejim Computer Village ist unsere große Leidenschaft. Das Interesse an der Welt der digitalen Medien war schon immer sehr groß. Wir sind fasziniert von den rasanten Entwicklungen und es ist immer wieder eine Freude, innovative Neuerscheinungen für unsere Kunden zu entdecken. Unser Ziel ist es, Ihnen Produkte anzubieten, die Ihren Bedürfnissen entsprechen, von hoher Qualität sind und mit einem guten Preis überzeugen.</p>
            <br>
            <h3>Das sind Sie für uns – wertvoll und authentisch</h3>
            <p>Die Zufriedenheit unserer Kunden ist unser oberstes Gebot. Ejim Computer Village legt für Sie großen Wert auf einen engen Kontakt zu Lieferanten und Geschäftspartnern. Nur so entsteht ein Vertrauensverhältnis, das einen dauerhaft hohen Qualitätsstandard zu einem fairen Preis gewährleistet. Als Kunde proﬁtieren Sie bei Ejim Computer Village von umfangreichen</p>
            <p>Service-Leistungen. Im Onlineshop stellen wir Ihnen regelmäßig die aktuellen Trends vor und im für Sie eingerichteten Sale sparen Sie bares Geld. Sie erhalten einen Überblick über die am besten bewerteten Produkte und wir informieren Sie über derzeitige Top-Kategorien, sowie starke Verkaufsschlager.</p>
            <p>Ihr Einkauf ist ein sicheres Zahlungssystem und ein 14-tägiges Rückgaberecht. Ejim Computer Village reagiert sofort auf Ihre Bestellung, damit Sie von einer möglichst schnellen Lieferung proﬁtieren.Sie sind sich nicht sicher, welches Produkt das richtige für Sie ist? Wir beraten Sie gerne. Rufen Sie uns an,damit wir Ihre Fragen rund um Ejim Computer Village beantworten können.</p>
            <p>Wir wünschen Ihnen viel Freude bei Ihrer Tour durch unseren Onlineshop.</p>
          &nbsp;
          <div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Warum bei Ejim Computer Village Deutschland einkaufen?
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        Ejim Computer Village legt äußerst großen Wert auf engen Kontakt zu Lieferanten und Handelsunternehmensbegleitern.  Nur so lasst sich eine Datierungsabwägung schaffen, die eine dauerhaft überdurchschnittliche Qualität zu einem ehrlichen Preis garantiert. Innerhalb des Ejimm-Online-Shops präsentieren wir Ihnen regelmäßig die aktuellen Entwicklungen und Verfügbarkeiten verschiedener Produkte auf einer Plattform und stellen den für Sie eingerichteten Verkauf bereit, damit Sie bares Geld sparen können. Auf Ejimm erhalten Sie ganz einfach eine Top-Level-Ansicht der am besten bewerteten Merchandise-Produkte. Wir sind hier, um die Einkaufsaufgabe für jeden Kunden zu erleichtern, indem wir alles auf einer einzigen Website haben
      </div>
    </div>
  </div>

  </div>

        </div>
    </div>
@endsection
