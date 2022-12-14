<section class="top-nav-wrap">
    <div class="container">
        <div class="top-nav">
            <div class="row justify-content-between">
                <ul class="top-bar-list hide-mobile">
                    <li>Schnelle Lieferung</li>
                    <li>Niedrige Preise</li>
                    <li>Kein Mindestbestellwert</li>
                    <li>Exzellenter service</li>
                    <li>350.000 einzigartige Produkte</li>
                </ul>

                <div class="top-nav-right">
                    <div class="trustpilot-widget" data-locale="de-DE" data-template-id="5419b6a8b0d04a076446a9ad" data-businessunit-id="61ab46c823edefe68d284eab" data-style-height="24px" data-style-width="100%" data-theme="light" data-stars="1,2,3,4,5" data-no-reviews="hide" data-scroll-to-list="true" data-allow-robots="true" data-min-review-count="10">
                        <a href="https://de.trustpilot.com/review/ejimm.de" target="_blank" rel="noopener">Trustpilot</a>
                      </div>
                    <!--
                    <ul class="list-inline top-nav-right-list">
                        <li>
                            <a href="{{ route('contact.create') }}">
                                <i class="las la-phone"></i>
                                {{ trans('storefront::layout.contact') }}
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('compare.index') }}">
                                <i class="las la-random"></i>
                                {{ trans('storefront::layout.compare') }}
                            </a>
                        </li>

                        @if (is_multilingual())
                            <li>
                                <i class="las la-language"></i>
                                <select class="custom-select-option arrow-black" onchange="location = this.value">
                                    @foreach (supported_locales() as $locale => $language)
                                        <option value="{{ localized_url($locale) }}" {{ locale() === $locale ? 'selected' : '' }}>
                                            {{ $language['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </li>
                        @endif

                        @if (is_multi_currency())
                            <li>
                                <i class="las la-money-bill"></i>
                                <select class="custom-select-option arrow-black" onchange="location = this.value">
                                    @foreach (setting('supported_currencies') as $currency)
                                        <option
                                            value="{{ route('current_currency.store', ['code' => $currency]) }}"
                                            {{ currency() === $currency ? 'selected' : '' }}
                                        >
                                            {{ $currency }}
                                        </option>
                                    @endforeach
                                </select>
                            </li>
                        @endif

                        @auth
                      <li>
                                <a href="{{ route('account.dashboard.index') }}">
                                    <i class="las la-user"></i>
                                    {{ trans('storefront::layout.account') }}
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}">
                                    <i class="las la-sign-in-alt"></i>
                                    {{ trans('storefront::layout.login') }}
                                </a>
                            </li>
                        @endauth
                    </ul>-->
                </div>
            </div>
        </div>
    </div>
</section>
