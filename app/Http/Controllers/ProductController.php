<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductI18n;
use App\Models\Utils\CustomString;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function create(Request $request)
    {
        $defaultCategory = null;

        if (isset($request['default_category'])) {
            $defaultCategory = Category::where('id', $request['default_category'])->first();
        }

        return view('default.pages.backoffice.product', ['defaultCategory' => $defaultCategory]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product::validator($request->toArray())->validate();
        ProductI18n::validator($request->toArray())->validate();

        $product = new Product();
        $i18n = new ProductI18n();

        $i18n->title = $request['title'];
        $i18n->description = $request['description'];
        $i18n->summary = $request['summary'];
        $i18n->lang = $request['lang'] ?? 'fr';

        $product->code = CustomString::prepareStringForURL($code ?? $request['title']);
        $product->isVisible = (isset($request['isVisible'])) ? true : false;
        $product->price = $request['price'];
        $product->isInPromo = $request['isInPromo'] != null;
        $product->promoPrice = $request['promoPrice'];
        $product->stock = $request['stock'];
        $product->save();

        $i18n->product_id = $product->id;
        $i18n->save();

        $categoryIds = [];

        if (null !== $request['categories']) {
            foreach (json_decode($request['categories'], true) as $category) {
                $categoryIds[] = $category['id'];
            }
        }

        $product->categories()->sync($categoryIds);

        $images = [];
        if ($request['imagePaths']) {
            foreach ($request['imagePaths'] as $index => $oldImagePath) {
                // Check if image already exists for the product
                if ($product->images()->where('path', $oldImagePath)->exists()) {
                    continue;
                }

                $imageTitle = $product->code . '-' . uniqid() . '.' . pathinfo($oldImagePath)['extension'];
                Storage::move($oldImagePath, 'images/products/' .$imageTitle);

                //TODO: Create image in an event
                $image = new Image();
                $image->path = 'public/storage/images/products/' . $imageTitle;
                $image->url = asset('storage/images/products/' . $imageTitle);
                $image->size = Storage::size('/images/products/' .$imageTitle);
                $image->save();

                $images[$image->id] = ['position' => $index];
            }
        }

        $product->images()->sync($images);

        return redirect(route('admin.product.edit', ['product' => $product]))->withSuccess('Le produit a été sauvegardé avec succés.');
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
        Product::validator($request->toArray(), $product)->validate();
        ProductI18n::validator($request->toArray())->validate();

        $categoryIds = [];

        if (null !== $request['categories']) {
            foreach (json_decode($request['categories'], true) as $category) {
                if (isset($request['default_category']) && json_decode($request['default_category'], true)[0]['id'] === $category['id']) {
                    $categoryIds[$category['id']] = ['isDefault' => 1];
                } else {
                    $categoryIds[] = $category['id'];
                }
            }
        }

        $product->categories()->sync($categoryIds);

        if (null === $i18n = $product->i18ns()->where('lang', $request['lang'] ?? 'fr')->first()) {
            $i18n = new ProductI18n();
        }

        $i18n->title = $request['title'];
        $i18n->description = $request['description'];
        $i18n->summary = $request['summary'];
        $i18n->lang = $request['lang'] ?? 'fr';

        $product->code = CustomString::prepareStringForURL($request['code'] ?? $request['title']);
        $product->isVisible = (isset($request['isVisible'])) ? true : false;
        $product->price = $request['price'];
        $product->isInPromo = $request['isInPromo'] != null;
        $product->promoPrice = $request['promoPrice'];
        $product->stock = $request['stock'];
        $product->save();

        $i18n->product_id = $product->id;
        $i18n->save();

        if ($request['imagePaths']) {
            $images = [];

            foreach ($request['imagePaths'] as $index => $oldImagePath) {
                // Check if image already exists for the product
                if (null !== $image = $product->images()->where('path', $oldImagePath)->first()) {
                    if (isset($request['image-position'])) {
                        $images[$image->id] = ['position' => $request['image-position']["'".$image->id."'"]];
                    } else {
                        $images[$image->id] = ['position' => $index];
                    }
                    continue;
                }

                $imageTitle = $product->code . '-' . uniqid() . '.' . pathinfo($oldImagePath)['extension'];
                Storage::move($oldImagePath, 'images/products/' .$imageTitle);

                //TODO: Create image in an event
                $image = new Image();
                $image->path = 'public/storage/images/products/' . $imageTitle;
                $image->url = asset('storage/images/products/' . $imageTitle);
                $image->size = Storage::size('/images/products/' .$imageTitle);
                $image->save();

                $images[$image->id] = ['position' => $index];
            }

            $product->images()->sync($images);
        }

        return back()->withSuccess('Le produit a été sauvegardé avec succés.');
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
