@extends('default.templates.minimal')

@section('page.content')
    <div class="row">
        <div id="left-side" class="col-lg-3">
            
        </div>
        <div id="right-side" class="col-lg-9 row justify-content-center">
            <form action="" class="col-lg-5 d-flex flex-column justify-content-center">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="firstname">Prénom</label>
                            <input type="text" class="form-control" name="firstname" id="firstname">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="lastname">Nom de famille</label>
                            <input type="text" class="form-control" name="lastname" id="lastname">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
