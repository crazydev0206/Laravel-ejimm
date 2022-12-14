<footer class="footer-wrap mt-5">
    <div class="container">
        <div class="footer">
            <div class="footer-top">
                <div class="row">
                     <div class="col-lg-4 col-md-4">
                        <div class="footer-links">
                            <h4 class="title">RECHTLICHES</h4>

                            <ul class="list-inline contact-info">
                                <li>
                                    <a href="">Impressum</a>
                                </li>
                                <li>
                                    <a href="">Datenschutz</a>
                                </li>
                                <li>
                                    <a href="">Widerrufsbehlerung</a>
                                </li>
                                <li>
                                    <a href="">Allgemeine Geschäftsbedingungen</a>
                                </li>
                                <li>
                                    <a href="">Versand und Zahlungbedienung</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="footer-links">
                            <h4 class="title">INFORMATIONEN</h4>

                            <ul class="list-inline contact-info">
                                <li>
                                    <a href="">Startseite</a>
                                </li>
                                <li>
                                    <a href="">Katalog</a>
                                </li>
                                <li>
                                    <a href="">Blog</a>
                                </li>
                                <li>
                                    <a href="">Über uns</a>
                                </li>
                                <li>
                                    <a href="">Marken</a>
                                </li>
                                <li>
                                    <a href="">Bedienungsanleitungen</a>
                                </li>
                                <li>
                                    <a href="">Größentabellen</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <div class="footer-links">
                            <h4 class="title">SERVICE</h4>

                            <ul class="list-inline contact-info">
                                <li>
                                   <h4 class="title">
                                        <i class="las la-headset" ></i> 
                                        <span>Haben Sie noch Fragen ?</span>
                                        <br>
                                        <span>06245 9488677</span>
                                   </h4>
                                </li>
                                <li>
                                   <a href="">Kontaktformular</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4">
                        <div class="footer-links">
                            <h4 class="title">NEWSLETTER</h4>

                            <form>
                                <div class="form-group" >
                                    <label for="exampleFormControlInput1" style="color:white;">Vorname oder ganzer Name</label>
                                    <input  type="text" class="form-control" id="exampleFormControlInput1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" style="color:white;">Email</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1" style="color:white;"> Indem Du fortfährst, akzeptierst Du unsere Datenschutzerklärung.</label>
                                </div>
                                <button type="submit" class="btn btn-dark">Abonnieren</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="footer-links">
                            <h4 class="title">Socials</h4>

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
                    <!-- <div class="col-lg-4 col-md-6">
                        <div class="contact-us">
                            <h4 class="title">{{ trans('storefront::layout.contact_us') }}</h4>

                            <ul class="list-inline contact-info">
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
                    </div> -->

                    <!-- <div class="col-lg-3 col-md-5">
                        <div class="footer-links">
                            <h4 class="title">{{ trans('storefront::layout.my_account') }}</h4>

                            <ul class="list-inline">
                                <li>
                                    <a href="{{ route('account.dashboard.index') }}">
                                        {{ trans('storefront::account.pages.dashboard') }}
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('account.orders.index') }}">
                                        {{ trans('storefront::account.pages.my_orders') }}
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('account.reviews.index') }}">
                                        {{ trans('storefront::account.pages.my_reviews') }}
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('account.profile.edit') }}">
                                        {{ trans('storefront::account.pages.my_profile') }}
                                    </a>
                                </li>

                                @auth
                                    <li>
                                        <a href="{{ route('logout') }}">
                                            {{ trans('storefront::account.pages.logout') }}
                                        </a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div> -->

                    <!-- @if ($footerMenuOne->isNotEmpty())
                        <div class="col-lg-3 col-md-5">
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
                        </div>
                    @endif -->

                    <!-- @if ($footerMenuTwo->isNotEmpty())
                        <div class="col-lg-3 col-md-5">
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
                        </div>
                    @endif

                    @if ($footerTags->isNotEmpty())
                        <div class="col-lg-4 col-md-7">
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
                        </div>
                    @endif -->
                </div>
            </div>

            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-9 col-sm-18">
                        <div class="footer-text">
                            {!! $copyrightText !!}
                        </div>
                    </div>

                    <div class="col-md-9 col-sm-18">
                    <div class="footer-text" style="text-align: right;font-size: 60px;color: green;"><i class="lab la-whatsapp"></i></div>
                    </div>

                    @if ($acceptedPaymentMethodsImage->exists)
                        <div class="col-md-9 col-sm-18">
                            <div class="footer-payment">
                                <img src="{{ $acceptedPaymentMethodsImage->path }}" alt="accepted payment methods">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>