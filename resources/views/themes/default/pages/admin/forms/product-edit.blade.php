<form action="{{ route('admin.product.update', ['product' => $product]) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" class="form-control" name="title" id="title" aria-describedby="helpTitle" value="{{ old('title', $product->title) }}">
        <small id="helpTitle" class="form-text text-muted">Nom du produit</small>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description" aria-describedby="helpDescription" rows="5">{{ old('description', str_replace('<br />', '', $product->description )) }}</textarea>
        <small id="helpDescription" class="form-text text-muted">Une description détaillée du produit</small>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <label for="price">Prix</label>
            <input type="number" class="form-control" name="price" id="price" aria-describedby="helpPrice" value="{{ old('price', $product->price) }}" min="0.01" step="0.01">
            <small id="helpPrice" class="form-text text-muted">Le prix de base du produit</small>
        </div>
        <div class="form-group col-md-6">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" name="stock" id="stock" aria-describedby="helpStock" value="{{ old('stock', $product->stock) }}" min="0" step="1">
            <small id="helpStock" class="form-text text-muted">La quantité disponible pour ce produit</small>
        </div>
    </div>

    <div class="form-group">
        <label for="category-select">Catégorie</label>
        <select id="category-select" class="custom-select" name="category">
            <option @if(0 === count($product->categories)) selected="true" @endif disabled="disabled">
                Veuillez choisir une catégorie</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if($product->categories->first() && $category->id === $product->categories->first()->id) selected="true" @endif>
                    {{ $category->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="isVisible" id="isVisible" value="isVisible" @if(old('isVisible', $product->isVisible)) checked=checked @endif>
                    Le produit est visible
            </label>
        </div>
    </div>

    <input type="hidden" name="lang" value="FR">

    <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>

<div class="mt-3 pt-3 border-top">
    <p>Images</p>

    <form action="{{ route('admin.product.images.add', ['product' => $product]) }}"
        class="dropzone border rounded bg-light p-3 d-flex flex-direction-column justify-content-center"
        id="images-upload" enctype="multipart/form-data" method="POST">
    @csrf
    </form>

    <div id="images-container" class="row mt-3">
        @foreach ($product->images as $image)
            <div class="col-lg-3 product-image">
                <img src="{{ asset($image->path) }}" alt="{{ $image->alt }}" title="{{ $image->title }}" class="w-100">
                <button class="btn btn-danger mt-2 delete-image" data-url="{{ route('admin.product.images.delete', ['product' => $product, 'image' => $image]) }}" role="button">
                    Supprimer</button>
            </div>
        @endforeach
    </div>
</div>

<script>
    let imagesContainer = $('#images-container');

    dropzone.options.imagesUpload = {
        paramName: "image", // The name that will be used to transfer the file
        maxFilesize: 10, // MB
        accept: function(file, done) {
            done();
        },
        init: function() {
            this.on("sending", function(file, xhr, formData) {
                // Will send the filesize along with the file as POST data.
                formData.append("filesize", file.size);
            });
            this.on("success", function (file, response) {
                console.log(file);
                console.log(response);
                location.reload();
            });
        }
    };

    $('.product-image .delete-image').on('click', function () {
        let url = $(this).data('url');

        deleteProductImage(url, $(this));
    });



    function deleteProductImage(url, element) {
        let token = $('meta[name="csrf-token"]').attr('content');

        fetch(url, {
            method: "POST",
            body: JSON.stringify({
                _method: 'DELETE'
            }),
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-Token': token,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then((resp) => resp.json())
        .then(function(data) {
            if (undefined !== data.error) {
                throw data.error
            }
            console.log(data);
            element.parent('.product-image').remove();
        })
        .catch(function(error) {
            console.error(error.message)
        });
    }
</script>
