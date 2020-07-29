<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryI18n;
use App\Models\Product;
use App\Models\Utils\CustomString;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function toggleVisibility(Request $request)
    {
        $category = Category::where('id', $request['id'])->first();

        $category->isVisible = !$category->isVisible;
        $category->save();

        return new JsonResponse(['status' => 'success', 'visible' => $category->isVisible]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category = null)
    {
        $categories = Category::where('isDeleted', 0)->where('parent_id', null !== $category ? $category->id : null)->get();

        $products = (null !== $category)
            ? $category->products()->where('isDeleted', 0)->get()
            : Product::where('isDeleted', 0)->whereDoesntHave('categories')->get();

        return view('default.pages.backoffice.catalog', [
            'parentCategory' => $category,
            'categories' => $categories,
            'products' => $products
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $parent = null;

        if (isset($request['parent'])) {
            $parent = $request['parent'];
        }

        return view('default.pages.backoffice.category', ['parent' => $parent]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $i18n = new CategoryI18n();

        $i18n->title = $request['title'];
        $i18n->description = $request['title'];
        $i18n->summary = $request['title'];
        $i18n->lang = $request['lang'] ?? 'fr';

        $category->code = CustomString::prepareStringForURL($request['code'] ?? $request['title']);
        $category->isVisible = (isset($request['isVisible'])) ? true : false;
        $category->parent_id = $request['parentId'] ?? null;
        $category->save();

        $i18n->category_id = $category->id;
        $i18n->save();

        return redirect(route('admin.catalog'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if ($category->isDeleted || !$category->isVisible) {
            abort(404);
        }

        return view('default.pages.category', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('default.pages.backoffice.category', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if (null === $i18n = $category->i18ns()->where('lang', $request['lang'] ?? 'fr')->first()) {
            $i18n = new CategoryI18n();
        }

        $i18n->title = $request['title'];
        $i18n->description = $request['title'];
        $i18n->summary = $request['title'];
        $i18n->lang = $request['lang'] ?? 'fr';

        $category->code = CustomString::prepareStringForURL($request['code'] ?? $request['title']);
        $category->isVisible = (isset($request['isVisible'])) ? true : false;
        $category->save();

        $i18n->category_id = $category->id;
        $i18n->save();

        return redirect(route('admin.catalog'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return JsonResponse
     */
    public function destroy(Request $request, Category $category = null)
    {
        if (isset($category) || null !== $category = Category::where('id', $request['id'])->first()) {
            $category->isDeleted = true;
            $category->save();
            return new JsonResponse(['status' => 'success']);
        }

        return new JsonResponse(['status' => 'error', 'message' => 'Category doesn\'t exists'], 404);
    }
}
