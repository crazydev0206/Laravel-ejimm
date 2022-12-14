<?php

namespace Themes\Storefront\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Modules\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Ui\Facades\TabManager;
use Modules\FlashSale\Entities\FlashSale;
use Themes\Storefront\Admin\StorefrontTabs;
use Themes\Storefront\Http\ViewComposers\LayoutComposer;
use Themes\Storefront\Http\ViewComposers\HomePageComposer;
use Themes\Storefront\Http\ViewComposers\StorefrontTabsComposer;
use Themes\Storefront\Http\ViewComposers\ProductShowPageComposer;
use Themes\Storefront\Http\ViewComposers\ProductIndexPageComposer;

class StorefrontServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! is_null(setting('storefront_active_flash_sale_campaign'))) {
            FlashSale::activeCampaign(setting('storefront_active_flash_sale_campaign'));
        }

        TabManager::register('storefront', StorefrontTabs::class);

        View::composer('public.layout', LayoutComposer::class);
        View::composer('public.home.index', HomePageComposer::class);
        View::composer('public.products.index', ProductIndexPageComposer::class);
        View::composer('public.products.show', ProductShowPageComposer::class);
        View::composer('admin.storefront.tabs.*', StorefrontTabsComposer::class);

        Paginator::defaultView('public.pagination');

        $this->addAdminAssets('admin.storefront.settings.edit', [
            'admin.storefront.css', 'admin.media.css', 'admin.storefront.js', 'admin.media.js',
        ]);
    }
}
