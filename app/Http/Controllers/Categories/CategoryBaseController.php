<?php

namespace App\Http\Controllers\Categories;

use App\CategoryBase;
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
        return view('themes.default.pages.admin.category', ['category' => $categoryBase]);
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
