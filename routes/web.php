<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::get('/signup', function () {
    return view('signup');
});

Route::post('user_logout', [UserController::class, 'user_logout'])->name('user_logout');

//ROUTE TO CREATE A NEW USER (WE ARE CREATING AND INPUTING TO DATABASE=> we use STORE because of name convension since we are storing new user)
Route::post('store', [UserController::class, 'store'])->name('store_user');


//ROUTE FOR THE ADMIN DASHBOARD (ALL ADMIN AND SUBADMIN MUST BE ENCLOSE WITHIN THIS REGION)
Route::middleware(['auth', 'isAdmin'])->group(function(){
    Route::get('admin/dashboard', [AdminController::class, 'admin_dashboard'])->name('admin_dashboard');


    //ROUTE FOR OUR CATEGORY
    Route::get('admin/category', [AdminController::class, 'category'])->name('category');


    //ADDING NEW CATEGORY
    Route::post('add_category', [AdminController::class, 'add_category'])->name('add_category');

    //delete category
    route::get('/deleteCategory/{id}', [AdminController::class, 'deleteCategory'])->name('deleteCategory');

    // logout admin dashbord
    Route::post('admin_logout', [AdminController::class, 'admin_logout'])->name('admin_logout');


    // addmin create products
    Route::get('admin/createProduct', [AdminController::class, 'createProduct'])->name('createProduct');


    Route::post('addProduct', [AdminController::class, 'addProduct'])->name('addProduct');

    Route::get('admin/products', [AdminController::class, 'products'])->name('products');

    //route for delelting products
    route::get('/deleteProduct/{id}', [AdminController::class, 'deleteProduct'])->name('deleteProduct');


    // route for editing products
    route::get('/editProduct/{id}', [AdminController::class, 'editProduct'])->name('editProduct');


    // route to update products
    route::post('/updateProduct/{id}', [AdminController::class, 'updateProduct'])->name('updateProduct');


    // user list route
    route::get('admin/userList', [AdminController::class, 'userList'])->name('userList');


     //route for delelting users
     route::get('/deleteUser/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
