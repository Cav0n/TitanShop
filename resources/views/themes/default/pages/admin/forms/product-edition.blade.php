<form action="{{ isset($product) ? route('admin.product.update', ['product' => $product]) : route('admin.product.store') }}" method="POST">
    @csrf

    @include('themes.default.components.forms.input', [
        'name' => 'title',
        'label' => 'Titre',
        'value' => old('title', isset($product) ? $product->title : null),
        'required' => true
    ])

    @include('themes.default.components.forms.textarea', [
        'name' => 'description',
        'label' => 'Description',
        'value' => old('description', isset($product) ? $product->description : null),
        'required' => true
    ])


    <div class="row">
        <div class="col-md-6">
            @include('themes.default.components.forms.price', [
                'name' => 'price',
                'label' => 'Prix',
                'value' => old('price', isset($product) ? $product->price : null),
                'required' => true
            ])
        </div>

        <div class="col-md-6">
            @include('themes.default.components.forms.input', [
                'name' => 'stock',
                'label' => 'Stock',
                'type' => 'number',
                'min' => 0,
                'step' => 1,
                'value' => old('stock', isset($product) ? $product->stock : null),
                'required' => false
            ])
        </div>
    </div>

    <div class="form-group">
        @if(isset($categories) && 0 < count($categories))
            @include('themes.default.components.forms.select', [
                'name' => 'category',
                'label' => 'Catégorie',
                'value' => old('category', isset($product) ? $product->categories->first->name : null),
                'options' => $categoriesOptions
            ])
        @else
            @include('themes.default.components.forms.input', [
                'name' => 'categoryName',
                'label' => 'Nom de la catégorie du produit',
                'required' => true
            ])

            @include('themes.default.components.forms.textarea', [
                'name' => 'categoryDescription',
                'label' => 'Description de la catégorie du produit',
                'required' => true
            ])
        @endif
    </div>

    @include('themes.default.components.forms.checkbox', [
        'name' => 'isVisible',
        'label' => 'Le produit est visible',
        'checked' => isset($product) ? $product->isVisible : null,
    ])

    <input type="hidden" name="lang" value="FR">

    <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>

@isset($product)
    @include('themes.default.pages.admin.forms.product-images', ['product' => $product])
@endisset
