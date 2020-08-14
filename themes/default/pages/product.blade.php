@extends('default.templates.public')

@section('page.title', $product->i18nValue('title'))
@section('page.description', $product->i18nValue('summary'))

@section('og.type', 'product')
@section('og.image', $product->firstImage->url)
@section('og.additional')
    <meta property="product:price:amount" content="{{ $product->price }}">
    <meta property="product:price:currency" content="EUR">
@endsection

@section('page.content')
    @include('default.components.breadcrumb', ['breadcrumb' => $product->generateBreadcrumb()])

    @include('default.components.toast', [
        'class' => 'product-added-toast',
        'message' => $product->i18nValue('title') . ' a été ajouté à votre panier.'
    ])

    <div class="row justify-content-center mb-3">
        <div class="col-lg-6">
            <img id="big-image" src="{{$product->firstImage ? $product->firstImage->url : asset('images/utils/question-mark.png')}}" alt="{{$product->i18nValue('title')}}" title="{{$product->i18nValue('title')}}" class="w-100">
            <div id="thumbnails-container" class="row mt-2">
                @foreach ($product->images as $image)
                    <div class="thumbnail col-lg-3 col-6 col-sm-4">
                        <img src="{{ $image->url }}" alt="{{ $product->i18nValue('title') }}" title="{{$product->i18nValue('title')}}" class="w-100 thumbnail-image rounded {{ $loop->index === 0 ? "selected" : "" }}">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-6 mt-3 mt-lg-0">
            <h2>{{$product->i18nValue('title')}}</h2>
            <p>{!! nl2br($product->i18nValue('description')) !!}</p>

            <div class="buying-container mt-3">
                <p class="h4 mb-0">
                    @if($product->isInPromo && $product->promoPrice !== null)
                        <span class="crossed mr-2">{{$product->formattedPrice}}</span> <b>{{$product->formattedPromoPrice}}</b>
                    @else
                        <b>{{$product->formattedPrice}}</b>
                    @endif
                </p>
                @if($product->stock > 0)
                <button name="add-to-cart-btn" id="add-to-cart-btn" class="btn btn-primary shadow-none border mt-3" role="button">
                    Ajouter au panier</button>
                @else
                <button name="no-stock-btn" id="no-stock-btn" class="btn btn-dark shadow-none border mt-3 disabled" role="button" disabled>
                    Ce produit est en rupture de stock</button>
                @endif
            </div>
        </div>
    </div>
@endsection

@if($product->stock > 0)
@section('page.scripts')
    <script>
        $('#add-to-cart-btn').on('click', function () {
            $.ajax({
                url : '{{route("cart.items.add")}}',
                type : 'POST',
                dataType : 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {
                    product_id: '{{$product->id}}',
                    quantity: 1
                },
                success : function(data, status){
                    $('.toast-container').show();
                    $('.product-added-toast').toast('show');
                    $('.cart-total-quantity').text(data.quantity.total);
                },
                error : function(data, status, error){
                    console.error('product not added : ' + error);
                }
            });
        });
    </script>

    <script>
        $('.thumbnail-image').on('click', function () {
            $('#big-image').attr('src', $(this).attr('src'));
            $('.thumbnail-image').removeClass('selected');
            $(this).addClass('selected');
        });
    </script>
@endsection
@endif
