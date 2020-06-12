@extends('templates.admin')

@section('page.title', isset($product) ? $product->title : 'Nouveau produit')

@section('page.breadcrumb')
<p id="breadcrumb">
    / <a href="{{ route('admin.index') }}">Accueil</a>
    / <a href="{{ route('admin.products') }}">Produits</a>
    @isset($product)
    / <a href="{{ route('admin.product.edit', ['product' => $product]) }}">{{ $product->title }}</a>
    @else
    / <a href="{{ route('admin.product.create') }}">Nouveau produit</a>
    @endisset
</p>
@endsection

@isset($product)
@section('page.buttons')
    <a class="btn btn-primary mb-3" href="{{ route('product.show', ['product' => $product]) }}" role="button" target="_blank" rel="noopener noreferrer">
        Voir le produit</a>
@endsection
@endisset

@section('page.content')
<a class="btn btn-outline-dark mb-3 py-0 px-2" href="{{ route('admin.products') }}" role="button">
    Retour</a>

@include('themes.default.components.alerts.error')
@include('themes.default.components.alerts.success')

<div class="bg-white p-3 shadow-sm">
    @include('themes.default.pages.admin.forms.product-edition', [
            'product' => $product ?? null
        ])
</div>
@endsection
