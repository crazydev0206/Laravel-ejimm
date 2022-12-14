@extends('public.layout')

@section('title', trans('user::auth.login'))

@section('content')
    <section class="form-wrap login-wrap">
        <div class="container">
            <div class="form-wrap-inner login-wrap-inner">
                <h2>{{ trans('user::auth.login') }}</h2>

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">{{ trans('user::auth.email') }}<span>*</span></label>
                        <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control">

                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ trans('user::auth.password') }}<span>*</span></label>
                        <input type="password" name="password" id="password" class="form-control">

                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-check remember-me">
                        <input type="hidden" name="remember_me" value="0">
                        <input type="checkbox" name="remember_me" value="1" id="remember" {{ old('remember_me', false) ? 'checked' : '' }}>
                        <label for="remember" class="form-check-label">{{ trans('user::auth.remember_me') }}</label>
                    </div>

                    <a href="{{ route('reset') }}" class="forgot-password">
                        {{ trans('user::auth.forgot_password') }}
                    </a>

                    <button type="submit" class="btn btn-primary btn-sign-in" data-loading>
                        {{ trans('user::auth.sign_in') }}
                    </button>
                </form>

                @include('public.auth.partials.social_login')

                <span class="have-an-account">
                    {{ trans('user::auth.dont_have_an_account') }}
                </span>

                <a href="{{ route('register') }}" class="btn btn-default btn-create-account">
                    {{ trans('user::auth.create_account') }}
                </a>
            </div>
        </div>
    </section>
@endsection
