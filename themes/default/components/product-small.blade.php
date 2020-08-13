<a class="product-small-container col-6 col-lg-2 text-center pb-3" href="{{route('product.show', ['product' => $product])}}">
    <div class="product-small rounded transition noselect d-flex flex-column border h-100 @if($product->stock <= 0) no-stock @endif">
        <div class="image-container h-100">
            <img src="{{$product->firstImage ? asset($product->firstImage->path) : asset('images/utils/question-mark.png')}}" alt="{{$product->i18nValue('title')}}" class="w-100 h-100 cover rounded-top bg-white">
        </div>
        <p class="p-2 text-center text-dark d-flex flex-column justify-content-center">
            {{$product->i18nValue('title')}}
        </p>
        <p class="p-2 text-center bg-primary text-white">
            @if($product->isInPromo && $product->promoPrice !== null)
                <span class="crossed mr-2">{{$product->formattedPrice}}</span> <b>{{$product->formattedPromoPrice}}</b>
            @else
                <b>{{$product->formattedPrice}}</b>
            @endif

            @if($product->stock <= 0) - RUPTURE DE STOCK @endif
        </p>
    </div>
</a>
