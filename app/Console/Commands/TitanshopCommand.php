<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TitanshopCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'titanshop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'TitanShop base command.';

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
        $this->info("
         _____ _ _              
        /__   (_) |_ __ _ _ __  
          / /\/ | __/ _` | '_ \ 
         / /  | | || (_| | | | |
         \/   |_|\__\__,_|_| |_|
                                
        ");
    }
}
