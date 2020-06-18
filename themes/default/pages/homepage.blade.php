@extends('default.templates.public')

@section('page.content')
    <div class="row mb-3">
        @foreach (App\Models\Category::where('isVisible', 1)->get() as $category)
        <a class="category-small-container col-lg-2 text-center">
            <div class="category-small rounded transition noselect">
                <p class="p-3">
                    {{$category->i18nValue('title')}}
                </p>
            </div>
        </a>
        @endforeach
    </div>
@endsection
