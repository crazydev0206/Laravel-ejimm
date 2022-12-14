@hasSection('breadcrumb')
    <div class="container">
        <div class="breadcrumb">
            <ul class="list-inline">
                <li>
                    <a href="{{ route('home') }}">{{ trans('storefront::layout.home') }}</a>
                </li>

                @yield('breadcrumb')
            </ul>
        </div>
    </div>
@endif
