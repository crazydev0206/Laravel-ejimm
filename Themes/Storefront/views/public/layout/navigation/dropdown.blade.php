@if ($subMenus->isNotEmpty())
    <ul class="list-inline sub-menu">
        @foreach ($subMenus as $subMenu)
            <li class="{{ $subMenu->hasItems() ? 'dropdown' : '' }}">
                <a href="{{ $subMenu->url() }}" target="{{ $subMenu->target() }}">
                    {{ $subMenu->name() }}
                </a>

                @if ($subMenu->hasItems())
                    @include('public.layout.navigation.dropdown', ['subMenus' => $subMenu->items()])
                @endif
            </li>
        @endforeach
    </ul>
@endif
