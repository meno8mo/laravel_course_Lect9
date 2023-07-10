<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Models\Product;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
      //  return view('posts.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/',[PostController::class,'index'])
    ->name('posts');

Route::get('/carts',[PostController::class,'carts']);

Route::resource('categories',
    CategoryController::class);

    Route::resource('brands',
    BrandController::class);
    Route::get('products/trashed',
        [ProductController::class,'deleted_index'])->name('products.trashed');

    Route::get('products/restore/{id}',
        [ProductController::class,'restore'])->name('products.restore');
    Route::delete('products/forceDelete/{id}',
        [ProductController::class,'forceDelete'])->name('products.forceDelete');
    Route::resource('products',
        ProductController::class);
    Route::resource('roles',
        RoleController::class);
    Route::get('users/export/', [UserController::class, 'export'])->name('users.export');
    Route::post('users/import/', [UserController::class, 'import'])->name('users.import');

    Route::resource('users',
        UserController::class);

    Route::get('/changelang/{lang}',function(string $locale)
    {
        if(!in_array($locale,['en','ar']))
        {
            abort(400);
        }
        \app()->setlocale($locale);
        session()->put('locale',$locale);
        return redirect()->back();

    })->name("changelang");
});



require __DIR__.'/auth.php';
