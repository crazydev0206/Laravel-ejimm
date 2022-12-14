<?php

namespace Themes\Storefront\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;
use Modules\Tag\Entities\Tag;
use Themes\Storefront\Banner;
use Modules\Menu\Entities\Menu;
use Modules\Page\Entities\Page;
use Modules\Media\Entities\File;
use Modules\Brand\Entities\Brand;
use Modules\Slider\Entities\Slider;
use Illuminate\Support\Facades\Cache;
use Modules\Product\Entities\Product;
use Modules\FlashSale\Entities\FlashSale;

class StorefrontTabs extends Tabs
{
    /**
     * Make new tabs with groups.
     *
     * @return void
     */
    public function make()
    {
        $this->group('general_settings', trans('storefront::storefront.tabs.group.general_settings'))
            ->active()
            ->add($this->general())
            ->add($this->logo())
            ->add($this->menus())
            ->add($this->footer())
            ->add($this->newsletter())
            ->add($this->features())
            ->add($this->productPage())
            ->add($this->socialLinks());

        $this->group('home_page_sections', trans('storefront::storefront.tabs.group.home_page_sections'))
            ->add($this->sliderBanners())
            ->add($this->threeColumnFullWidthBanners())
            ->add($this->featuredCategories())
            ->add($this->productTabsOne())
            ->add($this->topBrands())
            ->add($this->flashSaleAndVerticalProducts())
            ->add($this->twoColumnBanners())
            ->add($this->productGrid())
            ->add($this->threeColumnBanners())
            ->add($this->productTabsTwo())
            ->add($this->oneColumnBanner());
    }

