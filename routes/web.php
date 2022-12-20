<?php

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
    return view('auth.register');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'user','middleware' => ['auth']], function () {
    Route::get('/myProfile/{id}',[\App\Http\Controllers\web\userController::class,'myProfile'])->name("show-user-profile");
    Route::get('/getProducts/{id}',[\App\Http\Controllers\web\userController::class,'getMyProducts'])->name("show-user-products");
    Route::get('/addProduct',[\App\Http\Controllers\web\userController::class,'addProductForm'])->name("user-get-add-product-form");
    Route::post('/addProduct',[\App\Http\Controllers\web\userController::class,'addProduct'])->name("add-product");
});

Route::group(['prefix' => 'admin','middleware' => ['auth','isAdmin']], function () {
    Route::get('/products',[\App\Http\Controllers\web\adminController::class,'getProducts'])->name("show-all-products");
    Route::get('/users',[\App\Http\Controllers\web\adminController::class,'getUsers'])->name("show-all-users");
    Route::get('/addProduct',[\App\Http\Controllers\web\adminController::class,'getAddProductForm'])->name("get-add-product-form");
    Route::post('/addProduct',[\App\Http\Controllers\web\adminController::class,'addProduct'])->name("admin-add-product");
    Route::get('/addUserWithEmail',[\App\Http\Controllers\web\adminController::class,'getAddUserWithEmailForm'])->name("get-add-user-with-email-form");
    Route::get('/addUserWithPhone',[\App\Http\Controllers\web\adminController::class,'getAddUserWithPhoneForm'])->name("get-add-user-with-phone-form");
    Route::get('/editProduct/{id}',[\App\Http\Controllers\web\adminController::class,'editProduct'])->name("edit-product");
    Route::get('/deleteProduct/{id}',[\App\Http\Controllers\web\adminController::class,'deleteProduct'])->name("delete-product");
    Route::post('/updateProduct/{id}',[\App\Http\Controllers\web\adminController::class,'updateProduct'])->name("update-product");
    Route::post('/addUserWithEmail',[\App\Http\Controllers\web\adminController::class,'addUserWithEmail'])->name("add-user-with-email");
    Route::post('/addUserWithPhone',[\App\Http\Controllers\web\adminController::class,'addUserWithPhone'])->name("add-user-with-phone");
    Route::get('/deleteUser/{id}',[\App\Http\Controllers\web\adminController::class,'deleteUser'])->name("delete-user");
    Route::get('/editUser/{id}',[\App\Http\Controllers\web\adminController::class,'editUser'])->name("edit-user");
    Route::post('/updateUserWithEmail/{id}',[\App\Http\Controllers\web\adminController::class,'updateUserWithEmail'])->name("update-user-with-email");
    Route::post('/updateUserWithPhone/{id}',[\App\Http\Controllers\web\adminController::class,'updateUserWithPhone'])->name("update-user-with-phone");
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/changePassword/{id}',[\App\Http\Controllers\ChangePasswordController::class,'changePassword'])->name("change-password");
    Route::get('/changePassword',[\App\Http\Controllers\ChangePasswordController::class,'getChangePasswordForm'])->name("get-change-password-form");
});

Route::get('/registerWithPhone',[\App\Http\Controllers\Auth\RegisterController::class,'getRegisterWithPhoneForm'])->name("get-register-with-phone-form");
Route::post('/registerWithPhone',[\App\Http\Controllers\Auth\RegisterController::class,'registerWithPhone'])->name("register-with-phone");
