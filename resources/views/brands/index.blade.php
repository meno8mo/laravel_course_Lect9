@extends('layout')

@section('content')

    <div class="container-fluid">
        <h1> brands</h1>
        @can('create-brands')
        <a href="{{route('brands.create')}}" class="btn btn-primary mb-5 float-right"> create</a>
        @endcan
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>

                <th>image</th>
                <th>actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($brands as $brand)
                <tr>
                    <td>{{$brand->name}}</td>

                    <td><img width="80x" src="{{url('storage/'.$brand->image)}}"></td>


                    <td style="width: 180px;">
                        @can('update-brands')
                        <a href="{{route('brands.edit',$brand)}}">

							<span class="btn  btn-outline-success btn-sm font-1 mx-1">
								<span class="fas fa-wrench "></span> تحكم
							</span>
                            @endcan
                        </a>
                            @can('delete-brands')
                        <form method="POST" action="{{route('brands.destroy',$brand)}}"
                              class="d-inline-block">
                            @csrf
                            @method("DELETE")
                            <button class="btn  btn-outline-danger btn-sm font-1 mx-1"
                                    onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');
                         if(result){}else{event.preventDefault()}">
                                <span class="fas fa-trash "></span> حذف
                            </button>

                        </form>
                            @endcan

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
      {!! $brands->links() !!};
    </div>
@endsection
