@extends('default.templates.public')

@section('page.content')
    <div class="row">
        <div class="col-lg-6">
            <h2>{{$category->i18nValue('title')}}</h2>
            <p>{{$category->i18nValue('description')}}</p>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-12">
            <p class="text-center">
                Il n'y a aucun produit dans cette catégorie pour le moment.
            </p>
        </div>
    </div>
@endsection
