<?php

namespace Themes\Storefront\Http\Controllers;

class TabProductController extends ProductIndexController
{
    /**
     * Display a listing of the resource.
     *
     * @param int $sectionNumber
     * @param int $tabNumber
     * @return \Illuminate\Http\Response
     */
    public function index($sectionNumber, $tabNumber)
    {
        return $this->getProducts("storefront_product_tabs_{$sectionNumber}_section_tab_{$tabNumber}");
    }
}
