<form action="{{ route('admin.product.store') }}" method="POST">
    @csrf

    @include('themes.default.components.forms.input', [
        'name' => 'title',
        'label' => 'Titre',
        'required' => true
    ])

    @include('themes.default.components.forms.textarea', [
        'name' => 'description',
        'label' => 'Description',
        'required' => true
    ])


    <div class="row">
        <div class="col-md-6">
            @include('themes.default.components.forms.price', [
                'name' => 'price',
                'label' => 'Prix',
                'min' => 0,
                'step' => 0.01,
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
                'required' => false
            ])
        </div>
    </div>

    <div class="form-group">
        @if(isset($categories) && 0 < count($categories))
            @include('themes.default.components.forms.select', [
                'name' => 'category',
                'label' => 'Catégorie',
                'value' => old('category'),
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
        'checked' => old('isVisible'),
    ])

    <input type="hidden" name="lang" value="FR">

    <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>
