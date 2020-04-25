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
        //
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
        //
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
