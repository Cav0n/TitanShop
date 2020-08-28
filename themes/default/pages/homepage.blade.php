@extends('default.templates.public')

@section('page.content')
    <div class="row mt-2">
        @foreach (App\Models\Category::where('isVisible', 1)->where('isDeleted', 0)->where('parent_id', null)->get() as $category)
        @include('default.components.category-small', ['category' => $category])
        @endforeach
    </div>

    <div class="row mb-3">
        @foreach (App\Models\Product::where('isVisible', 1)->where('isDeleted', 0)->get() as $product)
        @include('default.components.product-small', ['product' => $product])
        @endforeach
    </div>
@endsection
