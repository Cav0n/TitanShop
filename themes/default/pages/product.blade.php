@extends('default.templates.public')

@section('page.content')
    <div class="row justify-content-center my-5">
        <div class="col-lg-4">
            <img src="{{$product->firstImage ? asset($product->firstImage->path) : asset('images/utils/question-mark.png')}}" alt="{{$product->i18nValue('title')}}" class="w-100">
        </div>
        <div class="col-lg-6">
            <h2>{{$product->i18nValue('title')}}</h2>
            <p>{{$product->i18nValue('description')}}</p>
            
            <div class="buying-container mt-3">
                <p class="h4">{{$product->formattedPrice}}</p>
                <a name="add-to-cart-btn" id="add-to-cart-btn" class="btn btn-primary rounded-0 shadow-none border mt-3" href="#" role="button">
                    Ajouter au panier</a>
            </div>
        </div>
    </div>
@endsection
