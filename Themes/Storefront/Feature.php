<?php

namespace Themes\Storefront;

use Illuminate\Support\Collection;

class Feature
{
    public $icon;
    public $title;
    public $subtitle;

    public function __construct($icon, $title, $subtitle)
    {
        $this->icon = $icon;
        $this->title = $title;
        $this->subtitle = $subtitle;
    }

    public static function all()
    {
        if (! setting('storefront_features_section_enabled')) {
            return collect();
        }

        return Collection::times(5, function ($number) {
            return self::getFeatureFor($number);
        });
    }

    private static function getFeatureFor($number)
    {
        return new self(
            setting("storefront_feature_{$number}_icon"),
            setting("storefront_feature_{$number}_title"),
            setting("storefront_feature_{$number}_subtitle")
        );
    }
}
