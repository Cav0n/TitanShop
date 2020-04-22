<div class="product-container d-flex flex-column">
    <img class="img-fluid w-100" src="" alt="{{ $product->title }}">

    <div class="p-3">
        <a href="">{{ $product->title }}</a>

        @if ($product->isInPromo)
        <p>{{ $product->promoPriceFormatted }}</p>
        <p><del>{{ $product->priceFormatted }}</del></p>
        @else
        <p>{{ $product->priceFormatted }}</p>
        @endif
    </div>

</div>
