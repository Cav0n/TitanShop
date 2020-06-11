<?php

namespace App\Http\Controllers\Products;

use App\CategoryBase;
use App\CategoryI18n;
use App\ProductBase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductI18n;
use Illuminate\Http\JsonResponse;

class ProductBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductBase::where('isDeleted', 0)->get();

        return view('themes.default.pages.admin.products')->with(['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\CategoryBase::where('isDeleted', 0)->get();

        return view('themes.default.pages.admin.product', ['categories' => $categories]);
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
            'promoPrice' => 'nullable|numeric|min:0',
            'stock' => 'nullable|numeric|min:0',
            'title' => 'required|min:3',
            'description' => 'required|min:10',
        ]);

        $product = new ProductBase();
        $product->price = $request['price'];
        $product->promoPrice = $request['promoPrice'];
        $product->stock = $request['stock'];
        $product->isVisible = $request['isVisible'] ? 1 : 0;
        $product->save();

        if (isset($request['category'])) {
            $product->categories()->attach($request['category']);
        }

        if (isset($request['categoryName'])) {
            $categoryI18n = new CategoryI18n();
            $categoryI18n->title = $request['categoryName'];
            $categoryI18n->description = $request['categoryDescription'];

            $categoryBase = new CategoryBase();
            $categoryBase->parent_id = $request['parent_id'];
            $categoryBase->isVisible = $request['isVisible'] ? 1 : 0;
            $categoryBase->save();

            $categoryI18n->category_base_id = $categoryBase->id;
            $categoryI18n->save();
        }

        $productI18n = new ProductI18n();
        $productI18n->product_base_id = $product->id;
        $productI18n->lang = $request['lang'] ?? 'FR';
        $productI18n->title = trim($request['title']);
        $productI18n->description = trim($request['description']);
        $productI18n->save();

        $categories = \App\CategoryBase::where('isDeleted', 0)->get();

        return redirect(route('admin.product.edit', ['product' => $product]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductBase  $product
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
    public function edit(ProductBase $product)
    {
        $categories = \App\CategoryBase::where('isDeleted', 0)->get();

        return view('themes.default.pages.admin.product', [
            'categories' => $categories,
            'product' => $product
        ]);
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
            'promoPrice' => 'nullable|numeric|min:0',
            'stock' => 'nullable|numeric|min:0',
            'title' => 'required|min:3',
            'description' => 'required|min:10',
        ]);

        $product->price = $request['price'];
        $product->promoPrice = $request['promoPrice'];
        $product->stock = $request['stock'] ?? 0;
        $product->isVisible = $request['isVisible'] ? 1 : 0;
        $product->save();

        $product->categories()->detach();
        $product->categories()->attach($request['category']);

        $productI18n = $product->i18ns()->where('lang', $request['lang'])->first();
        $productI18n->product_base_id = $product->id;
        $productI18n->lang = $request['lang'] ?? 'FR';
        $productI18n->title = trim($request['title']);
        $productI18n->description = trim($request['description']);
        $productI18n->save();

        return redirect()->back()->with(['success' => ['Le produit a été modifié avec succés.']]);
    }

    public function addImage(Request $request, ProductBase $product)
    {
        $request->validate([
            'image' => 'image',
        ]);

        $originalName = $request->image->getClientOriginalName();

        $path = $request->image->storeAs(
            'public/images/products', $originalName
        );

        $image = new \App\Image();
        $image->path =  'images/storage/products/' . $originalName;
        $image->alt = $originalName;
        $image->size = $request['filesize'];
        $image->save();

        $product->images()->attach($image);

        return new JsonResponse(['image' => $image->path], 200);
    }

    public function deleteImage(Request $request, ProductBase $product, \App\Image $image)
    {
        $image->delete();
        //$product->images()->detach($image);

        return new JsonResponse(['message' => 'Product image deleted successfully']);
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
