@extends('layoutcar')
@section('title', 'Add Information')
@section('content')

<h2 class="text-center py-2">Add Information</h2>

<input type="hidden" id="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <label for="car_name">Car Name</label>
    <input type="text" name="car_name" id="car_name" class="form-control" value="{{ old('car_name') }}">
</div>
<div class="my-2 text-danger" id="error_car_name"></div>

<div class="form-group">
    <label for="car_detail">Car Detail</label>
    <textarea name="car_detail" id="car_detail" cols="30" rows="5" class="form-control">{{ old('car_detail') }}</textarea>
</div>
<div class="my-2 text-danger" id="error_car_detail"></div>

<div class="form-group">
    <label for="car_price">Price</label>
    <input type="text" name="car_price" id="car_price" class="form-control" value="{{ old('car_price') }}">
</div>
<div class="my-2 text-danger" id="error_car_price"></div>

<div class="form-group">
    <label for="car_image">Car Image</label>
    <input type="file" name="car_image" id="car_image" class="form-control">
</div>
<div class="my-2 text-danger" id="error_car_image"></div>

<input type="submit" id="carForm" value="Save" class="btn btn-primary my-3">
<button id="homeButton" class="btn btn-success">Home</button>

<script>
    $(document).ready(function(){
        $('#carForm').on('click', function(event){
            event.preventDefault();

            Swal.fire({
                title: "Do you want to add information?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Save",
                denyButtonText: `Don't save`
            }).then((result) => {
                if (result.isConfirmed) {
                    var car_name = $('#car_name').val();
                    var car_detail = $('#car_detail').val();
                    var car_price = $('#car_price').val();
                    var car_image = $('#car_image')[0].files[0];
                    var token = $('#_token').val();

                    var formData = new FormData();
                    formData.append('car_name', car_name);
                    formData.append('car_detail', car_detail);
                    formData.append('car_price', car_price);
                    formData.append('car_image', car_image);
                    formData.append('_token', token);

                    $.ajax({
                        url: "{{ route('insert') }}",
                        method: "POST",
                        data: formData,
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data){
                            if(data.success){
                                Swal.fire("Saved!", "", "success");
                                // Reset the form
                                $('#car_name').val('');
                                $('#car_detail').val('');
                                $('#car_price').val('');
                                $('#car_image').val('');
                                $('.text-danger').text('');
                            }
                        },
                        error: function(response){
                            if(response.responseJSON.errors){
                                $('#error_car_name').text(response.responseJSON.errors.car_name);
                                $('#error_car_detail').text(response.responseJSON.errors.car_detail);
                                $('#error_car_price').text(response.responseJSON.errors.car_price);
                                $('#error_car_image').text(response.responseJSON.errors.car_image);
                            }
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        });

        $('#homeButton').on('click', function(event){
            event.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to return to the home page?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Home!",
                        text: "success!!",
                        icon: "success"
                    }).then(() => {
                        window.location.href = "{{ route('home') }}";
                    });
                }
            });
        });
    });
</script>

@endsection
