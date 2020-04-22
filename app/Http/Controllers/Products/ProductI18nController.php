<?php

namespace App\Http\Controllers\Products;

use App\ProductI18n;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductI18nController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i18ns = ProductI18n::all();
        $results = [];

        foreach ($i18ns as $i18n) {
            if ($i18n->product->isAvailable) {
                $results[] = $i18n;
            }
        }

        return $results;
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
        $request->validate([
            'product_base_id' => 'required|exists:product_bases,id',
            'title' => 'required|min:3',
            'description' => 'required|min:10',
        ]);

        $productI18n = new ProductI18n();
        $productI18n->product_base_id = $request['product_base_id'];
        $productI18n->lang = $request['lang'] ?? 'FR';
        $productI18n->title = $request['title'];
        $productI18n->description = $request['description'];
        $productI18n->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductI18n  $productI18n
     * @return \Illuminate\Http\Response
     */
    public function show(ProductI18n $productI18n)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductI18n  $productI18n
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductI18n $productI18n)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductI18n  $productI18n
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductI18n $productI18n)
    {
        $request->validate([
            'product_base_id' => 'required|exists:product_bases,id',
            'title' => 'required|min:3',
            'description' => 'required|min:10',
        ]);

        $productI18n->product_base_id = $request['product_base_id'];
        $productI18n->lang = $request['lang'] ?? 'FR';
        $productI18n->title = $request['title'];
        $productI18n->description = $request['description'];
        $productI18n->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductI18n  $productI18n
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductI18n $productI18n)
    {
        $productI18n->forceDelete();
    }
}
