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
use FleetCart\Console\Commands\ProductCreateWithProPlus;
use Illuminate\Support\Facades\Log;


class ProPlusProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pro:plus:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create And Update Product With ProPlus Api';

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
        Log::info('Showing ProPlusProducts');
        die();
        $responseJson = InternetBikes::getProPlusProducts();

        if (!isset($responseJson) || empty($responseJson)) return  $this->info('No Records Found');

        $response = json_decode($responseJson,true);

        $i = 1;
        if (isset($response) && !empty($response) && is_array($response)) {
            foreach ($response as $responseKey => $responseValue) {
                $date = date('Y-m-d H:i:s');
                $this->info("Processing : {$i}");
                $this->info("Time : {$date}");
                $proPlus = ProductCreateWithProPlus::saveProduct($responseValue);
                $i++;
            }
        }else {
            $this->info('No Records Found');
        }
    }
}