    private function general()
    {
        return tap(new Tab('general', trans('storefront::storefront.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->fields(['storefront_slider', 'storefront_copyright_text']);
            $tab->view('admin.storefront.tabs.general', [
                'pages' => $this->getPages(),
                'sliders' => $this->getSliders(),
            ]);
        });
    }

    private function getPages()
    {
        return Page::all()->pluck('name', 'id')
            ->prepend(trans('storefront::storefront.form.please_select'), '');
    }

    private function getSliders()
    {
        return Slider::all()->sortBy('name')->pluck('name', 'id')
            ->prepend(trans('storefront::storefront.form.please_select'), '');
    }

    private function logo()
    {
        return tap(new Tab('logo', trans('storefront::storefront.tabs.logo')), function (Tab $tab) {
            $tab->weight(10);
            $tab->view('admin.storefront.tabs.logo', [
                'favicon' => $this->getMedia(setting('storefront_favicon')),
                'headerLogo' => $this->getMedia(setting('storefront_header_logo')),
                'footerLogo' => $this->getMedia(setting('storefront_footer_logo')),
                'mailLogo' => $this->getMedia(setting('storefront_mail_logo')),
            ]);
        });
    }

    private function menus()
    {
        return tap(new Tab('menus', trans('storefront::storefront.tabs.menus')), function (Tab $tab) {
            $tab->weight(15);

            $tab->fields([
                'storefront_primary_menu',
                'storefront_category_menu',
                'storefront_footer_menu',
                'storefront_footer_menu_title',
            ]);

            $tab->view('admin.storefront.tabs.menus', [
                'menus' => $this->getMenus(),
            ]);
        });
    }

    private function getMenus()
    {
        return Menu::all()->pluck('name', 'id')
            ->prepend(trans('storefront::storefront.form.please_select'), '');
    }

    private function footer()
    {
        return tap(new Tab('footer', trans('storefront::storefront.tabs.footer')), function (Tab $tab) {
            $tab->weight(17);
            $tab->view('admin.storefront.tabs.footer', [
                'tags' => Tag::list(),
                'acceptedPaymentMethodsImage' => $this->getMedia(setting('storefront_accepted_payment_methods_image')),
            ]);
        });
    }

    private function newsletter()
    {
        if (! setting('newsletter_enabled')) {
            return;
        }

        return tap(new Tab('newsletter', trans('storefront::storefront.tabs.newsletter')), function (Tab $tab) {
            $tab->weight(18);
            $tab->view('admin.storefront.tabs.newsletter', [
                'newsletterBgImage' => $this->getMedia(setting('storefront_newsletter_bg_image')),
            ]);
        });
    }

    private function getMedia($fileId)
    {
        return Cache::rememberForever(md5("files.{$fileId}"), function () use ($fileId) {
            return File::findOrNew($fileId);
        });
    }

    private function features()
    {
        return tap(new Tab('features', trans('storefront::storefront.tabs.features')), function (Tab $tab) {
            $tab->weight(20);
            $tab->view('admin.storefront.tabs.features');
        });
    }

    private function productPage()
    {
        return tap(new Tab('product_page', trans('storefront::storefront.tabs.product_page')), function (Tab $tab) {
            $tab->weight(22);
            $tab->view('admin.storefront.tabs.product_page', [
                'banner' => Banner::getProductPageBanner(),
            ]);
        });
    }

    private function socialLinks()
    {
        return tap(new Tab('social_links', trans('storefront::storefront.tabs.social_links')), function (Tab $tab) {
            $tab->weight(25);

            $tab->fields([
                'storefront_fb_link',
                'storefront_twitter_link',
                'storefront_instagram_link',
                'storefront_linkedin_link',
                'storefront_pinterest_link',
                'storefront_gplus_link',
                'storefront_youtube_link',
            ]);

            $tab->view('admin.storefront.tabs.social_links');
        });
    }

    private function sliderBanners()
    {
        return tap(new Tab('slider_banners', trans('storefront::storefront.tabs.slider_banners')), function (Tab $tab) {
            $tab->weight(30);
            $tab->view('admin.storefront.tabs.slider_banners', [
                'banners' => Banner::getSliderBanners(),
            ]);
        });
    }

    private function threeColumnFullWidthBanners()
    {
        return tap(new Tab('three_column_full_width_banners', trans('storefront::storefront.tabs.three_column_full_width_banners')), function (Tab $tab) {
            $tab->weight(35);
            $tab->view('admin.storefront.tabs.three_column_full_width_banners', [
                'banners' => Banner::getThreeColumnFullWidthBanners(),
            ]);
        });
    }

    private function featuredCategories()
    {
        return tap(new Tab('featured_categories', trans('storefront::storefront.tabs.featured_categories')), function (Tab $tab) {
            $tab->weight(40);
            $tab->view('admin.storefront.tabs.featured_categories', [
                'categoryOneProducts' => $this->getProductListFromSetting('storefront_featured_categories_section_category_1_products'),
                'categoryTwoProducts' => $this->getProductListFromSetting('storefront_featured_categories_section_category_2_products'),
                'categoryThreeProducts' => $this->getProductListFromSetting('storefront_featured_categories_section_category_3_products'),
                'categoryFourProducts' => $this->getProductListFromSetting('storefront_featured_categories_section_category_4_products'),
                'categoryFiveProducts' => $this->getProductListFromSetting('storefront_featured_categories_section_category_5_products'),
                'categorySixProducts' => $this->getProductListFromSetting('storefront_featured_categories_section_category_6_products'),
            ]);
        });
    }

    private function productTabsOne()
    {
        return tap(new Tab('product_tabs_one', trans('storefront::storefront.tabs.product_tabs_one')), function (Tab $tab) {
            $tab->weight(45);
            $tab->view('admin.storefront.tabs.product_tabs_one', [
                'tabOneProducts' => $this->getProductListFromSetting('storefront_product_tabs_1_section_tab_1_products'),
                'tabTwoProducts' => $this->getProductListFromSetting('storefront_product_tabs_1_section_tab_2_products'),
                'tabThreeProducts' => $this->getProductListFromSetting('storefront_product_tabs_1_section_tab_3_products'),
                'tabFourProducts' => $this->getProductListFromSetting('storefront_product_tabs_1_section_tab_4_products'),
            ]);
        });
    }

    private function topBrands()
    {
        if (! auth()->user()->hasAccess(['admin.brands.index'])) {
            return;
        }

        return tap(new Tab('top_brands', trans('storefront::storefront.tabs.top_brands')), function (Tab $tab) {
            $tab->weight(50);
            $tab->view('admin.storefront.tabs.top_brands', [
                'brands' => Brand::list(),
            ]);
        });
    }

    private function flashSaleAndVerticalProducts()
    {
        return tap(new Tab('flash_sale_and_vertical_products', trans('storefront::storefront.tabs.flash_sale_and_vertical_products')), function (Tab $tab) {
            $tab->weight(60);
            $tab->view('admin.storefront.tabs.flash_sale_and_vertical_products', [
                'flashSales' => $this->getFlashSales(),
                'verticalProductsOne' => $this->getProductListFromSetting('storefront_vertical_products_1_products'),
                'verticalProductsTwo' => $this->getProductListFromSetting('storefront_vertical_products_2_products'),
                'verticalProductsThree' => $this->getProductListFromSetting('storefront_vertical_products_3_products'),
            ]);
        });
    }

    private function getFlashSales()
    {
        return FlashSale::all()->pluck('campaign_name', 'id')
            ->prepend(trans('admin::admin.form.please_select'), '');
    }

    private function twoColumnBanners()
    {
        return tap(new Tab('two_column_banners', trans('storefront::storefront.tabs.two_column_banners')), function (Tab $tab) {
            $tab->weight(65);
            $tab->view('admin.storefront.tabs.two_column_banners', [
                'banners' => Banner::getTwoColumnBanners(),
            ]);
        });
    }

    private function productGrid()
    {
        return tap(new Tab('product_grid', trans('storefront::storefront.tabs.product_grid')), function (Tab $tab) {
            $tab->weight(70);
            $tab->view('admin.storefront.tabs.product_grid', [
                'tabOneProducts' => $this->getProductListFromSetting('storefront_product_grid_section_tab_1_products'),
                'tabTwoProducts' => $this->getProductListFromSetting('storefront_product_grid_section_tab_2_products'),
                'tabThreeProducts' => $this->getProductListFromSetting('storefront_product_grid_section_tab_3_products'),
                'tabFourProducts' => $this->getProductListFromSetting('storefront_product_grid_section_tab_4_products'),
            ]);
        });
    }

    private function threeColumnBanners()
    {
        return tap(new Tab('three_column_banners', trans('storefront::storefront.tabs.three_column_banners')), function (Tab $tab) {
            $tab->weight(75);
            $tab->view('admin.storefront.tabs.three_column_banners', [
                'banners' => Banner::getThreeColumnBanners(),
            ]);
        });
    }

    private function productTabsTwo()
    {
        return tap(new Tab('product_tabs_two', trans('storefront::storefront.tabs.product_tabs_two')), function (Tab $tab) {
            $tab->weight(80);
            $tab->view('admin.storefront.tabs.product_tabs_two', [
                'tabOneProducts' => $this->getProductListFromSetting('storefront_product_tabs_2_section_tab_1_products'),
                'tabTwoProducts' => $this->getProductListFromSetting('storefront_product_tabs_2_section_tab_2_products'),
                'tabThreeProducts' => $this->getProductListFromSetting('storefront_product_tabs_2_section_tab_3_products'),
                'tabFourProducts' => $this->getProductListFromSetting('storefront_product_tabs_2_section_tab_4_products'),
            ]);
        });
    }

    private function oneColumnBanner()
    {
        return tap(new Tab('one_column_banner', trans('storefront::storefront.tabs.one_column_banner')), function (Tab $tab) {
            $tab->weight(85);
            $tab->view('admin.storefront.tabs.one_column_banner', [
                'banner' => Banner::getOneColumnBanner(),
            ]);
        });
    }

    private function getProductListFromSetting($key)
    {
        return Product::list(setting($key, []));
    }
}
