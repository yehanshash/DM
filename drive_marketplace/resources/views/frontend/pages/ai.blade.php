@extends('frontend.layouts.master')
@section('title','Cart Page')
@section('main-content')
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="">AI Free</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->



<!-- Shopping Cart -->
<div class="shopping-cart section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mx-5 px-5">
                <!-- Shopping Summery -->
                <div class="card-details">
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-4 col-form-label" for="make">Brand:</label>
                        <div class="col-sm-8">
                            <select class="form-control selectCstm cstmfield cstmfield w-100" id="make" name="make">
                                <option selected>- Select Brand -</option>
                                <option>Audi</option>
                                <option>Austin</option>
                                <option>BMW</option>
                                <option>Chery</option>
                                <option>Chevrolet</option>
                                <option>Daewoo</option>
                                <option>Daihatsu</option>
                                <option>Datsun</option>
                                <option>DFSK</option>
                                <option>Fiat</option>
                                <option>Ford</option>
                                <option>Honda</option>
                                <option>Hyundai</option>
                                <option>Isuzu</option>
                                <option>Jaguar</option>
                                <option>Kia</option>
                                <option>Mahindra</option>
                                <option>Mazda</option>
                                <option>Mercedes Benz</option>
                                <option>Micro</option>
                                <option>Mitsubishi</option>
                                <option>Morris</option>
                                <option>Nissan</option>
                                <option>Opel</option>
                                <option>Perodua</option>
                                <option>Peugeot</option>
                                <option>Proton</option>
                                <option>Renault</option>
                                <option>Subaru</option>
                                <option>Suzuki</option>
                                <option>Tata</option>
                                <option>Toyota</option>
                                <option>Volkswagen</option>
                                <option>Volvo</option>
                                <option>Zotye</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-4 col-form-label" for="model">Model:</label>
                        <div class="col-sm-8">
                            <select class="form-control selectCstm cstmfield w-100" id="model" name="model">
                                <option selected>- Select Model -</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-4 col-form-label" for="model_year">Model Year:</label>
                        <div class="col-sm-8">
                            <select class="form-control selectCstm cstmfield w-100" id="model_year" name="model_year">
                                <option selected>- Select Year -</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-4 col-form-label" for="transmission">Transmission:</label>
                        <div class="col-sm-8">
                            <select class="form-control selectCstm cstmfield w-100" id="transmission" name="transmission">
                                <option selected value="Manual">Manual</option>
                                <option value="Automatic">Automatic</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-4 col-form-label" for="fuel_type">Fuel Type:</label>
                        <div class="col-sm-8">
                            <select class="form-control selectCstm cstmfield w-100" id="fuel_type" name="fuel_type">
                                <option selected value="Petrol">Petrol</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Hybrid">Hybrid</option>
                                <option value="Electric">Electric</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-4 col-form-label" for="engine_capacity">Engine Capacity (cc):</label>
                        <div class="col-sm-8">
                            <input class="form-control cstmfield w-100" id="engine_capacity" name="engine_capacity" required type="">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-4 col-form-label" for="mileage">Mileage (km):</label>
                        <div class="col-sm-8">
                            <input class="form-control cstmfield w-100" id="mileage" name="mileage" required type="">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <div class="col-sm-8 offset-sm-4">
                            <input class="btn btn-primary btn-block mt-4 mb-2" id="predictBtn" type="button" value="Predict price">
                        </div>
                    </div>
                </div>
                <!--/ End Ai input fields -->
            </div>
        </div>
        <div class="row col-12 ">
            <div class="col-md-3"></div>
            <div class="col-md-6 card mt-3 p-5 d-block" style="opacity:0.9;font-size:20px;">
                <strong>Predicted Price : <span id="predictedTxt"></span></strong>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>


<!-- Start Shop Newsletter  -->
@include('frontend.layouts.newsletter')
<!-- End Shop Newsletter -->

@endsection
@push('styles')
<style>
    li.shipping{
        display: inline-flex;
        width: 100%;
        font-size: 14px;
    }
    li.shipping .input-group-icon {
        width: 100%;
        margin-left: 10px;
    }
    .input-group-icon .icon {
        position: absolute;
        left: 20px;
        top: 0;
        line-height: 40px;
        z-index: 3;
    }
    .form-select {
        height: 30px;
        width: 100%;
    }
    .form-select .nice-select {
        border: none;
        border-radius: 0px;
        height: 40px;
        background: #f6f6f6 !important;
        padding-left: 45px;
        padding-right: 40px;
        width: 100%;
    }
    .list li{
        margin-bottom:0 !important;
    }
    .list li:hover{
        background:#F7941D !important;
        color:white !important;
    }
    .form-select .nice-select::after {
        top: 14px;
    }

    .cstmfield {
        border-radius: 25px;
        color: #333 !important;
        background: #F6F7FB;
        border-color: #c0c0c0;
    }
</style>
@endpush
@push('scripts')
<script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
<script>
		$(document).ready(function() { $("select.select2").select2(); });
  		$('select.nice-select').niceSelect();
	</script>
<script>
    $(document).ready(function(){
    $(document).on("click", "#predictBtn", function () {
        var make = $('#make').val();
        var model = $('#model').val();
        var model_year = $('#model_year').val();
        var transmission = $('#transmission').val();
        var fuel_type = $('#fuel_type').val();
        var engine_capacity = $('#engine_capacity').val();
        var mileage = $('#mileage').val();

        if (engine_capacity && mileage && make !== '' && model !== '' && model_year !== '') {
            $.ajax({
                type: 'POST',
                url: '/predict-price', // Laravel route for prediction
                data: {
                    make: make,
                    model: model,
                    model_year: model_year,
                    transmission: transmission,
                    fuel_type: fuel_type,
                    engine_capacity: engine_capacity,
                    mileage: mileage
                },
                success: function (data) {
                    // Update UI with predicted price
                    var price = numberWithCommas(Math.round(data.prediction_text[0]));
                    $("#predictedTxt").text("Rs." + price + ".00");
                },
                error: function(xhr, status, error) {
                    alert("Error occurred while predicting price.");
                }
            });
        } else {
            alert("Please fill the empty fields");
        }
    });
});

function numberWithCommas(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

</script>

@endpush
