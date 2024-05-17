$(document).ready(function(){

    $(document).on("change", "#make", function () {
        var make = $('#make').val();
        $('#model').empty().append($('<option>', { 
            value: '',
            text : '- Select Model -' 
        }));
        $('#model_year').empty().append($('<option>', { 
            value: '',
            text : '- Select Year -' 
        }));
        $.ajax({
            type: 'POST',
            url: '/selectCarModel',
            contentType: 'application/json',
            data: JSON.stringify({
                make: make
            }),
            success: function (result) {
                $('#model').empty().append($('<option>', { 
                    value: '',
                    text : '- Select Model -' 
                }));
                $.each(JSON.parse(result), function(index, value) {
                    $('#model').append($('<option>', { 
                        value: value,
                        text : value 
                    }));
                });
            }
        });

        $.ajax({
            type: 'POST',
            url: '/selectModelYear',
            contentType: 'application/json',
            data: JSON.stringify({
                make: make
            }),
            success: function (result) {
                $('#model_year').empty().append($('<option>', { 
                    value: '',
                    text : '- Select Year -' 
                }));
                $.each(JSON.parse(result), function(index, value) {
                    $('#model_year').append($('<option>', { 
                        value: value,
                        text : value 
                    }));
                });
            }
        });
    });

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
                url: '/predict',
                contentType: 'application/json',
                data: JSON.stringify({
                    make: make,
                    model: model,
                    model_year: model_year,
                    transmission: transmission,
                    fuel_type: fuel_type,
                    engine_capacity: engine_capacity,
                    mileage: mileage
                }),
                success: function (data) {
                    var price = numberWithCommas(Math.round(data.prediction_text[0]));
                    $("#predictedTxt").text("Rs." + price + ".00");
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
