@extends('default.templates.backoffice')

@section('page.content')
    <form class="row mx-0" action="{{isset($category) ? route('admin.category.update', ['category' => $category]) : route('admin.category.store')}}" method="POST">
        @csrf

        @if(isset($parent))
            <input type="hidden" name="parentId" value="{{$parent}}">
        @endif

        <div class="col-12 d-flex flex-column flex-lg-row justify-content-between">
            <h1>{{isset($category) ? $category->i18nValue('title') : "Catégorie"}}</h1>

            <div class="btn-container d-flex flex-column flex-lg-row">
                @isset($category)
                <a class="btn btn-primary mr-lg-2 mb-2" href="{{ route('category.show', ['category' => $category]) }}" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-eye"></i>
                    Voir la catégorie</a>
                @endisset
                <button type="submit" class="btn btn-success mb-2">
                    <i class="fas fa-save"></i>
                    Sauvegarder</button>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-between">
            <div class="admin-breadcrumb mb-3">
                <a href='{{ route('admin.homepage') }}'><i class="fa fa-home" aria-hidden="true"></i></a>
                / <a href='{{ route('admin.catalog') }}'>Catalogue</a>

                @if (isset($parent))
                / <a href='{{ route('admin.catalog', ['category' => $parent]) }}'>...</a>
                @endif

                @if (isset($category))
                / <a href='{{ route('admin.catalog', ['category' => $category]) }}'>
                    {{ $category->i18nValue('title') }}
                    <i class="fas fa-eye"></i>
                </a>
                @endif

                @if (!isset($category))
                / <a href='{{ route('admin.product.create') }}'>Nouvelle catégorie</a>
                @endif
            </div>
        </div>

        <div class="col-lg-12">
            @include('default.components.alerts.success')
            @include('default.components.alerts.errors')
        </div>

        <div class="col-lg-12">
            <h2 class="h4">Textes</h2>
            <div class="row bg-white p-3 mb-3 mx-0 border shadow-sm backoffice-card">
                <div class="form-group col-lg-8">
                    <label for="title">Titre</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{isset($category) ? $category->i18nValue('title') : null}}">
                </div>
                <div class="form-group col-lg-4">
                  <label for="code">Code</label>
                  <input type="text" class="form-control" name="code" id="code" aria-describedby="helpCode" value="{{isset($category) ? $category->code : null}}">
                  <small id="helpCode" class="form-text text-muted">Laissez vide si vous ne savez pas à quoi cela correspond 😉</small>
                </div>
                <div class="form-group col-12">
                    <label for="summary">Résumé</label>
                    <textarea class="form-control" name="summary" id="summary" rows=4>{{isset($category) ? $category->i18nValue('summary') : null}}</textarea>
                </div>
                <div class="form-group col-12">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" rows=4>{{isset($category) ? $category->i18nValue('description') : null}}</textarea>
                </div>
                <div class="form-group col-12 mb-0">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="isVisible" id="isVisible" @if(isset($category) ? $category->isVisible : true) checked @endif> La catégorie est visible
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


                <div id="images-list" class="row">
                    @isset($category) @foreach($category->images as $image)
                        <div class="col-6 col-sm-4 col-lg-3 mt-2">
                            <img src={{ $image->path }} class="w-100">
                        </div>
                        <input type="hidden" id="imagePaths" name="imagePaths[]" value="{{ $image->path }}">
                    @endforeach @endisset
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
        $(document).ready(function() {
            $('#upload-image').change(function() {
                Array.prototype.forEach.call(this.files, function (image) {
                    uploadImage(image);
                    readURL(image);
                });
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
    </script>
@endsection
