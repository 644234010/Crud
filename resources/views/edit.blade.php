@extends('layoutcar')
@section('title','Edit Information')
@section('content')

    <h2 class="text text-center py-2">Edit Information</h2>
    <form method="POST" action="{{ route('update', $home->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="car_name">Car Name</label>
            <input type="text" name="car_name" class="form-control" value="{{ $home->car_name }}">
        </div>
        @error('car_name')
            <div class="my-2">
                <span class="text text-danger">{{$message}}</span>
            </div>
        @enderror
        <div class="form-group">
            <label for="car_detail">Car Detail</label>
            <textarea name="car_detail" cols="30" rows="5" class="form-control">{{ $home->car_detail }}</textarea>
        </div>
        @error('car_detail')
            <div class="my-2">
                <span class="text text-danger">{{$message}}</span>
            </div>
        @enderror
        <div class="form-group">
            <label for="car_price">Price</label>
            <input type="text" name="car_price" class="form-control" value="{{ $home->car_price }}">
        </div>
        @error('car_price')
            <div class="my-2">
                <span class="text text-danger">{{$message}}</span>
            </div>
        @enderror
        <div class="form-group">
            <label for="car_image">Car Image</label>
            <input type="file" name="car_image" class="form-control">
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
        <input type="submit" value="Update" class="btn btn-primary my-3">
        <a href="/home" class="btn btn-success">Home</a>
    </form>
@endsection
