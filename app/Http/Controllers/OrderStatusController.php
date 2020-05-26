<?php

namespace App\Http\Controllers;

use App\OrderStatus;
use App\OrderStatusI18n;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function show(OrderStatus $orderStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderStatus $orderStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderStatus $orderStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderStatus $orderStatus)
    {
        //
    }

    /**
     * This is called during installation process.
     *
     * @return bool
     */
    public function install()
    {
        $path = \base_path() . "/config/json/order_status.json";

        $json = json_decode(file_get_contents($path), true);

        foreach ($json['status'] as $value) {
            $status = new OrderStatus();

            $status->code = $value['code'];
            $status->color = $value['color'];
            $status->save();

            if (isset($value['parent'])) {
                $status->parent_id = OrderStatus::where('code', $value['parent'])->first()->id;
                $status->save();
            }

            if (isset($value['i18n'])) {
                foreach ($value['i18n'] as $valueI18n) {
                    $statusI18n = new OrderStatusI18n();

                    $statusI18n->lang = $valueI18n['lang'];
                    $statusI18n->title = $valueI18n['title'];
                    $statusI18n->order_status_id = $status->id;
                    $statusI18n->save();
                }
            }
        }

        return true;
    }
}
