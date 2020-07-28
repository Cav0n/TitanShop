@extends('default.templates.backoffice')

@section('page.content')
    <form class="row mx-0" action="{{route('admin.product.create')}}" method="POST">
        @csrf
        <div class="col-12 p-0 d-flex justify-content-between">
            <h1>Produit</h1>

            <div class="btn-container d-flex">
                <a class="btn btn-success text-white mr-2">Sauvegarder</a>
            </div>
        </div>

        <h2 class="h4">Textes</h2>
        <div class="col-12 row bg-white p-3 mb-3 mx-0 border shadow-sm backoffice-card">
            <div class="form-group col-lg-8">
                <label for="title">Titre</label>
                <input type="text" class="form-control" name="title" id="title">
            </div>
            <div class="form-group col-lg-4">
                <label for="code">Code</label>
                <input type="text" class="form-control" name="code" id="code" aria-describedby="helpCode">
                <small id="helpCode" class="form-text text-muted">Laissez vide si vous ne savez pas à quoi cela correspond 😉</small>
            </div>
            <div class="form-group col-12">
                <label for="summary">Résumé</label>
                <textarea class="form-control" name="summary" id="summary" rows=4></textarea>
            </div>
            <div class="form-group col-12">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows=4></textarea>
            </div>
            <div class="form-group col-12 mb-0">
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="isVisible" id="isVisible" checked> Le produit est visible
                    </label>
                </div>
            </div>
        </div>

        <h2 class="h4">Prix et stock</h2>
        <div class="col-12 row bg-white p-3 mb-3 mx-0 border shadow-sm backoffice-card">
            <div class="form-group col-lg-6">
                <label for="price">Prix</label>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="price" id="price" min=0.01 step=0.01>
                    <div class="input-group-append">
                        <span class="input-group-text">€</span>
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" name="stock" id="stock" min=0 step=1>
            </div>
        </div>

        <h2 class="h4">Images</h2>
        <div class="col-12 row bg-white p-3 mx-0 border shadow-sm backoffice-card">
            <p>Bientôt disponible</p>
        </div>
    </div>
@endsection
