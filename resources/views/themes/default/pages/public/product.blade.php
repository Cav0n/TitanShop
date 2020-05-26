@extends('templates.default')

@section('page.title', $product->title . ' - ' . App\Setting::valueOrNull('SHOP_NAME'))
@section('page.description', $product->description)

@section('page.og')
<meta property="og:type" content="website" />
<meta property="og:title" content="{{ $product->name }}" />
<meta property="og:description" content="{{ $product->description }}" />
<meta property="og:image" content="{{ $product->images()->count() ? asset($product->images()->first()->path) : null }}" />
<meta property="og:url" content="{{ route('product.show', ['product' => $product]) }}" />
<meta property="og:site_name" content="{{ App\Setting::valueOrNull('SHOP_NAME') }}" />
<meta property="product:price:amount" content="{{ $product->price }}" />
<meta property="product:price:currency" content="EUR" />
@endsection

@section('page.content')
    <div id="breadcrumb" class="mb-3">
        <div class="col-12 offset-lg-4 col-lg-8 p-0">
            {!! $product->breadcrumb !!}
        </div>
    </div>

    <div id="product-page" class="row mx-0">
        <div id="images-container" class="col-lg-4">
            <img id="big-image" class="img-fluid w-100"
                src="{{ asset($product->images->first()->path ?? null) }}"
                alt="{{ $product->images->first()->alt ?? $product->title }}"
                title="{{ $product->images->first()->alt ?? $product->title }}">

            <div id="thumbnails" class="row mt-3">
                @foreach ($product->images as $image)
                <div class="col-3">
                    <img class="thumbnail img-fluid w-100 @if($loop->first) border border-primary @endif"
                        src="{{ asset($image->path ?? null) }}"
                        alt="{{ $image->alt ?? $product->title }}"
                        title="{{ $image->alt ?? $product->title }}">
                </div>
                @endforeach
            </div>
        </div>
        <div id="texts-container" class="col-lg-8 p-3 mt-3 mt-lg-0 bg-white shadow-sm d-table">

            <div id="title-container">
                <h1>{{ $product->title }}</h1>
            </div>

            <div id="price-container" class="d-flex">
                @if ($product->isInPromo)
                    <p class="h5">{{ $product->promoPriceFormatted }}</p>
                    <p class="ml-2"><del>{{ $product->priceFormatted }}</del></p>
                @else
                    <p class="h5">{{ $product->priceFormatted }}</p>
                @endif
            </div>

            <div id="action-container" class="mt-2">
                <a class="btn btn-outline-primary" href="{{ route('cart.items.add', ['product_id' => $product->id]) }}" role="button">
                    Ajouter à mon panier</a>
            </div>

            <div id="description-container" class="mt-2">
                <p class='text-justify'>{!! $product->description !!}</p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.thumbnail').on('click', function() {
                let src = $(this).attr('src');
                $('.thumbnail').removeClass('border').removeClass('border-primary');
                $(this).addClass('border').addClass('border-primary');

                $("#big-image").attr('src', src);
            });
        });
    </script>
@endsection
