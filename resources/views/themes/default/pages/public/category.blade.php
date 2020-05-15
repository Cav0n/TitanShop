@extends('templates.default')

@section('page.title', $category->title . ' - ' . App\Setting::valueOrNull('SHOP_NAME'))
@section('page.description', $category->description)

@section('page.content')
    <div id="breadcrumb" class="row">
        <div class="col-12">
            {!! $category->breadcrumb !!}
        </div>
    </div>

    <div id="category-page" class="row">
        <div class="col-12">
            <h1>{{ $category->title }}</h1>
            <p class='text-justify'>{!! $category->description !!}</p>
        </div>

        {{-- Childs categories --}}
        @if (0 < count($category->childs))
        <div class="col-12">
            <div class="row">
                @foreach ($category->childs as $child)
                <div class="col-6 col-sm-4 col-lg-3 mt-3 d-flex">
                    <a class="p-3 bg-white border shadow-sm w-100" href="{{ route('category.show', ['category' => $child]) }}">{{ $child->title }}</a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Category's products --}}
        @if (0 < count($category->products))
        <div class="col-12">
            <div class="row">
                @foreach ($category->products as $product)
                <div class="col-6 col-sm-4 col-lg-3 mt-3">
                    @include('themes.default.components.layouts.product', [
                        'product' => $product,
                    ])
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($category->isEmpty)
        <div class="col-12 mt-3">
            <p class="text-center">Cette catégorie ne contient ni sous catégorie, ni produit.</p>
        </div>
        @endif
    </div>
@endsection
