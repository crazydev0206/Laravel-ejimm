@extends('public.layout')

@section('breadcrumb')
    @if (request()->routeIs('account.dashboard.index'))
        <li class="active">{{ trans('storefront::account.pages.my_account') }}</li>
    @else
        <li><a href="{{ route('account.dashboard.index') }}">{{ trans('storefront::account.pages.my_account') }}</a></li>
    @endif

    @yield('account_breadcrumb')
@endsection

@section('content')
    <section class="account-wrap">
        <div class="container">
            <div class="account-wrap-inner">
                <div class="account-left">
                    <ul class="list-inline account-sidebar">
                        <li class="{{ request()->routeIs('account.dashboard.index') ? 'active' : '' }}">
                            <a href="{{ route('account.dashboard.index') }}">
                                <i class="las la-tachometer-alt"></i>
                                {{ trans('storefront::account.pages.dashboard') }}
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('account.orders.index') ? 'active' : '' }}">
                            <a href="{{ route('account.orders.index') }}">
                                <i class="las la-cart-arrow-down"></i>
                                {{ trans('storefront::account.pages.my_orders') }}
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('account.downloads.index') ? 'active' : '' }}">
                            <a href="{{ route('account.downloads.index') }}">
                                <i class="las la-download"></i>
                                {{ trans('storefront::account.pages.my_downloads') }}
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('account.wishlist.index') ? 'active' : '' }}">
                            <a href="{{ route('account.wishlist.index') }}">
                                <i class="lar la-heart"></i>
                                {{ trans('storefront::account.pages.my_wishlist') }}
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('account.reviews.index') ? 'active' : '' }}">
                            <a href="{{ route('account.reviews.index') }}">
                                <i class="las la-comment"></i>
                                {{ trans('storefront::account.pages.my_reviews') }}
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('account.addresses.index') ? 'active' : '' }}">
                            <a href="{{ route('account.addresses.index') }}">
                                <i class="las la-address-book"></i>
                                {{ trans('storefront::account.pages.my_addresses') }}
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('account.profile.edit') ? 'active' : '' }}">
                            <a href="{{ route('account.profile.edit') }}">
                                <i class="las la-user-circle"></i>
                                {{ trans('storefront::account.pages.my_profile') }}
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('logout') }}">
                                <i class="las la-sign-out-alt"></i>
                                {{ trans('storefront::account.pages.logout') }}
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="account-right">
                    <div class="panel-wrap">
                        @yield('panel')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
