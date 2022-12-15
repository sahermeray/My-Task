<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout',[\App\Http\Controllers\api\AuthController::class,'logout']);
    Route::post('/changePassword',[\App\Http\Controllers\api\AuthController::class,'changePassword']);
});

Route::post('/register',[\App\Http\Controllers\api\AuthController::class,'register']);
Route::post('/login',[\App\Http\Controllers\api\AuthController::class,'login']);

Route::group(['prefix' => 'user','middleware' => ['auth:sanctum']], function () {
    Route::get('/myProfile/{id}',[\App\Http\Controllers\api\userController::class,'myProfile'])->name("show-user-profile");
    Route::get('/getProducts/{id}',[\App\Http\Controllers\api\userController::class,'getMyProducts'])->name("show-user-products");
    Route::post('/addProduct',[\App\Http\Controllers\api\userController::class,'addProduct'])->name("add-product");
});

Route::group(['prefix' => 'admin','middleware' => ['auth:sanctum','isAdmin']], function () {
    Route::get('/products',[\App\Http\Controllers\api\adminController::class,'getProducts'])->name("show-all-products");
    Route::post('/addProduct',[\App\Http\Controllers\api\adminController::class,'addProduct'])->name("admin-add-product");
    Route::get('/editProduct/{id}',[\App\Http\Controllers\api\adminController::class,'editProduct'])->name("edit-product");
    Route::post('/updateProduct/{id}',[\App\Http\Controllers\api\adminController::class,'updateProduct'])->name("update-product");
    Route::get('/deleteProduct/{id}',[\App\Http\Controllers\api\adminController::class,'deleteProduct'])->name("delete-product");
    Route::get('/users',[\App\Http\Controllers\api\adminController::class,'getUsers'])->name("show-all-users");
    Route::post('/addUser',[\App\Http\Controllers\api\adminController::class,'addUser'])->name("add-user-with-phone");
    Route::get('/deleteUser/{id}',[\App\Http\Controllers\api\adminController::class,'deleteUser'])->name("delete-user");
    Route::get('/editUser/{id}',[\App\Http\Controllers\api\adminController::class,'editUser'])->name("edit-user");
    Route::post('/updateUser/{id}',[\App\Http\Controllers\api\adminController::class,'updateUser'])->name("update-user");
    Route::get('/getUserProducts/{id}',[\App\Http\Controllers\api\adminController::class,'getUserProducts']);
});


