<?php

namespace FleetCart\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Modules\Import\Http\Controllers\Admin\ImporterController;
use Modules\Product\Entities\Product;
use Illuminate\Support\Facades\Log;

class Facebook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facebook:feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Facebook Feed';

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
        $this->createFeed();
        return 0; // 0 is exit code for successfully executed

    }

    private function createFeed()
    {
        $productsCount = Product::count();
        $bar = $this->output->createProgressBar($productsCount);
        $bar->start();
        $path = public_path('product/');
        $fileName = 'feed.csv';
        $file = fopen($path . $fileName, 'w');
        $columns = array('id', 'title', "description", "availability", "condition", "price", "link", "image_link", "brand");


        fputcsv($file, $columns);
        Product::chunk(2000, function($products) use ($file, $bar) {
            foreach ($products as $item) {
                try {
                    if ($item->id != "" && $item->name != "" && $item->selling_price->amount != "" && $item->selling_price->currency != "" && $item->slug != "" && $item->base_image->path != "") {
                        //$brand=Brand::where("")
                        $data = [
                            "id" => $item->id,
                            "title" => ucfirst($item->name),
                            "description" => ucfirst($item->description),
                            "availability" => "in stock",
                            "condition" => "new",
                            "price" => $item->selling_price->amount . " " . $item->selling_price->currency,
                            "link" => url('products/' . $item->slug),
                            "image_link" => $item->base_image->path,
                            "brand" => "Ejimm",
                        ];
                    }
                    fputcsv($file, $data);
                } catch (Exception $ex) {

                }
                usleep(10000);
            }
            $bar->advance();
        });
        fclose($file);

        $bar->finish();
    }
}
