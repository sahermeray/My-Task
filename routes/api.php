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
    Route::get('/myProfile/{id}',[\App\Http\Controllers\api\userController::class,'myProfile']);
    Route::get('/getProducts/{id}',[\App\Http\Controllers\api\userController::class,'getMyProducts']);
    Route::post('/addProduct',[\App\Http\Controllers\api\userController::class,'addProduct']);
});

Route::group(['prefix' => 'admin','middleware' => ['auth:sanctum','isAdmin']], function () {
    Route::get('/products',[\App\Http\Controllers\api\adminController::class,'getProducts']);
    Route::post('/addProduct',[\App\Http\Controllers\api\adminController::class,'addProduct']);
    Route::get('/editProduct/{id}',[\App\Http\Controllers\api\adminController::class,'editProduct']);
    Route::post('/updateProduct/{id}',[\App\Http\Controllers\api\adminController::class,'updateProduct']);
    Route::get('/deleteProduct/{id}',[\App\Http\Controllers\api\adminController::class,'deleteProduct']);
    Route::get('/users',[\App\Http\Controllers\api\adminController::class,'getUsers']);
    Route::post('/addUser',[\App\Http\Controllers\api\adminController::class,'addUser']);
    Route::get('/deleteUser/{id}',[\App\Http\Controllers\api\adminController::class,'deleteUser']);
    Route::get('/editUser/{id}',[\App\Http\Controllers\api\adminController::class,'editUser']);
    Route::post('/updateUser/{id}',[\App\Http\Controllers\api\adminController::class,'updateUser']);
    Route::get('/getUserProducts/{id}',[\App\Http\Controllers\api\adminController::class,'getUserProducts']);
});


