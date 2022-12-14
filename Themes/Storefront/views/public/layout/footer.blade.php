<footer class="footer-wrap">
    <div class="container">
        <div class="footer">
            <div class="footer-top">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="footer-links">
                            <h4 class="title">RECHTLICHES</h4>

                            <!-- <ul class="list-inline contact-info">
                                @if (setting('store_phone') && ! setting('store_phone_hide'))
                                    <li>
                                        <i class="las la-phone"></i>
                                        <span>{{ setting('store_phone') }}</span>
                                    </li>
                                @endif

                                @if (setting('store_email') && ! setting('store_email_hide'))
                                    <li>
                                        <i class="las la-envelope"></i>
                                        <span>{{ setting('store_email') }}</span>
                                    </li>
                                @endif

                                @if (setting('storefront_address'))
                                    <li>
                                        <i class="las la-map"></i>
                                        <span>{{ setting('storefront_address') }}</span>
                                    </li>
                                @endif
                            </ul>-->

                            <ul class="list-inline">
                                <li>
                                    <a href="https://itrk.legal/hS8.F.e89.html?imp=1">
                                        Impressum
                                    </a>
                                </li>
                                <li>
                                    <a href="https://itrk.legal/hS8.F.e89.html">
                                        Datenschutz
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="https://itrk.legal/hS8.5P.e89.html">
                                        Widerrufsbehlerung
                                    </a>
                                </li>
                                <li>
                                    <a href="https://itrk.legal/hS8.2Y.e89.html">
                                        Allgemeine Geschäftsbedingungen
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.ejimm.de/shippingAndPayment">
                                        Versand und Zahlungbedienung
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <div class="footer-links">
                            <h4 class="title">INFORMATIONEN</h4>

                            <ul class="list-inline">
                                <li>
                                    <a href="#">
                                        Startseite
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.ejimm.de/de/categories">
                                        Katalog
                                    </a>
                                </li>
                                <li>
                                    <a href="https://ejimm.de/">
                                        Blog
                                    </a>
                                </li>
                                <li>
                                    <a href="https://ejimm.de/#aboutUs">
                                        Über uns
                                    </a>
                                </li>
                                <li>
                                    <a href="https://ejimm.de/">
                                        Marken
                                    </a>
                                </li>

                                <li>
                                    <a href="https://ejimm.de/">
                                        Bedienungsanleitungen
                                    </a>
                                </li>
                                <li>
                                    <a href="https://ejimm.de/">
                                        Größentabellen
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-4">
                        <div class="contact-us">
                            <h4 class="title">SERVICE</h4>
                            <div class="footer-support">
                                <i class="las la-headset"></i> 
                                <h6> Haben Sie noch Fragen ?</h6>
                                <h5>06245 9488677</h5>
                            </div>
                            <br/>


                            <ul class="list-inline footer-links">
                                <li>
                                    <a href="#">
                                        Kontaktformular
                                    </a>
                                </li>
                            </ul>
                            @if (social_links()->isNotEmpty())
                                <ul class="list-inline social-links">
                                    @foreach (social_links() as $icon => $socialLink)
                                        <li>
                                            <a href="{{ $socialLink }}">
                                                <i class="{{ $icon }}"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="footer-links">
                            <div class="footer-form-warp">
                                <h4 class="title">NEWSLETTER</h4>
                                <form>
                                    <div class="form-group">
                                        <label for="nam">Vorname oder ganzer Name</label>
                                        <input type="text" class="form-control" name="name" id="nam" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="emal">Email</label>
                                        <input type="email" class="form-control" name="email" id="emal"  required/>
                                    </div>
                                    <label>
                                    <input type="checkbox" required/> &nbsp;
                                    Indem Du fortfährst, akzeptierst Du unsere Datenschutzerklärung.</label>
                                    <button class="btn btn-dark btn-block">Abonnieren</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    @if ($footerMenuOne->isNotEmpty())
                        <!--<div class="col-lg-3 col-md-5">
                            <div class="footer-links">
                                <h4 class="title">{{ setting('storefront_footer_menu_one_title') }}</h4>

                                <ul class="list-inline">
                                    @foreach ($footerMenuOne as $menuItem)
                                        <li>
                                            <a href="{{ $menuItem->url() }}" target="{{ $menuItem->target }}">
                                                {{ $menuItem->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>-->
                    @endif

                    @if ($footerMenuTwo->isNotEmpty())
                        <!--<div class="col-lg-3 col-md-5">
                            <div class="footer-links">
                                <h4 class="title">{{ setting('storefront_footer_menu_two_title') }}</h4>

                                <ul class="list-inline">
                                    @foreach ($footerMenuTwo as $menuItem)
                                        <li>
                                            <a href="{{ $menuItem->url() }}" target="{{ $menuItem->target }}">
                                                {{ $menuItem->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>-->
                    @endif

                    @if ($footerTags->isNotEmpty())
                        <!--<div class="col-lg-4 col-md-7">
                            <div class="footer-links footer-tags">
                                <h4 class="title">{{ trans('storefront::layout.tags') }}</h4>

                                <ul class="list-inline">
                                    @foreach ($footerTags as $footerTag)
                                        <li>
                                            <a href="{{ $footerTag->url() }}">
                                                {{ $footerTag->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>-->
                    @endif
                </div>
            </div>
        </div>
        

    </div>
    <div class="footer-bottom">
        <div class=" container">
            <div class="row">
                <div class="col-md-9 col-sm-18">
                    <div class="footer-text text-left text-black">
                        {!! $copyrightText !!}
                    </div>
                </div>
                <div class="col-md-9 col-sm-18 text-right">
                        <img src="{{url('assets/images/payments.png')}}"  alt="img" width="300px"/>
                </div>
            </div>
        </div>
    </div>
</footer>

<a class="whatsapp-box" href="https://api.whatsapp.com/send?phone=062459488677"  data-bs-toggle="tooltip" data-bs-placement="left"  title="Contact Us">
    <img src="{{url('assets/images/whatsapp.png')}}"  alt="img" width="70px"/>
</a>

