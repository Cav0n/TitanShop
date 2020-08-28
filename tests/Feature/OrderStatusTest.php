<?php

namespace Tests\Feature;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\OrderStatusI18n;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderStatusTest extends TestCase
{
    use RefreshDatabase;

    public function testCompleteCreation()
    {
        $orderStatus = self::create(
            'TEST_STATUS',
            '#FFFFFF',
            'Status de test'
        );

        $this->assertNotNull($orderStatus);
    }

    public static function create(
        $code,
        $color,
        $title,
        $description = null
    ) {
        $orderStatus = new OrderStatus();
        $orderStatus->code = $code;
        $orderStatus->color = $color;
        $orderStatus->save();

        $orderStatusI18n = new OrderStatusI18n();
        $orderStatusI18n->title = $title;
        $orderStatusI18n->description = $description;
        $orderStatusI18n->order_status_id = $orderStatus->id;
        $orderStatusI18n->save();

        return $orderStatus;
    }
}
