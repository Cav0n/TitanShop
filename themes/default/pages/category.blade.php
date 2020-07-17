@extends('default.templates.public')

@section('page.title', $category->i18nValue('title'))

@section('page.content')
    @include('default.components.breadcrumb', ['breadcrumb' => $category->generateBreadcrumb()])

    <div class="row">
        <div class="col-lg-6">
            <h2>{{$category->i18nValue('title')}}</h2>
            <p>{{$category->i18nValue('description')}}</p>
        </div>
    </div>

    <div class="row mb-3">
        @foreach ($category->visibleChilds as $child)
            @include('default.components.category-small', ['category' => $child])
        @endforeach
    </div>

    <div class="row my-4">
        <div class="col-12">
            @if(0 === count($category->products))
            <p class="text-center">
                Il n'y a aucun produit dans cette catégorie pour le moment.
            </p>
            @else
            <div class="row mb-3">
                @foreach ($category->products as $product)
                @include('default.components.product-small', ['product' => $product])
                @endforeach
            </div>
            @endif
        </div>
    </div>
@endsection
