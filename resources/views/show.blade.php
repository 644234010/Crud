@extends('layoutcar')

@section('title', 'Car Detail')

@section('content')
<div class="container mt-5">
    <h2 class="display-4 font-weight-bold text-primary">{{ $car->car_name }}</h2>
    <hr class="my-4">
    <div class="row">
        <div class="col-md-6">
            @if($car->car_image)
                <img src="{{ asset('storage/' . $car->car_image) }}" alt="{{ $car->car_name }}" class="img-fluid" width="400" height="auto">
            @endif
        </div>
        <div class="col-md-6">
            <h3>Details</h3>
            <p>{{ $car->car_detail }}</p>
            <h3>Price</h3>
            <p>{{ number_format($car->car_price) }}</p>
            <a href="{{ route('home') }}" id="homeButton" class="btn btn-primary">Back to Car List</a>

            
        </div>
    </div>
</div>
<script>
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
</script>
@endsection
