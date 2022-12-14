<?php

namespace Themes\Storefront\Http\Controllers;

use Modules\FlashSale\Entities\FlashSale;

class FlashSaleProductController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FlashSale::active()->products->map->clean();
    }
}
