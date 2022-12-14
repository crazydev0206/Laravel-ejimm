<?php

namespace Themes\Storefront\Http\Requests;

use Modules\Core\Http\Requests\Request;

class SaveStorefrontRequest extends Request
{
    /**
     * Array of attributes that should be merged with null
     * if attribute is not found in the current request.
     *
     * @var array
     */
    private $shouldCheck = [
        'storefront_footer_tags',
        'storefront_featured_categories_section_category_1_products',
        'storefront_featured_categories_section_category_2_products',
        'storefront_featured_categories_section_category_3_products',
        'storefront_featured_categories_section_category_4_products',
        'storefront_featured_categories_section_category_5_products',
        'storefront_featured_categories_section_category_6_products',
        'storefront_product_tabs_1_section_tab_1_products',
        'storefront_product_tabs_1_section_tab_2_products',
        'storefront_product_tabs_1_section_tab_3_products',
        'storefront_product_tabs_1_section_tab_4_products',
        'storefront_top_brands',
        'storefront_vertical_products_1_products',
        'storefront_vertical_products_2_products',
        'storefront_vertical_products_3_products',
        'storefront_product_grid_section_tab_1_products',
        'storefront_product_grid_section_tab_2_products',
        'storefront_product_grid_section_tab_3_products',
        'storefront_product_grid_section_tab_4_products',
        'storefront_product_tabs_2_section_tab_1_products',
        'storefront_product_tabs_2_section_tab_2_products',
        'storefront_product_tabs_2_section_tab_3_products',
        'storefront_product_tabs_2_section_tab_4_products',
    ];

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        foreach ($this->shouldCheck as $attribute) {
            if (! $this->has($attribute)) {
                $this->merge([$attribute => null]);
            }
        }

        return $this->all();
    }
}
