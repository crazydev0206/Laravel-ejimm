<ul class="list-inline">
    @foreach ($subMenus as $subMenu)
        <li class="{{ $subMenu->hasItems() ? 'dropdown sub-menu' : '' }}">
            <a href="{{ $subMenu->url() }}" target="{{ $subMenu->target() }}">
                {{ $subMenu->name() }}
            </a>

            @if ($subMenu->hasItems())
                @include('public.layout.sidebar_menu.dropdown', ['subMenus' => $subMenu->items()])
            @endif
        </li>
    @endforeach
</ul>
