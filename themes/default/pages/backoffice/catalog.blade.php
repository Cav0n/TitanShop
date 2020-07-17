@extends('default.templates.backoffice')

@section('page.content')
    <div class="row mx-0">
        <div class="col-12 p-0">
            <h1>Catalogue</h1>
        </div>
        <div class="col-12 bg-white p-3 mb-3">
            <h2 class="h4">Catégories</h2>

            @if(isset($categories) && 0 < count($categories))
            <table class="table table-striped table-inverse">
                <thead class="thead-default">
                    <tr>
                        <th class="text-center">ID</th>
                        <th></th>
                        <th>Titre</th>
                        <th class="text-center">Visible</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td scope="row" class="text-center">{{$category->id}}</td>
                        <td></td>
                        <td>{{$category->i18nValue('title')}}</td>
                        <td class="text-center">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="categoryVisibilityToggle-{{$loop->index}}" {{$category->isVisible ? "checked" : null}}>
                                <label class="custom-control-label" for="categoryVisibilityToggle-{{$loop->index}}">
                                    {{$category->isVisible ? "Visible" : "Non visible"}}</label>
                            </div>
                        </td>
                        <td class="text-right">
                            <a name="edit-category" id="edit-category" class="btn btn-primary" href="#" role="button">Modifier</a>
                            <a name="delete-category" id="delete-category" class="btn btn-danger" href="#" role="button">Supprimer</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else

            <p>Aucun catégorie ne semble exister.</p>

            @endif

        </div>

        <div class="col-12 bg-white p-3">
            <h2 class="h4">Produits sans catégories</h2>
        </div>
    </div>
@endsection