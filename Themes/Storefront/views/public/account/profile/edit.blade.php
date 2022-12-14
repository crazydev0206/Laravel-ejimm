@extends('public.account.layout')

@section('title', trans('storefront::account.pages.my_profile'))

@section('account_breadcrumb')
    <li class="active">{{ trans('storefront::account.pages.my_profile') }}</li>
@endsection

@section('panel')
    <div class="panel">
        <div class="panel-header">
            <h4>{{ trans('storefront::account.pages.my_profile') }}</h4>
        </div>

        <div class="panel-body">
            <div class="my-profile">
                <form method="POST" action="{{ route('account.profile.update') }}">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="email">
                                    {{ trans('storefront::account.profile.email') }}<span>*</span>
                                </label>

                                <input type="text" name="email" value="{{ old('email', $account->email) }}" id="email" class="form-control">

                                @error('email')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="phone">
                                    {{ trans('storefront::account.profile.phone') }}<span>*</span>
                                </label>

                                <input type="text" name="phone" value="{{ old('phone', $account->phone) }}" id="phone" class="form-control">

                                @error('phone')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="first-name">
                                    {{ trans('storefront::account.profile.first_name') }}<span>*</span>
                                </label>

                                <input type="text" name="first_name" value="{{ old('first_name', $account->first_name) }}" id="first-name" class="form-control">

                                @error('first_name')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="last-name">
                                    {{ trans('storefront::account.profile.last_name') }}<span>*</span>
                                </label>

                                <input type="text" name="last_name" value="{{ old('last_name', $account->last_name) }}" id="last-name" class="form-control">

                                @error('last_name')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="password">
                                    {{ trans('storefront::account.profile.password') }}
                                </label>

                                <input type="password" name="password" id="password" class="form-control">

                                @error('password')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="confirm-password">
                                    {{ trans('storefront::account.profile.confirm_password') }}
                                </label>

                                <input type="password" name="password_confirmation" id="confirm-password" class="form-control">

                                @error('password_confirmation')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-lg btn-primary btn-save-changes" data-loading>
                        {{ trans('storefront::account.profile.save_changes') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
