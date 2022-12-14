@extends('public.layout')

@section('title', trans('user::auth.reset_password'))

@section('content')
    <section class="form-wrap register-wrap">
        <div class="container">
            <div class="form-wrap-inner register-wrap-inner">
                <h2>{{ trans('user::auth.reset_password') }}</h2>
                <p>{{ trans('user::auth.enter_email') }}</p>

                <form method="POST" action="{{ route('reset.post') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">{{ trans('user::attributes.users.email') }}<span>*</span></label>
                        <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control" autofocus>

                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-reset-password" data-loading>
                        {{ trans('user::auth.submit') }}
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
