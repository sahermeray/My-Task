<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\addProductRequest;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\AddUserWithEmailRequest;
use App\Http\Requests\AddUserWithPhoneRequest;
use App\Http\Requests\AdminAddProductRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserWithEmailRequest;
use App\Http\Requests\UpdateUserWithPhoneRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    public function getUsers(){
        try {
            $users = DB::table('users')->paginate(10);
            return response([
                'status' => '200',
                'users' => $users
            ]);
        }catch (\Exception $ex){
            return response([
                'status' => '300',
                'message' => 'something went wrong'
            ]);
        }
    }

    public function addUser(AddUserRequest $request){
        try {
            if ($request->has('email')) {
                $user = User::create([
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name'),
                    'email' => $request->get('email'),
                    'password' => Hash::make($request->get('password')),
                ]);
            } else {
                $user = User::create([
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name'),
                    'phone' => $request->get('phone'),
                    'password' => Hash::make($request->get('password')),
                ]);
            }
            $user->save();
            return response([
                'status' => '200',
                'message' => 'user created successfully'
            ]);
          }catch (\Exception $ex){
            return response([
                'status' => '300',
                'message' => 'something went wrong'
            ]);
          }

    }

    public function editUser($id){
        try {
            $user = User::find($id);
            if($user){
                return response([
                    'status' => '200',
                    'user' => $user
                ]);
            }
        }catch (\Exception $ex){
            return response([
                'status' => '300',
                'message' => 'something went wrong'
            ]);
        }
    }


    public function updateUser(UpdateUserRequest $request,$id){
        try {
            $user = User::find($id);
                if($user){
                    $user->update([
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                    ]);
                return response([
                    'status' => '200',
                    'message' => 'user updated successfully'
                ]);
            }
        }catch (\Exception $ex){
            return response([
                'status' => '300',
                'message' => 'something went wrong'
            ]);
        }
    }


    public function deleteUser($id){
        try{
            $user = User::find($id);
            $user->delete();
            return response([
                'status' => '200',
                'message' => 'user deleted successfully'
            ]);
        }catch (\Exception $ex){
            return response([
                'status' => '300',
                'message' => 'something went wrong'
            ]);
        }
    }

    public function addProduct(AdminAddProductRequest $request)
    {
        try {
            $image = $request->image;
            $image_name = time() . '.' . $image->getClientoriginalExtension();
            $image->move('products-image',$image_name);
            $product = new Product();
            $product->name = $request->get('name');
            $product->image = $image_name;
            $product->user_id = $request->user_id;
            $product->description = $request->get('description');
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

    public function getProducts()
    {
        try {
            $products = DB::table('products')->paginate(10);
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


    public function editProduct($id){
        try{
            $product = Product::find($id);
            $users = User::all();
            $current_user = DB::table('users')->where('id',$product->user_id)->get();
            if($product){
            return response([
                'status' => '200',
                'products' => $product,
                'users' => $users,
                'current_user' => $current_user
            ]);
            }else{
                return response([
                    'status' => '200',
                    'message'=> 'product not found'
                ]);
            }
        }catch (\Exception $ex){
            return response([
                'status'=> '300',
                'message' => 'something went wrong'
            ]);
        }
    }


    public function updateProduct(AdminAddProductRequest $request, $id)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                if ($request->has('image')) {
                    $image = $request->image;
                    $image_name = time() . '.' . $image->getClientoriginalExtension();
                    $image->move('products-image',$image_name);
                    $product->image = $image_name;
                }
                $product->update([
                    'name' => $request->get('name'),
                    'user_id' => $request->get('user_id'),
                    'description' => $request->get('description')
                ]);
                return response([
                    'status' => '200',
                    'message' => 'product has been updated successfully'
                ]);
            } else {
                return response([
                    'status' => '200',
                    'message' => 'product not found'
                ]);
            }
        } catch (\Exception $ex) {
            return response([
                'status' => '300',
                'message' => 'something went wrong'
            ]);
        }
    }


    public function deleteProduct($id)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                $product->delete();
                return response([
                    'status' => '200',
                    'message' => 'product deleted successfully'
                ]);
            } else {
                return response([
                    'status' => '200',
                    'message' => 'there is no product'
                ]);
            }
        } catch (\Exception $ex) {
            return response([
                'status' => '300',
                'message' => 'something went wrong'
            ]);
        }
    }


    public function getUserProducts($id)
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

}
