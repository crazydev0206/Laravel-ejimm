<aside class="sidebar-menu-wrap">
    <div class="sidebar-menu-header">
        <h4>{{ trans('storefront::layout.navigation') }}</h4>

        <div class="sidebar-menu-close">
            <i class="las la-times"></i>
        </div>
    </div>

    <ul class="nav nav-tabs sidebar-menu-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#main-menu">
                {{ trans('storefront::layout.menu') }}
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#category-menu">
                {{ trans('storefront::layout.categories') }}
            </a>
        </li>
    </ul>

    <div class="tab-content custom-scrollbar">
        <div id="main-menu" class="tab-pane active">
            @include('public.layout.sidebar_menu.menu', ['type' => 'primary_menu', 'menu' => $primaryMenu])
        </div>

        <div id="category-menu" class="tab-pane">
            @include('public.layout.sidebar_menu.menu', ['type' => 'category_menu', 'menu' => $categoryMenu])
        </div>
    </div>
</aside>
