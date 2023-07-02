@extends('layout')

@section('content')

    <div class="container-fluid">
        <h1> categories</h1>
        @can('create-categories')
        <a href="{{route('categories.create')}}" class="btn btn-primary mb-5 float-right"> create</a>
        @endcan
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Type</th>

                <th>status</th>
{{--                <th>image</th>--}}
                <th>actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
                    <td>{{$category->type}}</td>
                    <td>{{$category->status}}</td>
{{--                    <td><img src="'/admin/images/'{{ $category->image}} width:300px"></td>--}}


                    <td style="width: 180px;">
                        @can('update-categories')
                        <a href="{{route('categories.edit',$category)}}">
							<span class="btn  btn-outline-success btn-sm font-1 mx-1">
								<span class="fas fa-wrench "></span> تحكم
							</span>
                        </a>
                        @endcan
                            @can('delete-categories')


                            <form method="POST" action="{{route('categories.destroy',$category)}}"
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
{{--        <div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite"></div></div><div class="col-sm-12 col-md-7"> <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate"><ul class="pagination"> {!! $categories->links() !!}<li class="paginate_button page-item previous disabled" id="dataTable_previous"><a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="dataTable_next"><a href="#" aria-controls="dataTable" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div>--}}
      {!! $categories->links() !!};
    </div>
@endsection
