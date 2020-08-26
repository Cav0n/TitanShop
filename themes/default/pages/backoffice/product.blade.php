@extends('default.templates.backoffice')

@section('page.content')
    <form class="row mx-0" action="{{isset($product) ? route('admin.product.update', ['product' => $product]) : route('admin.product.store')}}" method="POST">
        @csrf
        <input type="hidden" name="lang" value="fr">

        <div class="col-12 d-flex flex-column flex-lg-row justify-content-between">
            <h1>{{isset($product) ? $product->i18nValue('title') : "Nouveau produit"}}</h1>

            <div class="btn-container d-flex">
                @isset($product)
                <a class="btn btn-primary mr-2 my-lg-0" href="{{ route('product.show', ['product' => $product]) }}" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-eye"></i>
                    Voir le produit</a>
                @endisset
                <button type="submit" class="save-btn btn btn-success my-3 my-lg-0">
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
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{old('title', isset($product) ? $product->i18nValue('title') : null)}}">
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="code">Code</label>
                        <input type="text" name="code" id="code" aria-describedby="helpCode"
                            class="form-control @error('code') is-invalid @enderror"
                            value="{{old('code', isset($product) ? $product->code : null)}}">
                        <small id="helpCode" class="form-text text-muted">Laissez vide si vous ne savez pas à quoi cela correspond 😉</small>
                    </div>
                    <div class="form-group col-12">
                        <label for="summary">Résumé</label>
                        <textarea class="form-control" name="summary" id="summary" rows=4
                            class="form-control @error('summary') is-invalid @enderror"
                            >{{old('summary', isset($product) ? $product->i18nValue('summary') : null)}}</textarea>
                    </div>
                    <div class="form-group col-12">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows=4
                            class="form-control @error('description') is-invalid @enderror"
                            >{{old('description', isset($product) ? $product->i18nValue('description') : null)}}</textarea>
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
                @include('default.components.alerts.info', [
                    'message' => '
                        <i class="fas fa-info-circle mr-1"></i>
                        TitanShop vous recommande de toujours utiliser la même taille d\'image pour garder une boutique bien homogène.
                    '
                ])
                <div id="images-container" class="col-12 row bg-white p-3 mx-0 border shadow-sm backoffice-card">
                    <div class="col-12 px-0">
                        <label class="btn btn-primary" for="upload-image">
                            <span class="glyphicon glyphicon-folder-open px-2" aria-hidden="true">
                                <i class="fas fa-upload"></i>
                                Uploader de nouvelles images
                            </span>
                            <input type="file" id="upload-image" style="display:none" multiple>
                        </label>
                    </div>


                    <div id="images-list" class="row w-100">
                        @isset($product) @foreach($product->images as $image)
                            <div id="product-image-container-{{ $image->id }}" class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2">
                                <img src={{ $image->url }} class="w-100">
                                <div class="image-informations-container form-group">
                                    <label>Position de l'image</label>
                                    <input type="number" class="form-control" name="image-position['{{ $image->id }}']" min="0" max="{{ count($product->images) - 1 }}" value="{{ $image->pivot->position }}">
                                    <button type="button" class="btn btn-danger mt-2 w-100 delete-product-image" data-product_id="{{ $product->id }}" data-image_id="{{ $image->id }}">Supprimer</button>
                                </div>
                            </div>
                            <input type="hidden" id="imagePaths" name="imagePaths[]" value="{{ $image->path }}">
                        @endforeach @endisset
                    </div>
                </div>
            </div>

            {{-- Right --}}
            <div class="col-lg-4 mt-3 mt-lg-0">
                <h2 class="h4">Prix et stock</h2>
                <div class="row bg-white p-3 mb-3 mx-0 border shadow-sm backoffice-card">
                    <div class="form-group col-lg-6">
                        <label for="price">Prix</label>
                        <div class="input-group mb-3">
                            <input type="number" name="price" id="price" min=0.01 step=0.01
                                class="form-control @error('price') is-invalid @enderror"
                                value="{{old('price', isset($product) ? $product->price : null)}}">
                            <div class="input-group-append">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-6 d-flex flex-column justify-content-center">
                        <div class="form-check form-check-inline mt-3">
                            <label class="form-check-label noselect">
                                <input class="form-check-input" type="checkbox" name="isInPromo" id="isInPromo"
                                    {{ old('isInPromo') !== null ? 'checked=checked' : (isset($product) && $product->isInPromo ? 'checked=checked' : null) }}> En promo ?
                            </label>
                        </div>
                    </div>
                    <div id="promo-price-container" class="form-group col-lg-6 {{ !isset($product) || !$product->isInPromo ? 'd-none' : null }}">
                        <label for="promoPrice">Prix en promo</label>
                        <div class="input-group mb-3">
                            <input type="number" name="promoPrice" id="promoPrice" min=0.01 step=0.01
                                class="form-control @error('promoPrice') is-invalid @enderror"
                                value="{{old('promoPrice', isset($product) ? $product->promoPrice : null)}}">
                            <div class="input-group-append">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" id="stock" min=0 step=1
                            class="form-control @error('stock') is-invalid @enderror"
                            value="{{old('stock', isset($product) ? $product->stock : null)}}">
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

    @include('default.components.modals.info-modal', [
        'id'        => 'upload-loading-modal',
        'title'     => 'L\'image est en cours de téléversement sur le site.',
        'text'      => 'Veuillez patienter le temps que l\'image s\'upload svp...',
        'noFooter'  => true,
        'noClose'   => true
    ])
@endsection

@section('page.scripts')
    <script>
        if ($('#isInPromo').is(':checked')) {
            $('#promo-price-container').removeClass('d-none');
        }

        $('#isInPromo').on('change', function () {
            $('#promo-price-container').toggleClass('d-none');
        });
    </script>

    <script>
        let categories = [];

        @foreach(\App\Models\Category::where('isDeleted', 0)->get() as $category)
        categories.push({'id':"{{ $category->id }}", 'value':"{{ $category->i18nValue('title') }}"});
        @endforeach

        @isset($defaultCategory)
        categories.push($defaultCategory->tagify);
        @endisset

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
        $(document).ready(function() {
            $('#upload-image').change(function() {
                Array.prototype.forEach.call(this.files, function (image) {
                    uploadImage(image);
                    readURL(image);
                });
            });

            $('.delete-product-image').on('click', function () {
                deleteImage($(this).data('image_id'));
            });
        });

        function readURL(image) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#images-list').append(`
                    <div class="col-6 col-sm-4 col-lg-3 mt-2">
                        <img src="`+ e.target.result +`" class="w-100">
                    </div>
                `);
            }

            reader.readAsDataURL(image);
        }

        function uploadImage(image) {
            var formData = new FormData();
            formData.append('file', image);

            $.ajax({
                url: "{{ route('admin.images.upload') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('.save-btn').attr('disabled', 'disabled');
                    $('#upload-loading-modal').modal('show');
                },
                complete: function(data, response) {
                    $('.save-btn').removeAttr('disabled');
                    $('#upload-loading-modal').modal('hide');
                },
                success: function(data, response){
                    $('#images-list').append('<input type="hidden" id="imagePaths" name="imagePaths[]" value="'+ data.path +'">');
                }
            });
        }

        function deleteImage(imageId) {
            let imageContainer = $('#product-image-container-' + imageId);

            console.log(imageId);

            $.ajax({
                url: "{{ route('admin.image.delete') }}" + "?id=" + imageId,
                type: 'DELETE',
                complete: function(data, response) {
                    console.log(data);
                },
                success: function(data, response){
                    imageContainer.remove();
                }
            });
        }
    </script>
@endsection
