@extends('templates.admin')

@section('page.title', 'Produits')

@section('page.breadcrumb')
<p id="breadcrumb">
    / <a href="{{ route('admin.index') }}">Accueil</a>
    / <a href="{{ route('admin.products') }}">Produits</a>
</p>
@endsection

@section('page.content')
<div class="bg-white p-3 shadow-sm">
    <table class="table border mb-0">
        <thead class="thead thead-light">
            <tr>
                <th>Produit</th>
                <th class="text-center">Stock</th>
                <th class="text-center">Prix</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td class="align-middle">{{ $product->title }}</td>
                <td class="text-center align-middle">{{ $product->stock }}</td>
                <td class="text-center align-middle">{{ $product->priceFormatted }}</td>
                <td class="text-right align-middle">
                    <a class="btn btn-primary ml-auto" href="#" role="button">Éditer</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
