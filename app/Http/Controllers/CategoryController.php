<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Symfony\Component\HttpKernel\Profiler\Profile;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
//        $this->middleware(['role:admin','permission:access-brands|edit articles']);

        $this->middleware('permission:access-categories', ['only' => ['index','show']]);
        $this->middleware('permission:create-categories', ['only' => ['create','store']]);
        $this->middleware('permission:update-categories', ['only' => ['edit','store']]);
        $this->middleware('permission:delete-categories', ['only' => ['destroy']]);
    }
    public function index()
    {
     $categories=Category::paginate(20);
        return view('categories.index')->with('categories',$categories);
        //->with('i',(request()->input('page',1) -1 *5));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {

$request->validate(['name' => 'required',
  'image'=>'image|mimes:jpeg,PNG,svg,jpg'],);
 // $input=$request->all();
 //dd( $request->all());

        if($image=$request->file('image'))
        {
            $path='admin/images';
            $Profileimage=date('YmdHis').".". $image->getClientOriginalExtension();
            $image->move($path,$Profileimage);
            $request['image']="$Profileimage";
        }
     //   Category::create($input);
     Category::create(
        [
            'name'=>$request->name,
            "description"=>$request->description,
            "type"=>$request->type,
            "status"=>isset($request->status),
            "image"=>$request->image,
        ]
    );

       // return redirect()->back() ;
        return redirect(route('categories.index')) ->with('success','added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //

$request->validate(['name' => 'required',
'image'=>'image|mimes:jpeg,png,svg,jpg'  ],);
$input=$request->all();
      // Category::create(
      //     [
      //         'name'=>$request->name,
      //         "description"=>$request->description,
      //         "type"=>$request->type,
      //         "status"=>isset($request->status)
      //     ]
      // );
      if($image=$request->file('image'))
      {
          $path='admin/images';
          $Profileimage=date('YmdHis').".".$image->getClientOriginalExtension();
          $image->move($path,$Profileimage);
          $input['image']="$Profileimage";
      }
      else{
        unset(  $input['image']);

      }
      $category->update($input);


     // return redirect()->back() ;
      return redirect(route('categories.index')) ->with('success','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // if($category->id>4) {
            $category->delete();
            // Display an error toast with no title
            toastr()->success('تم الحذف بنجاح');

           // toastr()->error('لايمكن حذف هذا الصنف');
        return redirect()->back();
    }
}
