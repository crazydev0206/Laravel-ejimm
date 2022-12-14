<?php

namespace Themes\Storefront\Http\Controllers;

class ProductGridController extends ProductIndexController
{
    /**
     * Display a listing of the resource.
     *
     * @param int $tabNumber
     * @return \Illuminate\Http\Response
     */
    public function index($tabNumber)
    {
        return $this->getProducts("storefront_product_grid_section_tab_{$tabNumber}");
    }
}
