<?php

namespace App\Console\Commands\Create;

use App\Console\Commands\TitanshopCommand;
use App\Models\OrderStatus;
use App\Models\OrderStatusI18n;
use App\Models\Product as ModelsProduct;
use App\Models\ProductI18n;
use App\Models\Utils\CustomString;

class Product extends TitanshopCommand
{
    const BASIC_ORDER_STATUS = [
        'WAITING_PAYMENT'   => [
            'title' => 'En attente de paiement',
            'color' => '#ebce2d'
        ],
        'PAID'              => [
            'title' => 'Payée',
            'color' => '#7feb2d'
        ],
        'PROCESSING'        => [
            'title' => 'En cours de traitement',
            'color' => '#2db8eb'
        ],
        'IN_DELIVERING'     => [
            'title' => 'En cours de livraison',
            'color' => '#06d429'
        ],
        'DELIVERED'         => [
            'title' => 'Livrée',
            'color' => '#06d429'
        ],
        'CANCELED'          => [
            'title' => 'Annulée',
            'color' => '#d11a17'
        ]
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'titanshop:generate:order-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all basic order status';

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

        if (count(OrderStatus::all()) > 0) {
             if (! $this->confirm('It looks like there is already some order status, are you sure you want to generate basics order status ?')) {
                 return;
             }
        }

        $this->info('Generating all order status, please wait...');

        foreach (self::BASIC_ORDER_STATUS as $code => $values) {
            $orderStatus = new OrderStatus();
            $orderStatus->code = $code;
            $orderStatus->color = $values['color'];
            $orderStatus->save();

            $orderStatusI18n = new OrderStatusI18n();
            $orderStatusI18n->title = $values['title'];
            $orderStatusI18n->order_status_id = $orderStatus->id;
            $orderStatusI18n->save();
        }

        $this->info('Product successfully created.');
    }
}
