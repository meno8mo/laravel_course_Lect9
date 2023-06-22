@extends('layout')

@section('content')
    <div class="container-fluid">
    <h6> create category</h6>


    <form class="mx-5" method="post" action="{{route('categories.update',$category->id)}}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" value=  "{{$category->name}}" name="name" class="form-control @error('name') is-invalid @enderror"
                   placeholder="Enter name" id="name">
        </div>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="Description">Description:</label>
            <textarea  class="form-control @error('description') is-invalid @enderror" name="description" id="Description">{{$category->description}}</textarea>
        </div>
        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="image" name="image">
            <label class="custom-file-label" for="customFile">Choose an image</label>
          </div>

        <div class="">
            <input type="radio" class="" id="customRadio"
                   name="type"   @checked(old('type')=='New' || old('type')==null) value={{$category->type}}>
            <label class=" mr-5" for="customRadio">New</label>


            <input  type="radio" class=" " id="customRadio2"
                   name="type" @checked(old('type')=="Old")   value={{$category->type}}>>
            <label class="" for="customRadio2">Old</label>
        </div>
        <div class="form-group form-check">
            <label class="form-check-label">
                <input name="status"

                       @checked(old('status') )

                       class="form-check-input" type="checkbox" value={{$category->status}}>> Status
                {{old('name')}}
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
@endsection