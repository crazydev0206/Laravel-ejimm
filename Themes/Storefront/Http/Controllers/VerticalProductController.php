<?php

namespace Themes\Storefront\Http\Controllers;

class VerticalProductController extends ProductIndexController
{
    /**
     * Display a listing of the resource.
     *
     * @param int $columnNumber
     * @return \Illuminate\Http\Response
     */
    public function index($columnNumber)
    {
        return $this->getProducts("storefront_vertical_products_{$columnNumber}");
    }
}
