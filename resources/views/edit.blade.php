@extends('layoutcar')
@section('title','Edit Information')
@section('content')

    <h2 class="text text-center py-2">Edit Information</h2>
    <form id="editCarForm" method="POST" action="{{ route('update', $home->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="car_name">Car Name</label>
            <input type="text" name="car_name" id="car_name" class="form-control" value="{{ $home->car_name }}">
        </div>
        @error('car_name')
            <div class="my-2">
                <span class="text text-danger">{{$message}}</span>
            </div>
        @enderror
        <div class="form-group">
            <label for="car_detail">Car Detail</label>
            <textarea name="car_detail" id="car_detail" cols="30" rows="5" class="form-control">{{ $home->car_detail }}</textarea>
        </div>
        @error('car_detail')
            <div class="my-2">
                <span class="text text-danger">{{$message}}</span>
            </div>
        @enderror
        <div class="form-group">
            <label for="car_price">Price</label>
            <input type="text" name="car_price" id="car_price" class="form-control" value="{{ $home->car_price }}">
        </div>
        @error('car_price')
            <div class="my-2">
                <span class="text text-danger">{{$message}}</span>
            </div>
        @enderror
        <div class="form-group">
            <label for="car_image">Car Image</label>
            <input type="file" name="car_image" id="car_image" class="form-control">
        </div>
        @if ($home->car_image)
            <div class="my-2">
                <img src="{{ asset('storage/' . $home->car_image) }}" alt="{{ $home->car_name }}" class="img-fluid" width="100%" height="50%">
            </div>
        @endif
        @error('car_image')
            <div class="my-2">
                <span class="text text-danger">{{$message}}</span>
            </div>
        @enderror
        <input type="submit" id="saveButton" value="Save" class="btn btn-primary my-3">
        <button id="homeButton" class="btn btn-success">Home</button>
    </form>

    <script>
        $(document).ready(function(){
            $('#saveButton').on('click', function(event){
                event.preventDefault();

                Swal.fire({
                    title: "Do you want to save the changes?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Save",
                    denyButtonText: `Don't save`
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#editCarForm').off('submit').submit();
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not edit", "", "info");
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
                            text: "Returning to home page.",
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
