<?php

namespace App\Console\Commands\Create;

use App\Console\Commands\TitanshopCommand;
use App\Models\Category as ModelsCategory;
use App\Models\CategoryI18n;
use App\Models\Utils\CustomString;

class Category extends TitanshopCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'titanshop:create:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a brand new category';

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
        $description = $this->ask('Description (could be empty)');
        $summary = $this->ask('Summary (could be empty)');
        $lang = $this->ask('Lang (could be empty for "fr")');
        $code = $this->ask('Code (for url, could be empty for auto generation)');
        $isVisible = $this->confirm('The category is visible on the shop ?');

        $categoryI18n = new CategoryI18n();
        $categoryI18n->title = $title;
        $categoryI18n->description = $description;
        $categoryI18n->summary = $summary;
        $categoryI18n->lang = $lang ?? 'fr';

        $category = new ModelsCategory();
        $category->code = CustomString::prepareStringForURL($code ?? $title);
        $category->isVisible = $isVisible;
        $category->save();

        $categoryI18n->category_id = $category->id;
        $categoryI18n->save();
    }
}
