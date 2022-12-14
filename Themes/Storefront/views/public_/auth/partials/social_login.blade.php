@if (count($providers) !== 0)
    <span class="sign-in-with">
        @if (request()->routeIs('login'))
            {{ trans('user::auth.or_continue_with') }}
        @else
            {{ trans('user::auth.or_sign_up_with') }}
        @endif
    </span>

    <ul class="list-inline social-login">
        @if (setting('facebook_login_enabled'))
            <li>
                <a href="{{ route('login.redirect', ['provider' => 'facebook']) }}" class="facebook" data-toggle="tooltip" data-placement="top" title="{{ trans('user::auth.facebook') }}">
                    <i class="lab la-facebook-f"></i>
                </a>
            </li>
        @endif

        @if (setting('google_login_enabled'))
            <li>
                <a href="{{ route('login.redirect', ['provider' => 'google']) }}" class="google" data-toggle="tooltip" data-placement="top" title="{{ trans('user::auth.google') }}">
                    <i class="lab la-google"></i>
                </a>
            </li>
        @endif
    </ul>
@endif
