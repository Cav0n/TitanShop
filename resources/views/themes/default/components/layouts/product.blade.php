<div class="product-container d-flex flex-column bg-light border shadow-sm">
    <img
        class="img-fluid w-100"
        src="{{ asset($product->images->first()->path ?? null) }}"
        alt="{{ $product->images->first()->alt ?? $product->title }}"
        title="{{ $product->images->first()->alt ?? $product->title }}">

    <div class="p-3">

        <div class="product-title d-flex justify-content-center">
            <a href="{{ route('product.show', ['product' => $product]) }}" class="text-center">{{ $product->title }}</a>
        </div>

        <div class="d-flex justify-content-center">
            @if ($product->isInPromo)
            <p class="mb-0"><b>{{ $product->promoPriceFormatted }}</b></p>
            <p class="mb-0 ml-2"><del>{{ $product->priceFormatted }}</del></p>
            @else
            <p class="mb-0">{{ $product->priceFormatted }}</p>
            @endif
        </div>

    </div>

</div>
