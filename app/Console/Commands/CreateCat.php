<?php

namespace FleetCart\Console\Commands;

use Modules\Category\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Attribute\Entities\Attribute;
use Modules\Attribute\Entities\AttributeSet;
use Modules\Attribute\Entities\AttributeTranslation;
use Illuminate\Console\Command;
use Modules\Category\Entities\CategoryTranslation;
use FleetCart\Helpers\InternetBikes;
use Modules\Attribute\Entities\ProductAttribute;
use Modules\Attribute\Entities\ProductAttributeValue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File as FileExt;
use Modules\Media\Entities\File;
use Modules\Brand\Entities\Brand;


class CreateCat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:cat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $lastRunId = 1;
        if (file_exists($file = public_path('portal/portal-internet.txt')))
            $lastRunId = file_get_contents($file);
        $responseJson = InternetBikes::getProducts($lastRunId);
        if (empty($responseJson)) {
            $this->info('No Records Found');
            return 0;
        }
        $response = json_decode($responseJson, true);
        if (empty($response['data'])) {
			if (isset($response['data'])) file_put_contents($file, 1);
            $this->info('No Records Found');
            return 0;
        }
        file_put_contents($file, trim($lastRunId) + 1);
        $i = 1;
        foreach ($response['data'] as $responseKey => $responseValue) {
            $date = date('Y-m-d H:i:s');
            echo "Processing : {$i}\n";
            echo "Time : {$date}\n";
            $product = Product::where('sku', $responseValue['ean'])->first();
            $images = $attributes = $allCategories = $categories = $oneCategories = $subCategories = [];
            $isActive = $inStock = $brand = $base = false;
            if (!empty($responseValue['categories'])) {
                $oneCategories = self::getCategories($responseValue['categories'][0]['parent_name_de'], 1);
                $subCategories = self::getCategories($responseValue['categories'][0]['name_de'], $oneCategories[0]);
                $categories = array_merge($categories, array_merge($oneCategories, $subCategories));
            }
            $allCategories = array_unique($categories);
            if (!empty($responseValue['attributes'])) {
                foreach ($responseValue['attributes'] as $attrKey => $attrValue) {
                    $attribute = self::getAttributes($attrValue, $allCategories);
                    $attributes[] = [
                        'attribute_id' => $attribute->id,
                        'values' => [$attribute->attribute_value_id]
                    ];
                }
            }
            if (!empty($responseValue['media'])) {
                foreach ($responseValue['media'] as $mediaKey => $mediaValue) {
                    $file = self::getFile($mediaValue['url']);
                    if (!$base) {
                        $images['base_image'] = $file->id;
                        $base = true;
                    } else {
                        $images['additional_images'][] = $file->id;
                    }
                }
            }
            if (!empty($responseValue['brand'])) $brand = self::getBrand($responseValue['brand']);

            if ($responseValue['stock'] > 0) {
                $inStock = 1;
            }

            $consumer_price = $responseValue['consumer_price'];
            if ($responseValue['shipping_size'] == 'S') {
                $consumer_price = $responseValue['consumer_price'] + 4;
            } elseif ($responseValue['shipping_size'] == 'M') {
                $consumer_price = $responseValue['consumer_price'] + 10; //31%
            } elseif ($responseValue['shipping_size'] == 'L') {
                $consumer_price = $responseValue['consumer_price'] + 15; //32%
            } elseif ($responseValue['shipping_size'] == 'XS') {
                $consumer_price = $responseValue['consumer_price'] + 4;
            } elseif ($responseValue['shipping_size'] == 'XL') {
                $consumer_price = $responseValue['consumer_price'] + 15;
            } elseif ($responseValue['shipping_size'] == 'XXL') {
                $consumer_price = $responseValue['consumer_price'] + 35;
            }

            $productData = [
                'name' => $responseValue['brand'] . ' ' . $responseValue['name_de'],
                'description' => $responseValue['description_de'],
                'is_active' => 1,
                'virtual' => false,
                'tax_class_id' => 1,
                'price' => $consumer_price,
                'manage_stock' => true,
                'qty' => $responseValue['stock'],
                'in_stock' => $inStock,
                'sku' => $responseValue['ean'],
                'brand_id' => $brand,
                'categories' => $allCategories,
                'files' => $images,
                'attributes' => $attributes
            ];
            request()->merge($productData);
            if (empty($product)) {
                $Product = Product::create($productData);
                echo "Product Created With {$responseValue["ean"]}\n";
            } else {
                $Product = $product->update($productData);
                echo "Product Updated With {$responseValue["ean"]}\n";
            }
            $i++;
        }
        logger("CreateCat DONE");
        return 1;
    }

    public function getBrand($brandName)
    {
        $brand = Brand::select('brands.*')
            ->leftJoin('brand_translations', function ($join) {
                $join->on('brands.id', '=', 'brand_translations.brand_id');
            })
            ->where('brand_translations.name', $brandName)
            ->first();
        if (empty($brand)) {
            $brand = Brand::create([
                'name' => $brandName,
                'is_active' => 1
            ]);
        }
        return $brand->id;
    }

    public function getFile($url)
    {
        $productFile = file_get_contents($url);
        $pathInfo = pathinfo($url);
        $uploadUrl = public_path('uploads/' . $pathInfo['basename']);
        file_put_contents($uploadUrl, $productFile);
        $file = new FileExt($uploadUrl);
        $path = Storage::putFile('media', $file);
        return File::create([
            'user_id' => 1,
            'disk' => config('filesystems.default'),
            'filename' => $file->getFilename(),
            'path' => $path,
            'extension' => $file->getExtension() ?? '',
            'mime' => $file->getMimetype(),
            'size' => $file->getSize(),
        ]);
    }

    public function getAttributes($attr, $categories = [])
    {
        $attributes = [];
        $attributes = Attribute::select('attributes.*')
            ->leftJoin('attribute_translations', function ($join) {
                $join->on('attributes.id', '=', 'attribute_translations.attribute_id');
            })
            ->where('attribute_translations.name', $attr['name_de'])
            ->first();
        if (empty($attributes)) {
            $attributes = Attribute::create([
                'name' => $attr['name_de'],
                'attribute_set_id' => 1,
                'is_filterable' => 1
            ]);
        }
        if (!$attributes->categories->isEmpty()) {
            $categories = array_unique(array_merge($categories, $attributes->categories->pluck('id')->toArray()));
        }
        $attributesArray = [];
        $in = false;
        if (!$attributes->values->isEmpty()) {
            foreach ($attributes->values as $key => $attribute) {
                $attrValue = $attribute->translations->first();
                if ($attrValue) {
                    if ($attrValue->value == $attr['value_de']) {
                        $in = true;
                    }
                    $attributesArray[] = ['id' => $attribute->id, 'value' => $attrValue->value];
                }
            }
            if (!$in) {
                $attributesArray[] = ['id' => null, 'value' => $attr['value_de']];
            }
        } else {
            $attributesArray[] = ['id' => null, 'value' => $attr['value_de']];
        }
        $attributes->saveRelations(['categories' => $categories, 'values' => $attributesArray]);
        $attributes = Attribute::select('attributes.*', 'attribute_values.id as attribute_value_id')
            ->leftJoin('attribute_values', function ($join) {
                $join->on('attributes.id', '=', 'attribute_values.attribute_id');
            })
            ->leftJoin('attribute_value_translations', function ($join) {
                $join->on('attribute_values.id', '=', 'attribute_value_translations.attribute_value_id');
            })
            ->where('attributes.id', $attributes->id)
            ->first();
        return $attributes;
    }

    public function getCategories($catName, $parentId = null)
    {
        $categories = [];
        $category = Category::select('categories.*')
            ->leftJoin('category_translations', function ($join) {
                $join->on('categories.id', '=', 'category_translations.category_id');
            })
            ->where('category_translations.name', $catName)
            ->where('parent_id', $parentId)
            ->first();
        if (empty($category)) {
            $category = Category::create([
                'name' => $catName,
                'is_active' => 1,
                'is_searchable' => false,
                'parent_id' => $parentId
            ]);
        }
        $categories[] = $category->id;
        if ($category->parent_id) {
            while (true) {
                if ($category->parent_id == null) break;
                $category = Category::find($category->parent_id);
                if (empty($category)) break;
                $categories[] = $category->id;
            }
        }
        return $categories;
    }
}
