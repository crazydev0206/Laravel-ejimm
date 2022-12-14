<?php

namespace Themes\Storefront\Http\ViewComposers;

use Illuminate\View\View;
use Spatie\SchemaOrg\Schema;
use Themes\Storefront\Banner;
use Themes\Storefront\Feature;
use Illuminate\Support\Collection;
use Modules\Product\Entities\Product;
use Spatie\SchemaOrg\ItemAvailability;

class ProductShowPageComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $product = $view->getData()['product'];

        $view->with([
            'features' => Feature::all(),
            'banner' => Banner::getProductPageBanner(),
            'productSchemaMarkup' => $this->schemaMarkup($product),
            'categoryBreadcrumb' => $this->getCategoryBreadCrumb($product->categories->nest()),
        ]);
    }

    private function schemaMarkup(Product $product)
    {
        return Schema::product()
            ->name($product->name)
            ->sku($product->sku)
            ->url($product->url())
            ->image($product->base_image->path)
            ->brand($this->brandSchema($product))
            ->description($product->short_description)
            ->aggregateRating($this->aggregateRatingSchema($product))
            ->offers($this->offersSchema($product));
    }

    private function brandSchema(Product $product)
    {
        return Schema::brand()->name($product->brand->name);
    }

    private function aggregateRatingSchema(Product $product)
    {
        return Schema::aggregateRating()
            ->ratingValue($product->reviews()->avg('rating'))
            ->ratingCount($product->reviews()->count());
    }

    private function offersSchema(Product $product)
    {
        return Schema::offer()
            ->price($product->selling_price->convertToCurrentCurrency()->amount())
            ->priceCurrency(currency())
            ->availability($product->isInStock() ? ItemAvailability::InStock : ItemAvailability::OutOfStock)
            ->url($product->url());
    }

    private function getCategoryBreadCrumb(Collection $categories)
    {
        $breadcrumb = '';

        foreach ($categories as $category) {
            $breadcrumb .= "<li><a href='{$category->url()}'>{$category->name}</a></li>";

            if ($category->items->isNotEmpty()) {
                $breadcrumb .= $this->getCategoryBreadCrumb($category->items);
            }
        }

        return $breadcrumb;
    }
}
