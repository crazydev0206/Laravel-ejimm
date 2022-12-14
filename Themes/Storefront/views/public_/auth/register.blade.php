@extends('public.layout')

@section('title', trans('user::auth.register'))

@section('content')
    <section class="form-wrap register-wrap">
        <div class="container">
            <div class="form-wrap-inner register-wrap-inner">
                <h2>{{ trans('user::auth.register') }}</h2>

                <form method="POST" action="{{ route('register.post') }}">
                    @csrf

                    <div class="form-group">
                        <label for="first-name">
                            {{ trans('user::auth.first_name') }}<span>*</span>
                        </label>

                        <input type="text" name="first_name" value="{{ old('first_name') }}" id="first-name" class="form-control">

                        @error('first_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="last-name">
                            {{ trans('user::auth.last_name') }}<span>*</span>
                        </label>

                        <input type="text" name="last_name" value="{{ old('last_name') }}" id="last-name" class="form-control">

                        @error('last_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">
                            {{ trans('user::auth.email') }}<span>*</span>
                        </label>

                        <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control">

                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">
                            {{ trans('user::auth.phone') }}<span>*</span>
                        </label>

                        <input type="text" name="phone" value="{{ old('phone') }}" id="phone" class="form-control">

                        @error('phone')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">
                            {{ trans('user::auth.password') }}<span>*</span>
                        </label>

                        <input type="password" name="password" id="password" class="form-control">

                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">
                            {{ trans('user::auth.confirm_password') }}<span>*</span>
                        </label>

                        <input type="password" name="password_confirmation" id="confirm-password" class="form-control">

                        @error('password_confirmation')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group p-t-5">
                        @captcha
                        <input type="text" name="captcha" id="captcha" class="captcha-input" placeholder="{{ trans('storefront::layout.enter_captcha_code') }}">

                        @error('captcha')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-check terms-and-conditions">
                        <input type="hidden" name="privacy_policy" value="0">
                        <input type="checkbox" name="privacy_policy" value="1" id="terms" {{ old('privacy_policy', false) ? 'checked' : '' }}>

                        <label for="terms" class="form-check-label">
                            {{ trans('user::auth.i_agree_to_the') }} <a href="{{ $privacyPageUrl }}">{{ trans('user::auth.privacy_policy') }}</a>
                        </label>

                        @error('privacy_policy')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-create-account" data-loading>
                        {{ trans('user::auth.create_account') }}
                    </button>
                </form>

                @include('public.auth.partials.social_login')

                <span class="have-an-account">
                    {{ trans('user::auth.already_have_an_account') }}
                </span>

                <a href="{{ route('login') }}" class="btn btn-default btn-sign-in">
                    {{ trans('user::auth.sign_in') }}
                </a>
            </div>
        </div>
    </section>
@endsection
