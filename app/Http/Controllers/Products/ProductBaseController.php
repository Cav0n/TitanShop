<?php

namespace App\Http\Controllers\Products;

use App\ProductBase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductI18n;

class ProductBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductBase::where('isVisible', 1)->where('isDeleted', 0)->get();
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
            'price' => 'required|numeric|min:0',
            'promoPrice' => 'required|numeric|min:0',
            'stock' => 'nullable|numeric|min:0',
            'title' => 'required|min:3',
            'description' => 'required|min:10',
        ]);

        $product = new ProductBase();
        $product->price = $request['price'];
        $product->promoPrice = $request['promoPrice'];
        $product->stock = $request['stock'];
        $product->isVisible = $request['isVisible'];
        $product->save();

        $productI18n = new ProductI18n();
        $productI18n->product_base_id = $product->id;
        $productI18n->lang = $request['lang'] ?? 'FR';
        $productI18n->title = trim($request['title']);
        $productI18n->description = trim($request['description']);
        $productI18n->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductBase  $productBase
     * @return \Illuminate\Http\Response
     */
    public function show(ProductBase $product)
    {
        return view('themes.default.pages.public.product')->with(['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductBase  $productBase
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductBase $productBase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductBase  $productBase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductBase $product)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
            'promoPrice' => 'required|numeric|min:0',
            'stock' => 'nullable|numeric|min:0',
            'title' => 'required|min:3',
            'description' => 'required|min:10',
        ]);

        $product->price = $request['price'];
        $product->promoPrice = $request['promoPrice'];
        $product->stock = $request['stock'];
        $product->isVisible = $request['isVisible'];
        $product->save();

        $productI18n = ProductI18n::where('id', $request['productI18n_id'])->first ?? new ProductI18n();
        $productI18n->product_base_id = $product->id;
        $productI18n->lang = $request['lang'] ?? 'FR';
        $productI18n->title = trim($request['title']);
        $productI18n->description = trim($request['description']);
        $productI18n->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductBase  $productBase
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductBase $product)
    {
        $product->isDeleted = true;
        $product->save();
    }
}
