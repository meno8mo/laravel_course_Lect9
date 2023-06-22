@extends('layout')

@section('content')
    <div class="container-fluid">
    <h6> create brand</h6>


    <form class="mx-5" method="post" action="{{route('brands.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" value="{{old('name')}}" name="name" class="form-control @error('name') is-invalid @enderror"
                   placeholder="Enter name" id="name">
        </div>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="image">image</label>

            <input type="file"   accept="image/*"
            value="{{old('image')}}" name="image" class="form-control @error('image') is-invalid @enderror"
                   id="image">
        </div>
        @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
@endsection
