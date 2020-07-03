<?php

namespace App\Console\Commands\Create;

use App\Console\Commands\TitanshopCommand;
use App\Models\Product as ModelsProduct;
use App\Models\ProductI18n;
use App\Models\Utils\CustomString;

class Product extends TitanshopCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'titanshop:create:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a brand new product';

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
     * @return mixed
     */
    public function handle()
    {
        parent::handle();

        $title = $this->ask('Title');
        $price = $this->ask('Price');
        $stock = $this->ask('Stock');
        $description = $this->ask('Description (could be empty)');
        $summary = $this->ask('Summary (could be empty)');
        $lang = $this->ask('Lang (could be empty for "fr")');
        $code = $this->ask('Code (for url, could be empty for auto generation)');
        $isVisible = $this->confirm('The product is visible on the shop ?');

        $productI18n = new ProductI18n();
        $productI18n->title = $title;
        $productI18n->description = $description;
        $productI18n->summary = $summary;
        $productI18n->lang = $lang ?? 'fr';

        $product = new ModelsProduct();
        $product->code = CustomString::prepareStringForURL($code ?? $title);
        $product->price = $price;
        $product->stock = $stock;
        $product->isVisible = $isVisible;
        $product->save();

        $productI18n->product_id = $product->id;
        $productI18n->save();

        $this->info('Product successfully created.');
    }
}
