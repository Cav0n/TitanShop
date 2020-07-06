<a class="product-small-container col-lg-2 text-center pb-3" href="{{route('product.show', ['product' => $product])}}">
    <div class="product-small rounded transition noselect d-flex flex-column border">
        <img src="{{$product->firstImage ? asset($product->firstImage->path) : asset('images/utils/question-mark.png')}}" alt="{{$product->i18nValue('title')}}" class="h-100 w-100 rounded-top bg-white">
        <p class="p-2 text-center text-dark">
            {{$product->i18nValue('title')}}
        </p>
        <p class="p-2 text-center text-dark">
            {{$product->formattedPrice}}
        </p>
    </div>
</a>