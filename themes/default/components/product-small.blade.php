<a class="product-small-container col-lg-2 text-center pb-3">
    <div class="product-small rounded transition noselect d-flex flex-column border">
        <img src="{{$product->firstImage ? $product->firstImage->path : null}}" alt="{{$product->i18nValue('title')}}" class="h-100 w-100 rounded-top bg-white">
        <p class="p-2 text-center">
            {{$product->i18nValue('title')}}
        </p>
        <p class="p-2 text-center">
            {{$product->formattedPrice}}
        </p>
    </div>
</a>