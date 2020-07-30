@extends('default.templates.backoffice')

@section('page.content')
    <div class="row mx-0">
        <div class="col-12 d-flex justify-content-between">
            <h1>Catalogue @if(isset($parentCategory)) - {{$parentCategory->i18nValue('title')}}
                <a class="btn btn-primary" href="{{ route('admin.category.edit', ['category' => $parentCategory]) }}" role="button"><i class="fas fa-edit"></i></a> @endif</h1>

            <div class="btn-container d-flex">
                <a class="btn btn-primary text-white mr-2" href="{{route('admin.category.create', ['parent' => $parentCategory])}}">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Créer une nouvelle @if(isset($parentCategory)) sous @endif catégorie</a>
                <a class="btn btn-primary text-white" href="{{route('admin.product.create', ['default_category' => $parentCategory])}}">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Créer un nouveau produit</a>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-between">
            <div class="admin-breadcrumb mb-3">
                <a href='{{ route('admin.homepage') }}'><i class="fa fa-home" aria-hidden="true"></i></a>
                / <a href='{{ route('admin.catalog') }}'>Catalogue</a>

                @if (isset ($parentCategory) && null !== $parentCategory->parent)
                / <a href='{{ route('admin.catalog', ['category' => $parentCategory->parent]) }}'>{{ $parentCategory->parent->i18nValue('title') }}</a>
                @endif

                @if (isset($parentCategory))
                / <a href='{{ route('admin.catalog', ['category' => $parentCategory]) }}'>{{ $parentCategory->i18nValue('title') }}</a>
                @endif
            </div>
        </div>

        <div class="col-lg-12">
            <h2 class="h4">{{ isset($parentCategory) ? "Sous catégories" : "Catégories" }}</h2>
            <div class="bg-white p-0 mb-3 border shadow-sm backoffice-card">
                @if(isset($categories) && 0 < count($categories))
                <table class="table">
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
                        <tr @if(! $category->isVisible) class="opacity-50" @endif>
                            <td scope="row" class="text-center">{{$category->id}}</td>
                            <td></td>
                            <td>{{$category->i18nValue('title')}}</td>
                            <td class="text-center">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input visibility-checkbox" id="categoryVisibilityToggle-{{$loop->index}}" {{$category->isVisible ? "checked" : null}} data-type="category" data-id="{{$category->id}}">
                                    <label class="custom-control-label" for="categoryVisibilityToggle-{{$loop->index}}">
                                        {{$category->isVisible ? "Visible" : "Non visible"}}</label>
                                </div>
                            </td>
                            <td class="text-right">
                                <a class="btn btn-primary" href="{{route('admin.catalog', ['category' => $category])}}">
                                    <i class="fas fa-angle-right"></i>
                                    Parcourir</a>
                                <a id="edit-category" class="btn btn-primary" href="{{route('admin.category.edit', ['category' => $category])}}">
                                    <i class="fas fa-edit"></i>
                                    Modifier</a>
                                <button name="delete-category" class="btn btn-danger delete-item" role="button"
                                        data-id="{{$category->id}}"
                                        data-type="category"
                                        data-title="Suppression de {{$category->i18nValue('title')}}"
                                        data-text="Êtes-vous certain de vouloir supprimer <b>{{$category->i18nValue('title')}}</b> ?">
                                    <i class="fa fa-trash"></i>
                                    Supprimer</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else

                <p class="p-3 text-center">Aucun catégorie ne semble exister.</p>

                @endif
            </div>
        </div>

        <div class="col-lg-12">
            <h2 class="h4">{{ isset($parentCategory) ? "Produits" : "Produits sans catégorie" }}</h2>
            <div class="col-12 bg-white p-0 border shadow-sm backoffice-card">
                @if(isset($products) && 0 < count($products))
                <table class="table">
                    <thead class="thead-default">
                        <tr>
                            <th class="text-center">ID</th>
                            <th></th>
                            <th>Titre</th>
                            <th>Prix</th>
                            <th>Stock</th>
                            <th class="text-center">Visible</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr @if(! $product->isVisible) class="opacity-50" @endif>
                            <td scope="row" class="text-center">{{$product->id}}</td>
                            <td></td>
                            <td>{{$product->i18nValue('title')}}</td>
                            <td>{{$product->formattedPrice}}</td>
                            <td>{{$product->stock}}</td>
                            <td class="text-center">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input visibility-checkbox" id="productVisibilityToggle-{{$loop->index}}" {{$product->isVisible ? "checked" : null}} data-type="product" data-id="{{$product->id}}">
                                    <label class="custom-control-label" for="productVisibilityToggle-{{$loop->index}}">
                                        {{$product->isVisible ? "Visible" : "Non visible"}}</label>
                                </div>
                            </td>
                            <td class="text-right">
                                <a id="edit-product" class="btn btn-primary" href="{{route('admin.product.edit', ['product' => $product])}}">
                                    <i class="fas fa-edit"></i>
                                    Modifier</a>
                                <button name="delete-product" class="btn btn-danger delete-item" role="button"
                                        data-id="{{$product->id}}"
                                        data-type="product"
                                        data-title="Suppression de {{$product->i18nValue('title')}}"
                                        data-text="Êtes-vous certain de vouloir supprimer <b>{{$product->i18nValue('title')}}</b> ?">
                                    <i class="fa fa-trash"></i>
                                    Supprimer</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else

                <p class="p-3 text-center">Aucun produit ne semble exister.</p>

                @endif
            </div>
        </div>
    </div>

    @include('default.components.modals.danger-modal', [
        'id' => 'delete-item-modal',
        'title' => 'Test',
        'text' => 'Ceci est un test'
    ])
