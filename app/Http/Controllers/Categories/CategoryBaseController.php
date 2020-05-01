<?php

namespace App\Http\Controllers\Categories;

use App\CategoryBase;
use App\CategoryI18n;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = CategoryBase::where('isDeleted', 0)
                        ->where('parent_id', $request['parent_id'])
                        ->get();

        $category = CategoryBase::where('id', $request['parent_id'])->first();

        return view('themes.default.pages.admin.categories')->with(['categories' => $categories, 'category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $parent = isset($request['parent']) ? \App\CategoryBase::where('id', $request['parent'])->first() : null;

        return view('themes.default.pages.admin.category', ['parent' => $parent]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoryBase = new CategoryBase();
        $categoryBase->parent_id = $request['parent_id'];
        $categoryBase->isVisible = $request['isVisible'] ? 1 : 0;

        $categoryBase->save();

        $categoryI18n = new CategoryI18n();
        $categoryI18n->title = $request['title'];
        $categoryI18n->description = $request['description'];
        $categoryI18n->category_base_id = $categoryBase->id;

        $categoryI18n->save();

        return redirect(route('admin.category.edit', ['categoryBase' => $categoryBase]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoryBase  $category
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryBase $category)
    {
        return view('themes.default.pages.public.category', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CategoryBase  $categoryBase
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryBase $categoryBase)
    {
        return view('themes.default.pages.admin.category', ['category' => $categoryBase, 'parent' => $categoryBase->parent]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoryBase  $categoryBase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryBase $categoryBase)
    {
        $categoryBase->isVisible = $request['isVisible'] ? 1 : 0;
        $categoryBase->save();

        $i18n = $categoryBase->i18ns()->where('lang', $request['lang'])->first();
        $i18n->title = $request['title'];
        $i18n->description = $request['description'];
        $i18n->save();

        return redirect()->back()->with(['success' => ['La catégorie a été modifié avec succés.']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoryBase  $categoryBase
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryBase $categoryBase)
    {
        //
    }
}
