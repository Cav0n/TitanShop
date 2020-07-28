<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductI18n;
use App\Models\Utils\CustomString;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function toggleVisibility(Request $request)
    {
        $product = Product::where('id', $request['id'])->first();

        $product->isVisible = !$product->isVisible;
        $product->save();

        return new JsonResponse(['status' => 'success', 'visible' => $product->isVisible]);
    }

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
        return view('default.pages.backoffice.product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $i18n = new ProductI18n();

        $i18n->title = $request['title'];
        $i18n->description = $request['title'];
        $i18n->summary = $request['title'];
        $i18n->lang = $request['lang'] ?? 'fr';

        $product->code = CustomString::prepareStringForURL($code ?? $request['title']);
        $product->isVisible = (isset($request['isVisible'])) ? true : false;
        $product->price = $request['price'];
        $product->stock = $request['stock'];
        $product->save();

        $i18n->product_id = $product->id;
        $i18n->save();

        return redirect(route('admin.catalog'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        if ($product->isDeleted || !$product->isVisible) {
            abort(404);
        }

        return view('default.pages.product', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('default.pages.backoffice.product', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return JsonResponse
     */
    public function destroy(Request $request, Product $product = null)
    {
        if (isset($product) || null !== $product = Product::where('id', $request['id'])->first()) {
            $product->isDeleted = true;
            $product->save();
            return new JsonResponse(['status' => 'success']);
        }

        return new JsonResponse(['status' => 'error', 'message' => 'Product doesn\'t exists'], 404);
    }
}
