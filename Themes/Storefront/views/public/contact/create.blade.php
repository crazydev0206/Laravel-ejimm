@extends('public.layout')

@section('title', trans('storefront::contact.contact'))

@section('content')
    <section class="contact-wrap">
        <div class="container">
            <div class="map-canvas">
                <iframe
                    width="600"
                    height="500"
                    src="https://maps.google.com/maps?q={{ setting('storefront_address') }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    frameborder="0"
                    scrolling="no"
                    marginheight="0"
                    marginwidth="0">
                </iframe>
            </div>

            <div class="contact-form-wrap">
                <div class="contact-form-inner">
                    <div class="contact-form-left">
                        <h3 class="title">{{ trans('storefront::contact.contact') }}</h3>

                        <ul class="list-inline contact-info">
                            @if (setting('store_phone') && ! setting('store_phone_hide'))
                                <li>
                                    <i class="las la-phone"></i>
                                    <span>{{ setting('store_phone') }}</span>
                                </li>
                            @endif

                            @if(! setting('store_email_hide'))
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

                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512.000000 512.000000"
                            preserveAspectRatio="xMidYMid meet">
                            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                            fill="#ffffff" stroke="none">
                                <path d="M2521 5003 c-7 -3 -118 -81 -245 -174 l-231 -169 -457 0 c-266 0
                                -467 -4 -482 -10 -14 -5 -33 -21 -43 -37 -16 -24 -19 -61 -23 -357 l-5 -330
                                -410 -297 c-226 -164 -420 -310 -432 -324 l-23 -26 0 -1551 0 -1550 34 -34 34
                                -34 2311 0 c1724 0 2316 3 2335 12 14 6 34 23 43 37 17 25 18 114 21 1568 l2
                                1543 -34 37 c-19 21 -214 169 -435 328 l-400 290 -1 327 c0 213 -4 335 -11
                                351 -26 57 -26 57 -528 57 l-461 0 -224 164 c-123 91 -233 169 -245 175 -21
                                11 -66 13 -90 4z m123 -283 l79 -60 -163 0 c-101 0 -160 4 -154 9 16 16 148
                                111 154 111 3 0 41 -27 84 -60z m1226 -1164 l0 -883 -650 -474 c-358 -261
                                -654 -475 -658 -477 -4 -1 -300 211 -657 471 l-650 474 -3 886 -2 887 1310 0
                                1310 0 0 -884z m-2834 -723 c-4 -5 -570 405 -573 415 -1 4 127 100 285 215
                                l287 207 3 -416 c1 -230 0 -419 -2 -421z m3597 427 c18 -16 7 -26 -254 -216
                                -150 -109 -278 -203 -286 -207 -11 -7 -13 63 -13 412 l0 421 268 -197 c147
                                -107 275 -203 285 -213z m-3208 -974 c352 -258 644 -471 648 -475 6 -6 -1630
                                -1335 -1679 -1364 -12 -7 -14 201 -14 1297 l0 1306 203 -149 c111 -81 490
                                -358 842 -615z m3313 -1189 l-3 -655 -850 682 -851 681 851 622 850 621 3
                                -648 c1 -357 1 -943 0 -1303z m-2349 483 c67 -49 131 -92 142 -95 37 -12 71 5
                                196 96 68 50 127 89 132 87 4 -2 385 -304 845 -673 l837 -670 -990 -3 c-545
                                -1 -1436 -1 -1979 0 l-989 3 836 673 c459 369 838 672 841 672 4 0 61 -40 129
                                -90z"/>
                                <path d="M1860 3835 l0 -105 705 0 705 0 0 105 0 105 -705 0 -705 0 0 -105z"/>
                                <path d="M1860 3205 l0 -105 705 0 705 0 0 105 0 105 -705 0 -705 0 0 -105z"/>
                                <path d="M1860 2565 l0 -105 705 0 705 0 0 105 0 105 -705 0 -705 0 0 -105z"/>
                            </g>
                        </svg>
                    </div>

                    <div class="contact-form-right">
                        <h3 class="title">{{ trans('storefront::contact.leave_a_message') }}</h3>

                        <div class="contact-form">
                            <form method="POST" action="{{ route('contact.store') }}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="email">
                                                {{ trans('contact::attributes.email') }}<span>*</span>
                                            </label>

                                            <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control">

                                            @error('email')
                                                <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="subject">
                                                {{ trans('contact::attributes.subject') }}<span>*</span>
                                            </label>

                                            <input type="text" name="subject" value="{{ old('subject') }}" id="subject" class="form-control">

                                            @error('subject')
                                                <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-18">
                                        <div class="form-group">
                                            <label for="message">
                                                {{ trans('contact::attributes.message') }}<span>*</span>
                                            </label>

                                            <textarea rows="5" name="message" id="message" class="form-control">{{ old('message') }}</textarea>

                                            @error('message')
                                                <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-18">
                                        <div class="form-group p-t-5">
                                            @captcha
                                            <input type="text" name="captcha" class="captcha-input" placeholder="{{ trans('storefront::layout.enter_captcha_code') }}">

                                            @error('captcha')
                                                <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-18">
                                        <button type="submit" class="btn btn-lg btn-primary" data-loading>
                                            {{ trans('storefront::contact.send_message') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
