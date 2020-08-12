@extends('default.templates.backoffice')

@section('page.content')
    <form class="row mx-0" action="{{isset($product) ? route('admin.product.update', ['product' => $product]) : route('admin.product.store')}}" method="POST">
        @csrf

        @if(isset($defaultCategory))
            <input type="hidden" name="defaultCategory" value="{{$defaultCategory}}">
        @endif

        <div class="col-12 d-flex flex-column flex-lg-row justify-content-between">
            <h1>{{isset($product) ? $product->i18nValue('title') : "Nouveau produit"}}</h1>

            <div class="btn-container d-flex">
                @isset($product)
                <a class="btn btn-primary mr-2 my-lg-0" href="{{ route('product.show', ['product' => $product]) }}" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-eye"></i>
                    Voir le produit</a>
                @endisset
                <button type="submit" class="btn btn-success my-3 my-lg-0">
                    <i class="fas fa-save"></i>
                    Sauvegarder</button>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-between">
            <div class="admin-breadcrumb mb-3">
                <a href='{{ route('admin.homepage') }}'><i class="fa fa-home" aria-hidden="true"></i></a>
                / <a href='{{ route('admin.catalog') }}'>Catalogue</a>

                @if (isset($product))
                @if (null !== $product->defaultCategory)
                / <a href='{{ route('admin.catalog', ['category' => $product->defaultCategory]) }}'>...</a>
                @endif

                / <a href='{{ route('admin.product.edit', ['product' => $product]) }}'>{{ $product->i18nValue('title') }}</a>
                @endif

                @if (isset($defaultCategory))
                / <a href='{{ route('admin.catalog', ['category' => $defaultCategory]) }}'>...</a>
                / <a href='{{ route('admin.product.create', ['default_category' => $defaultCategory]) }}'>Nouveau produit</a>
                @endif

                @if (!isset($product) && !isset($defaultCategory))
                / <a href='{{ route('admin.product.create') }}'>Nouveau produit</a>
                @endif
            </div>
        </div>

        <div class="col-lg-12">
            @include('default.components.alerts.success')
            @include('default.components.alerts.errors')
        </div>

        <div class="col-lg-12 row mx-0 p-0">

            {{-- Left --}}
            <div class="col-lg-8">
                <h2 class="h4">Textes</h2>
                <div class="row bg-white p-3 mb-3 mx-0 border shadow-sm backoffice-card">
                    <div class="form-group col-lg-8">
                        <label for="title">Titre</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{isset($product) ? $product->i18nValue('title') : null}}">
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="code">Code</label>
                        <input type="text" class="form-control" name="code" id="code" aria-describedby="helpCode" value="{{isset($product) ? $product->code : null}}">
                        <small id="helpCode" class="form-text text-muted">Laissez vide si vous ne savez pas à quoi cela correspond 😉</small>
                    </div>
                    <div class="form-group col-12">
                        <label for="summary">Résumé</label>
                        <textarea class="form-control" name="summary" id="summary" rows=4>{{isset($product) ? $product->i18nValue('summary') : null}}</textarea>
                    </div>
                    <div class="form-group col-12">
                        <label for="description">Description</label>
                        <textarea class="form-control tag-in" name="description" id="description" rows=4>{{isset($product) ? $product->i18nValue('description') : null}}</textarea>
                    </div>
                    <div class="form-group col-12 mb-0">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="isVisible" id="isVisible" @if(isset($product) ? $product->isVisible : true) checked @endif> Le produit est visible
                            </label>
                        </div>
                    </div>
                </div>

                <h2 class="h4">Images</h2>
                <div class="col-12 row bg-white p-3 mx-0 border shadow-sm backoffice-card">
                    <p>Bientôt disponible</p>

                    <div id='product-images' class="dropzone-container col-12 px-0">
                        <div id="product-dropzone" class="dropzone">

                        </div>
                    </div>
                </div>
            </div>

            {{-- Right --}}
            <div class="col-lg-4">
                <h2 class="h4">Prix et stock</h2>
                <div class="row bg-white p-3 mb-3 mx-0 border shadow-sm backoffice-card">
                    <div class="form-group col-lg-6">
                        <label for="price">Prix</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" name="price" id="price" min=0.01 step=0.01 value="{{isset($product) ? $product->price : null}}">
                            <div class="input-group-append">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" name="stock" id="stock" min=0 step=1 value="{{isset($product) ? $product->stock : null}}">
                    </div>
                </div>

                <h2 class="h4">Catégories</h2>
                <div class="row bg-white p-3 mb-3 mx-0 border shadow-sm backoffice-card">
                    <div class="form-group col-lg-12">
                        <label for="categories">Catégories du produit</label>
                        <input type="text" class="form-control tag-input" name="categories" id="categories">
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="default_category">Catégorie par défaut</label>
                        <input type="text" class="form-control tag-input-default-category" name="default_category" id="default_category">
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@section('page.scripts')
    <script>
        let categories = [];

        @foreach(\App\Models\Category::where('isDeleted', 0)->get() as $category)
        categories.push({'id':"{{ $category->id }}", 'value':"{{ $category->i18nValue('title') }}"});
        @endforeach

        // The DOM element you wish to replace with Tagify
        var tagInput = document.querySelector('.tag-input');

        // initialize Tagify on the above input node reference
        let tags = new Tagify(tagInput, {
            whitelist: categories,
            enforceWhitelist: true,
            dropdown: {
                maxItems: Infinity,           // <- mixumum allowed rendered suggestions
                classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0,             // <- show suggestions on focus
                closeOnSelect: false,    // <- do not hide the suggestions dropdown once an item has been selected
                mapValueTo: 'value'
            }
        });

        @isset($product)
        tags.addTags({!! $product->categoriesForTagify !!});
        @endisset
    </script>

    <script>

        // The DOM element you wish to replace with Tagify
        var tagInput = document.querySelector('.tag-input-default-category');

        // initialize Tagify on the above input node reference
        let tagForDefaultCategory = new Tagify(tagInput, {
            maxTags: 1,
            whitelist: categories,
            enforceWhitelist: true,
            dropdown: {
                maxItems: Infinity,           // <- mixumum allowed rendered suggestions
                classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0,             // <- show suggestions on focus
                closeOnSelect: false,    // <- do not hide the suggestions dropdown once an item has been selected
                mapValueTo: 'value'
            }
        });

        @if(isset($product) && null !== $product->defaultCategoryForTagify)
        tagForDefaultCategory.addTags([{!! $product->defaultCategoryForTagify !!}]);
        @endif
    </script>

    <script>
        Dropzone.autoDiscover = false;
        let imagePath = '';
        let mockfiles = [];

        @isset($product) @foreach($product->images as $image)
        mockfiles.push({ name: "{{ $product->i18nValue('title') }}", size: {{ $image->size }}, path: "{{ $image->path }}" });
        @endforeach @endisset

        let productDropzone = $(".dropzone").dropzone({
            url: "{{ route('admin.images.upload') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            maxFilesize: 10,
            init: function () {
                mockfiles.forEach(function(mockfile) {
                    this.displayExistingFile(mockfile, mockfile.path);
                    $('#product-images').append('<input type="hidden" id="imagePaths" name="imagePaths[]" value="'+ mockfile.path +'">');
                }, this);
            },
            success: function (data, response) {
                imagePath = response.path;
                $('#product-images').append('<input type="hidden" id="imagePaths" name="imagePaths[]" value="'+ imagePath +'">');
            }
        });


    </script>
@endsection
