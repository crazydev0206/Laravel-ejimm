<ul class="list-inline sidebar-menu">
    @foreach ($menu->menus() as $menu)
        <li class="{{ $menu->hasSubMenus() ? 'dropdown multi-level' : '' }}">
            <a href="{{ $menu->url() }}" class="menu-item" target="{{ $menu->target() }}">
                @if ($type === 'category_menu' && $menu->hasIcon())
                    <span class="menu-item-icon">
                        <i class="{{ $menu->icon() }}"></i>
                    </span>
                @endif

                {{ $menu->name() }}
            </a>

            @if ($menu->hasSubMenus())
                @include('public.layout.sidebar_menu.dropdown', ['subMenus' => $menu->subMenus()])
            @endif
        </li>
    @endforeach

    @if ($type === 'category_menu')
        <li class="more-categories">
            <a href="{{ route('categories.index') }}" class="menu-item">
                <span class="menu-item-icon">
                    <i class="las la-plus-square"></i>
                </span>

                {{ trans('storefront::layout.all_categories') }}
            </a>
        </li>
    @endif
</ul>
