<?php

namespace Themes\Storefront\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Themes\Storefront\Http\ViewComposers\LayoutComposer;
use Illuminate\Support\Facades\DB;

class StoreMenuController
{
    /**
     * Display a listing of the menu.
     *
     * @param int $tabNumber
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::select("
                SELECT ct.category_id, ct.name, c.slug 
                FROM menu_items m, categories c, category_translations ct 
                WHERE m.category_id=ct.category_id AND ct.category_id=c.id AND ct.locale='de'
            ");
        foreach ($categories as $category) {
            $items = DB::select("SELECT c.slug, ct.name FROM categories c, category_translations ct WHERE c.parent_id=".$category->category_id." AND ct.category_id=c.id");
            $category->items = $items;
        }
        return $categories;
    }
}
