<!--<div class="category-nav {{ request()->routeIs('home') ? 'show' : '' }}">
    <div class="category-nav-inner">
        {{ trans('storefront::layout.all_categories_header') }}
        <i class="las la-bars"></i>
    </div>

    @if ($categoryMenu->menus()->isNotEmpty())
        <div class="category-dropdown-wrap">
            <div class="category-dropdown">
                <ul class="list-inline mega-menu vertical-megamenu">
                    @foreach ($categoryMenu->menus() as $menu)
                        @include('public.layout.navigation.menu', ['type' => 'category_menu'])
                    @endforeach

                    <li class="more-categories">
                        <a href="{{ route('categories.index') }}" class="menu-item">
                            <span class="menu-item-icon">
                                <i class="las la-plus-square"></i>
                            </span>

                            {{ trans('storefront::layout.all_categories') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    @endif
</div>-->
