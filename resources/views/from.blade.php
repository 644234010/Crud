@extends('layoutcar')
@section('title', 'Add Information')
@section('content')

<h2 class="text text-center py-2">Add Information</h2>
<form id="carForm" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="car_name">Car Name</label>
        <input type="text" name="car_name" class="form-control" value="{{ old('car_name') }}">
    </div>
    <div class="my-2" id="error_car_name"></div>

    <div class="form-group">
        <label for="car_detail">Car Detail</label>
        <textarea name="car_detail" cols="30" rows="5" class="form-control">{{ old('car_detail') }}</textarea>
    </div>
    <div class="my-2" id="error_car_detail"></div>

    <div class="form-group">
        <label for="car_price">Price</label>
        <input type="text" name="car_price" class="form-control" value="{{ old('car_price') }}">
    </div>
    <div class="my-2" id="error_car_price"></div>

    <div class="form-group">
        <label for="car_image">Car Image</label>
        <input type="file" name="car_image" class="form-control">
    </div>
    <div class="my-2" id="error_car_image"></div>

    <input type="submit" value="Save" class="btn btn-primary my-3">
    <a href="{{ route('home') }}" class="btn btn-success">Home</a>
</form>

<script>
    $(document).ready(function(){
        $('#carForm').on('submit', function(event){
            event.preventDefault();
            var formData = new FormData(this);

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
                        alert(data.message);
                        $('#carForm')[0].reset();
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
        });
    });
</script>

@endsection
