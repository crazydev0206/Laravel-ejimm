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
use Illuminate\Http\File AS FileExt;
use Modules\Media\Entities\File;
use Modules\Brand\Entities\Brand;
use Illuminate\Support\Facades\Log;


class ProductCreateWithMisioo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:create:with:misioo';

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
        $responseJson = self::getProducts();
    }

    public function getProducts()
    {
        Log::info('Showing productCreatemisioo');
        $productsFile = public_path('csv-products/Misioo.csv');
        if (($handle = fopen($productsFile, "r")) !== FALSE) {
            $header = $data = fgetcsv($handle, ",");
            $i = 1;
            while (($data = fgetcsv($handle, ",")) !== FALSE) {
                $this->info("Processing : {$i}");
                $result = array_combine($header,$data);
                self::saveProduct($result);
                $i++;
            }
            fclose($handle);
        }
    }

    public function getImagesAndVideos($data)
    {
        $media = [];
        foreach ($data as $key => $value) {
    
            if (!stristr($key,'image') && !stristr($key,'video')) continue;
    
            if (empty($value)) continue;
    
            $media[] = $value;
        }
        return $media;
    }

    public function getAttributesWithCsv($productData)
    {
        $attributes = [];
        if (isset($productData) && !empty($productData)) {
            foreach ($productData as $key => $value) {
                if (!in_array($key,['sku','name','brand','ean','price','consumer_price','category','subcategory','description_flat','image_1','image_2','image_3','image_4','image_5','image_6','video','shipping_size','stock','product_group','product_family','size_family','related_products']) && !empty($value)) {
                    $attributes[] = ['name_de'=>$key,'value_de'=>$value];
                }   
            }
        }
        return $attributes;
    }

    public function saveProduct($productData)
    {
        $date = date('Y-m-d H:i:s');
        $this->info("Time : {$date}");
        $product = Product::where('sku',$productData['ean'])->first();
        $images = $images = $attributes = $allCategories = $categories = $oneCategories = $subCategories = [];
        $isActive = $inStock = $brand = $base = false;
        if (isset($productData['category']) && !empty($productData['category'])) {
            $oneCategories = self::getCategories($productData['category'],909);
        }
        if (isset($productData['subcategory']) && !empty($productData['subcategory'])) {
            if (isset($oneCategories) && !empty($oneCategories)) {
                $subCategories = self::getCategories($productData['subcategory'],$oneCategories[0]);
            }else{
                $subCategories = self::getCategories($productData['subcategory'],909);
            }
        }
        $categories = array_merge($categories,array_merge($oneCategories,$subCategories));
        $allCategories = array_unique($categories);
        $media = self::getImagesAndVideos($productData);
        if (isset($media) && !empty($media)) {
            foreach ($media as $mediaKey => $mediaValue) {
                $file = self::getFile($mediaValue);
                if (isset($file->id) && !empty($file->id)) {
                    if (!$base) {
                        $images['base_image'] = $file->id;
                        $base = true;
                    }else {
                        $images['additional_images'][] = $file->id;
                    }
                }
            }
        }
        $attributeArray = self::getAttributesWithCsv($productData);
        if (isset($attributeArray) && !empty($attributeArray)) {
            foreach ($attributeArray as $attrKey => $attrValue) {
                $attribute = self::getAttributes($attrValue,$allCategories);
                $attributes[] = ['attribute_id'=>$attribute->id,'values'=>[$attribute->attribute_value_id]];
            }
        }
        if (isset($productData['brand']) && !empty($productData['brand'])) $brand = self::getBrand($productData['brand']);

        if ($productData['stock'] > 0) {
            $inStock = 1;
        }

            $consumer_price = $productData['consumer_price'];
        if ($productData['shipping_size'] == 'S') {
            $consumer_price = $productData['consumer_price'] + 4;
        } elseif ($productData['shipping_size'] == 'M') {
            $consumer_price = $productData['consumer_price'] + 10; //31%
        } elseif ($productData['shipping_size'] == 'L') {
            $consumer_price = $productData['consumer_price'] + 15; //32%
        } elseif ($productData['shipping_size'] == 'XS') {
            $consumer_price = $productData['consumer_price'] + 4;
        } elseif ($productData['shipping_size'] == 'XL') {
            $consumer_price = $productData['consumer_price'] + 15;
        } elseif ($productData['shipping_size'] == 'XXL') {
            $consumer_price = $productData['consumer_price'] + 35;
        }

        $productDataForSave = [
            'name'=>$productData['brand']. ' ' .$productData['name'],
            'description'=>$productData['description_flat'],
            'is_active'=>1,
            'virtual'=>false,
            'tax_class_id' => 1,
            'price'=>$consumer_price,
            'manage_stock'=>true,
            'supplier_product_id'=>$productData['sku'],
            'qty' =>$productData['stock'], 
            'in_stock'=>$inStock,
            'sku'=>$productData['ean'],
            'brand_id'=>$brand,
            'categories' => $allCategories,
            'files' => $images,
            'attributes' => $attributes
        ];
        request()->merge($productDataForSave);
        if (!isset($product) || empty($product))
        {
            $Product =  Product::create($productDataForSave);
            echo "Product Created With {$productData["ean"]}\n";
        }else {
            $Product =  $product->update($productDataForSave);
            echo "Product Updated With {$productData["ean"]}\n";
        }
        if (isset($Product->id) && !empty($Product->id)) {
            echo "Product Id : {$Product->id}\n";
        }
    }

    public function getBrand($brandName)
    {
        $brand = Brand::select('brands.*')
                ->leftJoin('brand_translations', function($join) {
                    $join->on('brands.id', '=', 'brand_translations.brand_id');
                })
                ->where('brand_translations.name',$brandName)
                ->first();
        if (!isset($brand) || empty($brand)) {
            $brand = Brand::create(['name'=>$brandName,'is_active'=>1]);
        }
        return $brand->id;
    }

    public function getFile($url)
    {
        try {
            ini_set('memory_limit', '-1');
            $productFile = file_get_contents($url);
            $pathInfo = pathinfo($url);
            $uploadUrl = public_path('uploads/'.$pathInfo['basename']);
            file_put_contents($uploadUrl,$productFile);
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
        } catch (\Throwable $th) {
            $this->info($url);
            $this->info($th->getMessage());
            return false;
        }
    }

    public function getAttributes($attr,$categories = [])
    {
        $attributes = [];
        $attributes = Attribute::select('attributes.*')
                        ->leftJoin('attribute_translations', function($join) {
                            $join->on('attributes.id', '=', 'attribute_translations.attribute_id');
                        })
                        ->where('attribute_translations.name',$attr['name_de'])
                        ->first();
        if (!isset($attributes) || empty($attributes)) {
            $attributes = Attribute::create(['name'=>$attr['name_de'],'attribute_set_id'=>1,'is_filterable'=>1]);
        }
        if (!$attributes->categories->isEmpty()) {
            $categories = array_unique(array_merge($categories,$attributes->categories->pluck('id')->toArray()));
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
                    $attributesArray[]  =  ['id'=>$attribute->id,'value'=>$attrValue->value];
                }
            }
            if (!$in) {
                $attributesArray[]  =  ['id'=>null,'value'=>$attr['value_de']];
            }
        }else {
            $attributesArray[] = ['id'=>null,'value'=>$attr['value_de']];
        }
        $attributes->saveRelations(['categories'=>$categories,'values'=>$attributesArray]);
        $attributes = Attribute::select('attributes.*','attribute_values.id as attribute_value_id')
                        ->leftJoin('attribute_values', function($join) {
                            $join->on('attributes.id', '=', 'attribute_values.attribute_id');
                        })
                        ->leftJoin('attribute_value_translations', function($join) {
                            $join->on('attribute_values.id', '=', 'attribute_value_translations.attribute_value_id');
                        })
                        ->where('attributes.id',$attributes->id)
                        ->first();
        return $attributes;
    }

    public function getCategories($catName,$parentId=null){
        $categories = [];
        $category = Category::select('categories.*')
                    ->leftJoin('category_translations', function($join) {
                        $join->on('categories.id', '=', 'category_translations.category_id');
                    })
                    ->where('category_translations.name',$catName)
                    ->where('parent_id',$parentId)
                    ->first();
        if (!isset($category) || empty($category)) {
            $category =  Category::create(['name'=>$catName,'is_active'=>1,'is_searchable'=>false,'parent_id'=>$parentId]);
        }
        $categories[] = $category->id;
        if ($category->parent_id) {
            while (true) {

                if ($category->parent_id == null) break;

                $category = Category::find($category->parent_id);

                if (!isset($category) || empty($category)) break;
                
                $categories[] = $category->id;
            }
        }
        return $categories;
    }
}
