<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\profileController;
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


//ROUTE TO CREATE A NEW USER (WE ARE CREATING AND INPUTING TO DATABASE=> we use STORE because of name convension since we are storing new user)
Route::post('store', [UserController::class, 'store'])->name('store_user');

Route::post('user_logout', [UserController::class, 'user_logout'])->name('user_logout');

Route::get('product_details/{id}', [UserController::class, 'product_details'])->name('product_details');

// route to add to cart
Route::post('/addToCart/{id}', [UserController::class, 'addToCart'])->name('addToCart');

// route to show cats
Route::get('/carts', [UserController::class, 'carts'])->name('carts');

// route to pay on delevery
route::get('/payOndelivery', [UserController::class, 'payOndelivery'])->name('payOndelivery');


// route to delete cart
route::get('/deleteCart/{id}', [UserController::class, 'deleteCart'])->name('deleteCart');

// route to proceed delivery
route::post('/proceedDelivery', [UserController::class, 'proceedDelivery'])->name('proceedDelivery');


// route to prduct Category
route::get('productCategory/{id}', [UserController::class, 'productCategory'])->name('productCategory');


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



     // route pemdimg orders
     route::get('/pendingOrders', [AdminController::class, 'pendingOrders'])->name('pendingOrders');

      // route approved orders
      route::get('/approvedOrder{id}', [AdminController::class, 'approvedOrder'])->name('approvedOrder');

    //   route to disapprove
      route::get('/disapprovedOrder{id}', [AdminController::class, 'disapprovedOrder'])->name('disapprovedOrder');


      route::get('/orderAproved', [AdminController::class, 'orderAproved'])->name('orderAproved');



      route::get('/cancledOrders', [AdminController::class, 'cancledOrders'])->name('cancledOrders');



});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// forget password

// forget password view
Route::get('forgetPassword', [ForgotPasswordController::class, 'forgetPassword'])->name('forgetPassword');

// submit password form
Route::post('forgotPassword', [ForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword.email');

// confirm code view
Route::get('confirmCode', [ForgotPasswordController::class, 'confirmCode'])->name('confirmCode.email');

// route to submit code form
Route::post('submitCode', [ForgotPasswordController::class, 'submitCode'])->name('submitCode');

// route to submit code form
Route::get('password_reset', [ForgotPasswordController::class, 'password_reset'])->name('password-reset');

// route to create new password
Route::post('createNewPassword', [ForgotPasswordController::class, 'createNewPassword'])->name('createNewPassword');

// route to resend code
Route::get('resend_code/{email}', [ForgotPasswordController::class, 'resend_code'])->name('resend_code');


Route::get('/account', [profileController::class, 'account'])->name('account');

// profile route
Route::get('/profile', [profileController::class, 'profile'])->name('profile');
Route::post('/saveProfile', [profileController::class, 'saveProfile'])->name('saveProfile');

// update password
Route::get('/update_password', [profileController::class, 'update_password'])->name('update_password');
Route::post('/update_user_password', [profileController::class, 'updateUserPassword'])->name('updateUserPassword');



