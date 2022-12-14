<?php

namespace Themes\Storefront;

use Modules\Media\Entities\File;
use Illuminate\Support\Facades\Cache;

class Banner
{
    public $image;
    public $call_to_action_url;
    public $open_in_new_window;

    public function __construct($image, $call_to_action_url, $open_in_new_window)
    {
        $this->image = $image;
        $this->call_to_action_url = $call_to_action_url;
        $this->open_in_new_window = (bool) $open_in_new_window;
    }

    public static function getProductPageBanner()
    {
        return self::findByName('storefront_product_page_banner');
    }

    public static function getSliderBanners()
    {
        return [
            'banner_1' => self::findByName('storefront_slider_banner_1'),
            'banner_2' => self::findByName('storefront_slider_banner_2'),
        ];
    }

    public static function getThreeColumnFullWidthBanners()
    {
        return [
            'background' => self::findByName('storefront_three_column_full_width_banners_background'),
            'banner_1' => self::findByName('storefront_three_column_full_width_banners_1'),
            'banner_2' => self::findByName('storefront_three_column_full_width_banners_2'),
            'banner_3' => self::findByName('storefront_three_column_full_width_banners_3'),
        ];
    }

    public static function getTwoColumnBanners()
    {
        return [
            'banner_1' => self::findByName('storefront_two_column_banners_1'),
            'banner_2' => self::findByName('storefront_two_column_banners_2'),
        ];
    }

    public static function getThreeColumnBanners()
    {
        return [
            'banner_1' => self::findByName('storefront_three_column_banners_1'),
            'banner_2' => self::findByName('storefront_three_column_banners_2'),
            'banner_3' => self::findByName('storefront_three_column_banners_3'),
        ];
    }

    public static function getOneColumnBanner()
    {
        return self::findByName('storefront_one_column_banner');
    }

    public static function findByName($name)
    {
        return Cache::tags('settings')
            ->rememberForever(md5("storefront_banners.{$name}:" . locale()), function () use ($name) {
                return new self(
                    File::findOrNew(setting("{$name}_file_id")),
                    setting("{$name}_call_to_action_url"),
                    setting("{$name}_open_in_new_window")
                );
            });
    }
}
