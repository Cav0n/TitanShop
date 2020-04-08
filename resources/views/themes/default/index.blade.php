@extends('templates.default')

@section('page.title', App\Setting::valueOrNull('SHOP_NAME'))

@section('page.content')
    <div id="homepage" class="container-fluid d-flex flex-column justify-content-center my-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">

            </div>
        </div>
    </div>
@endsection
