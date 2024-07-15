@extends('layoutwelcome')

@section('title', 'KITTIPAT_CAR')

@section('content')
    <h2 class="text-center mb-4">Car List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($car_products as $item)
                <tr>
                    <td><img src="img/01.jpg" alt="Product 1" class="img-fluid"  width="100%" height="50%"></td>
                    <td>{{ $item->car_name }}</td>
                    <td>{{ $item->car_detail }}</td>
                    <td>{{ $item->car_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$car_products->links()}}
@endsection

