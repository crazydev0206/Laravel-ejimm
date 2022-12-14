<?php

namespace Themes\Storefront\Http\ViewComposers;

use Mexitek\PHPColors\Color;
use Modules\Compare\Compare;
use Spatie\SchemaOrg\Schema;
use Modules\Tag\Entities\Tag;
use Modules\Cart\Facades\Cart;
use Modules\Menu\Entities\Menu;
use Modules\Page\Entities\Page;
use Modules\Media\Entities\File;
use Modules\Menu\MegaMenu\MegaMenu;
use Illuminate\Support\Facades\Cache;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\SearchTerm;

class LayoutComposer
{
    /**
     * @var \Modules\Compare\Compare
     */
    private $compare;

    /**
     * Create a new view composer instance.
     *
     * @param \Modules\Compare\Compare $compare
     */
    public function __construct(Compare $compare)
    {
        $this->compare = $compare;
    }

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose($view)
    {
        $view->with([
            'themeColor' => $this->getThemeColor(),
            'compareCount' => $this->compare->count(),
            'favicon' => $this->getFavicon(),
            'logo' => $this->getHeaderLogo(),
            'newsletterBgImage' => $this->getNewsletterBgImage(),
            'privacyPageUrl' => $this->getPrivacyPageUrl(),
            'categories' => $this->getCategories(),
            'mostSearchedKeywords' => $this->getMostSearchedKeywords(),
            // 'primaryMenu' => $this->getPrimaryMenu(),
            // 'categoryMenu' => $this->getCategoryMenu(),
            'cart' => $this->getCart(),
            'wishlist' => $this->getWishlist(),
            'compareList' => $this->compare->list(),
            'footerMenuOne' => $this->getFooterMenuOne(),
            'footerMenuTwo' => $this->getFooterMenuTwo(),
            'footerTags' => $this->getFooterTags(),
            'copyrightText' => $this->getCopyrightText(),
            'acceptedPaymentMethodsImage' => $this->getAcceptedPaymentMethodsImage(),
            'schemaMarkup' => $this->getSchemaMarkup(),
        ]);
    }

    private function getThemeColor()
    {
        try {
            return new Color(storefront_theme_color());
        } catch (\Exception $e) {
            return new Color('#0068e1');
        }
    }

    private function getFavicon()
    {
        return $this->getMedia(setting('storefront_favicon'))->path;
    }

    private function getHeaderLogo()
    {
        return $this->getMedia(setting('storefront_header_logo'))->path;
    }

    private function getNewsletterBgImage()
    {
        return $this->getMedia(setting('storefront_newsletter_bg_image'))->path;
    }

    private function getMedia($fileId)
    {
        return Cache::rememberForever(md5("files.{$fileId}"), function () use ($fileId) {
            return File::findOrNew($fileId);
        });
    }

    private function getPrivacyPageUrl()
    {
        return Cache::tags('settings')->rememberForever('privacy_page_url', function () {
            return Page::urlForPage(setting('storefront_privacy_page'));
        });
    }

    private function getCategories()
    {
        return Category::searchable();
    }

    private function getMostSearchedKeywords()
    {
        return Cache::remember('most_searched_keywords', now()->addHour(), function () {
            return SearchTerm::select('term')->orderByDesc('hits')->take(5)->pluck('term');
        });
    }

    private function getPrimaryMenu()
    {
        return new MegaMenu(setting('storefront_primary_menu'));
    }

    private function getCategoryMenu()
    {
        return new MegaMenu(setting('storefront_category_menu'));
    }

    private function getCart()
    {
        return Cart::instance();
    }

    private function getWishlist()
    {
        if (auth()->guest()) {
            return collect();
        }

        return auth()->user()->wishlist()->pluck('product_id');
    }

    private function getFooterMenuOne()
    {
        return $this->getFooterMenu(setting('storefront_footer_menu_one'));
    }

    private function getFooterMenuTwo()
    {
        return $this->getFooterMenu(setting('storefront_footer_menu_two'));
    }

    private function getFooterMenu($menuId)
    {
        return Cache::tags(['menu_items', 'categories', 'pages', 'settings'])
            ->rememberForever(md5("storefront_footer_menu.{$menuId}:" . locale()), function () use ($menuId) {
                return Menu::for($menuId);
            });
    }

    private function getFooterTags()
    {
        $tagIds = setting('storefront_footer_tags', []);

        return Cache::tags(['tags', 'settings'])
            ->rememberForever(
                md5('storefront_footer_tags:' . serialize($tagIds) . ':' . locale()),
                $this->footerTagsCallback($tagIds)
            );
    }

    public function footerTagsCallback($tagIds)
    {
        return function () use ($tagIds) {
            return Tag::whereIn('id', $tagIds)
                ->when(! empty($tagIds), function ($query) use ($tagIds) {
                    $tagIdsString = collect($tagIds)->filter()->implode(',');

                    $query->orderByRaw("FIELD(id, {$tagIdsString})");
                })
                ->get();
        };
    }

    private function getCopyrightText()
    {
        return strtr(setting('storefront_copyright_text'), [
            '{{ store_url }}' => route('home'),
            '{{ store_name }}' => setting('store_name'),
            '{{ year }}' => date('Y'),
        ]);
    }

    private function getAcceptedPaymentMethodsImage()
    {
        return $this->getMedia(setting('storefront_accepted_payment_methods_image'));
    }

    private function getSchemaMarkup()
    {
        return Schema::webSite()
            ->url(route('home'))
            ->potentialAction($this->searchActionSchema());
    }

    private function searchActionSchema()
    {
        return Schema::searchAction()
            ->target(route('products.index') . '?query={search_term_string}')
            ->setProperty('query-input', 'required name=search_term_string');
    }
}
