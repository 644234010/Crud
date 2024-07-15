@extends('layoutcar')

@section('title', 'KITTIPAT_CAR')

@section('content')
<div class="container mt-5">
    <h2 class="display-4 font-weight-bold text-primary">Car List</h2>
    <hr class="my-4">
    <div class="table-responsive" id="car-products-list">
        @include('car_products_list', ['car_products' => $car_products])
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#search-input').on('keyup', function() {
            var query = $(this).val();
            fetch_data(1, query);
        });

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            let query = $('#search-input').val();
            fetch_data(page, query);
        });

        function fetch_data(page, query) {
            $.ajax({
                url: "/search?page=" + page,
                method: "POST",
                data: {query: query, _token: "{{ csrf_token() }}"},
                success: function(data) {
                    $('#car-products-list').html(data);
                }
            });
        }
    });
</script>
@endsection