@endsection

@section('page.scripts')
    <script>
        let visibilityCheckbox = $('.visibility-checkbox');

        visibilityCheckbox.on('change', function () {
            let checkboxInput = $(this);

            $.ajax({
                url : checkboxInput.data('type') === 'product' ? "{{route("admin.toggle-visibility.product")}}" : "{{route('admin.toggle-visibility.category')}}",
                type : 'POST',
                dataType : 'json',
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {
                    id: checkboxInput.data('id')
                },
                beforeSend : function(xhr) {
                    checkboxInput.siblings('.custom-control-label').text('Chargement en cours...');
                },
                success : function(data, status){
                    let labelText = '';
                    let className = '';

                    if (data.visible !== undefined && data.visible === true) {
                        labelText = 'Visible';
                        checkboxInput.closest('tr').removeClass('opacity-50');
                    } else {
                        labelText = 'Non visible';
                        checkboxInput.closest('tr').addClass('opacity-50');
                    }

                    checkboxInput.siblings('.custom-control-label').text(labelText);
                },
                error : function(data, status, error){
                    console.error('Visibility can\'t be updated : ' + error);
                }
            });
        });
    </script>

    <script>
        let itemId = "";
        let itemType = "";
        let deletionRoutes = {
            'product': "{{route('admin.product.delete')}}",
            'category': "{{route('admin.category.delete')}}"
        }

        $('.delete-item').on('click', function () {
            itemId = $(this).data('id');
            itemType = $(this).data('type');

            $('#delete-item-modal .modal-title').html($(this).data('title'));
            $('#delete-item-modal .modal-body').html($(this).data('text'));
            $('#delete-item-modal').modal('show');
        });

        $('#delete-item-modal .validate-btn').on('click', function () {
            if ("" === itemId || "" === itemType) {
                console.error('I don\'t know what is the item to delete...');
                return;
            }

            $.ajax({
                url : deletionRoutes[itemType],
                type : 'DELETE',
                dataType : 'json',
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {
                    id: itemId
                },
                beforeSend : function(xhr) {
                    console.log('Sending deletion request...')
                },
                success : function(data, status){
                    console.log(data);
                    itemId = "";
                    itemType = "";
                    location.reload();
                },
                error : function(data, status, error){
                    console.error('Item can\'t be deleted : ' + error);
                }
            });
        });
    </script>
@endsection
