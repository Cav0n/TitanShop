@extends('default.templates.backoffice')

@section('page.content')
    <div class="row mx-0">
        <div class="col-12 p-0">
            <h1>Catalogue</h1>
        </div>

        <h2 class="h4">Catégories</h2>
        <div class="col-12 bg-white p-0 mb-3 border shadow-sm backoffice-card">
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
                    <tr>
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

        <h2 class="h4">Produits sans catégories</h2>
        <div class="col-12 bg-white p-0 border shadow-sm backoffice-card">
            @if(isset($products) && 0 < count($products))
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
                    @foreach ($products as $product)
                        <tr>
                            <td scope="row" class="text-center">{{$product->id}}</td>
                            <td></td>
                            <td>{{$product->i18nValue('title')}}</td>
                            <td class="text-center">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input visibility-checkbox" id="productVisibilityToggle-{{$loop->index}}" {{$product->isVisible ? "checked" : null}} data-type="product" data-id="{{$product->id}}">
                                    <label class="custom-control-label" for="productVisibilityToggle-{{$loop->index}}">
                                        {{$product->isVisible ? "Visible" : "Non visible"}}</label>
                                </div>
                            </td>
                            <td class="text-right">
                                <a name="edit-product" id="edit-product" class="btn btn-primary" href="#" role="button">Modifier</a>
                                <a name="delete-product" id="delete-product" class="btn btn-danger" href="#" role="button">Supprimer</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else

                <p>Aucun produit ne semble exister.</p>

            @endif
        </div>
    </div>
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
                    if (checkboxInput.is(':checked')) {
                        labelText = 'Visible';
                    } else {
                        labelText = 'Non visible';
                    }

                    checkboxInput.siblings('.custom-control-label').text(labelText);
                },
                error : function(data, status, error){
                    console.error('product not added : ' + error);
                }
            });
        });
    </script>
@endsection
