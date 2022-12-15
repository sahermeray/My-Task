<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\addProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class userController extends Controller
{


    public function myProfile($id){
        try {
            $user = DB::table('users')->find($id);
            return response([
                'status' => '200',
                'user' => $user
            ]);
        }catch (\Exception $ex){
            return response([
                'status' => '300',
                'message' => 'something went wrong'
            ]);
        }

    }


    public function getMyProducts($id)
    {
        try {
            $products = DB::table('products')->where('user_id', $id)->paginate(10);
            return response([
                'status' => '200',
                'products' => $products
            ]);
        } catch (\Exception $ex) {
            return response([
                'status' => '300',
                'message' => 'something went wrong'
            ]);
        }
    }



    public function addProduct(addProductRequest $request)
    {
        try {
            $image = $request->image;
            $image_name = time() . '.' . $image->getClientoriginalExtension();
            $image->move('products-image',$image_name);
            $product = Product::create([
                'description' => $request->description,
                'name' => $request->name,
                'image' => $image_name,
                'user_id' => Auth::id(),
            ]);
            $product->save();
            return response([
                'status' => '200',
                'message' => 'product has been added successfully'
            ]);
        } catch (\Exception $ex) {
            return response([
                'status' => '300',
                'message' => 'something went wrong'
            ]);
        }

    }


}
