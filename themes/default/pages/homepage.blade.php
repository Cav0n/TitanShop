@extends('default.templates.public')

@section('page.content')
    <div class="col-12">
        @foreach (App\Models\Category::all() as $category)
            <p>{{$category->title}}</p>
        @endforeach
    </div>
@endsection
