@extends('public.layout')

@section('title', trans('user::auth.reset_password'))

@section('content')
    <section class="form-wrap register-wrap">
        <div class="container">
            <div class="form-wrap-inner register-wrap-inner">
                <h2>{{ trans('user::auth.reset_password') }}</h2>

                <form method="POST" action="{{ route('reset.complete.post', [$user->email, $code]) }}">
                    @csrf

                    <div class="form-group">
                        <label for="new-password">
                            {{ trans('user::attributes.users.new_password') }}<span>*</span>
                        </label>

                        <input type="password" name="new_password" class="form-control" id="new-password">

                        @error('new_password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="confirm-new-password">
                            {{ trans('user::attributes.users.confirm_new_password') }}<span>*</span>
                        </label>

                        <input type="password" name="new_password_confirmation" class="form-control" id="confirm-new-password">

                        @error('new_password_confirmation')
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
