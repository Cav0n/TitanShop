<div class="mt-3 pt-3 border-top">
    <p>Images</p>

    <form action="{{ route('admin.product.images.add', ['product' => $product]) }}"
        class="dropzone border rounded bg-light p-3 d-flex flex-direction-column justify-content-center"
        id="images-upload" enctype="multipart/form-data" method="POST">
    @csrf
    </form>

    <ul id="images-container" class="row mt-3 list-unstyled sortable w-100 px-3">
        @foreach ($product->images as $image)
            <li class="col-lg-3 col-xl-2 product-image">
                <div class="shadow-sm border bg-white">
                    <img src="{{ asset($image->path) }}" alt="{{ $image->alt }}" title="{{ $image->title }}" class="w-100">
                    <div class="d-flex p-2">
                        <button class="btn btn-danger delete-image" data-url="{{ route('admin.product.images.delete', ['product' => $product, 'image' => $image]) }}" role="button">
                            Supprimer</button>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
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

    $( function() {
        $( ".sortable" ).sortable({
            tolerance: "pointer",
            update: function( event, ui ) {
                console.log('yes');
            }
        });
        $( ".sortable" ).disableSelection();
    } );
</script>

