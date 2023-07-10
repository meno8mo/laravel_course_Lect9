<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Role</th>
        <th>Email</th>
        <th>Phone</th>
        <th>status</th>
        <th>actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td><div >
                    @foreach($user->roles as $role)
                        <span class="mx-1"> {{$role->name}} </span>
                    @endforeach
                </div>

            </td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>
                @foreach($user->roles as $role )
                    <span class="mx-1"> {{$role->name}}</td>
            @endforeach
            </td>

            <td>{{$user->status}}</td>
            <td style="width: 180px;">
                {{--                        @can('update-users')--}}

                <a href="{{route('users.edit',$user)}}">
							<span class="btn  btn-outline-success btn-sm font-1 mx-1">
								<span class="fas fa-wrench "></span> تحكم
							</span>
                </a>
                {{--                        @endcan--}}
                @can('delete-users')

                    <form method="POST" action="{{route('users.destroy',$user)}}"
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
