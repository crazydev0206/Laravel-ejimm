<?php

namespace Themes\Storefront\Http\Controllers;

class FeaturedCategoryProductController extends ProductIndexController
{
    /**
     * Display a listing of the resource.
     *
     * @param int $categoryNumber
     * @return \Illuminate\Http\Response
     */
    public function index($categoryNumber)
    {
        return $this->getProducts("storefront_featured_categories_section_category_{$categoryNumber}");
    }
}
