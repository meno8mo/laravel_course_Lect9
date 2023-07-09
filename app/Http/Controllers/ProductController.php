<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
//        $this->middleware(['role:admin','permission:access-brands|edit articles']);

        $this->middleware('permission:access-products', ['only' => ['index','show']]);
        $this->middleware('permission:create-products', ['only' => ['create','store']]);
        $this->middleware('permission:update-products', ['only' => ['edit','store']]);
        $this->middleware('permission:delete-products', ['only' => ['destroy']]);
    }
    public function restore($id)
    {
        Product::onlyTrashed()->
            where('id',$id)->restore();
        toastr()->success('تم  بنجاح');
        return redirect(route('products.index'));
    }
    public function forceDelete($id)
    {
        Product::onlyTrashed()->
        where('id',$id)->forceDelete();
        toastr()->success('تم  بنجاح');
        return redirect(route('products.trashed'));
    }
   public function deleted_index()
    {
        $products = Product::onlyTrashed()->paginate(5);
        return view('products.index')
            ->with('deleted',1)
            ->with('products', $products)
         ;

}

    public function index()
    {
//        $not=auth()->user()->notifications;
//        return dd($not);
        $products = Product::paginate(25);
        return view('products.index')
            ->with('deleted',0)
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.create')
            ->with('categories', $categories)
            ->with('brands', $brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
     //   if ($request->id > 0)
//        $product = Product::findOrFail($request->id);
//        $bath = "";
//        if ($request->id > 0) {
//            $bath = $product->image;
//        }
//        if ($request->hasFile('image'))
            $bath = $request->file('image')->store('products');


        $product = Product::Create(
//            [
//                'id' => $request->id,
//                'name' => $request->name
//            ]
             [
            'name' => $request->name,
            'description' => $request->description,
            'image' => $bath,
            'brand_id' => $request->brand_id,
            'price' => $request->price,
            'status' => isset($request->status),
         //  'deleted_by' => $request?->deleted_by,

        ]);

//        $product->categories()->sync($request->categories);
//        if ($request->id > 0) {
            toastr()->success('تم الاضافة بنجاح');
//        }
//        else
//            toastr()->success('تم التعديل بنجاح');

        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.edit')
            ->with('categories', $categories)
            ->with('brands', $brands)
            ->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
        $bath=$product->image;
        if($request->hasFile('image'))
        {
            $bath=$request->file('image')->store('brands');
            Storage::delete($product->image);

        }
        $product->update(
            [
                'name' => $request->name,
                'description' => $request->description,
                'image' => $bath,
                'brand_id' => $request->brand_id,
                'price' => $request->price,
                'status' => isset($request->status)

            ]
        );
        toastr()->success('تم  بنجاح');
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::delete($product->image);

        $product->delete();
        $product->deleted_by=auth()->id();
        $product->save();


        toastr()->success('تم الحذف بنجاح');
        return redirect(route('products.index'));
    }
}
