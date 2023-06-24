<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
//use App\Http\Controllers\Hash;
use Illuminate\Support\Facades\Storage;





class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users=User::paginate(20);
        return view('users.index',compact( 'users'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {
        $roles = Role::all();
        return view("users.create", compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $bath = $request->file('image')->store('users');

        $request->validate([
            'roles' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
            "image" => [$request->id > 0 ? "nullable" : "required", "image", "max:51120"],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->id],

        ]);



        $user = User::Create(
//            [
//                'id' => $request->id,
//            ]
             [
            'name' => $request->name,
            'email' => $request->email,
            'image' => $bath,
            'phone' => $request->phone,
          'password' => Hash::make($request->password),
                // 'password' =>$request->password,

                 'status' => isset($request->status)
        ]);

        $user->assignRole($request->roles);
      //  if ($request->id > 0)
            toastr()->success('تم الاضافة بنجاح');
//        else
//            toastr()->success('تم التعديل بنجاح');
        return redirect(route('users.index'));


        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //

        $roles = Role::all();
        return view("users.edit")->with('user',$user)->with('roles',$roles);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
        $bath=$user->image;
        if($request->hasFile('image'))
        {
            $bath=$request->file('image')->store('brands');
            if($user->image!=null)
            Storage::delete($user->image);

        }
        $user->update(
//            [
//                'id' => $request->id,
//            ]
            [
                'name' => $request->name,
                'email' => $request->email,
                'image' => $bath,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'status' => isset($request->status)
            ]);
        toastr()->success('تم التعديل بنجاح');
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        // Display an error toast with no title
        toastr()->success('تم الحذف بنجاح');

        // toastr()->error('لايمكن حذف هذا الصنف');
        return redirect()->back();
    }
}
