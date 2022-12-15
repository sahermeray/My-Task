<?php

namespace App\Http\Controllers\web;

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


    public function addUserWithEmail(AddUserWithEmailRequest $request){
        try {
                $user = User::create([
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name'),
                    'email' => $request->get('email'),
                    'password' => Hash::make($request->get('password')),
                ]);
            $user->save();
            return redirect()->back()->with(['success' => 'user has been added successfully']);
        }catch (\Exception $ex){
            return redirect()->back()->with(['error' => 'something went wrong']);
        }

    }

    public function addUserWithPhone(AddUserWithPhoneRequest $request){
        try {
                $user = User::create([
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name'),
                    'phone' => $request->get('phone'),
                    'password' => Hash::make($request->get('password')),
                ]);
            $user->save();
            return redirect()->back()->with(['success' => 'user has been added successfully']);
        }catch (\Exception $ex){
            return redirect()->back()->with(['error' => 'something went wrong']);
        }

    }


    public function editUser($id){
        try {
            $user = User::find($id);
            if($user){
                if($user->email) {
                    return view('admin.edit_user_with_email', compact('user'));
                }else{
                    return view('admin.edit_user_with_phone', compact('user'));
                }
            }
        }catch (\Exception $ex){
            return redirect()->back()->with(['error' => 'something went wrong']);
        }

    }


    public function updateUserWithPhone(UpdateUserWithPhoneRequest $request,$id){
        try {
            $user = User::find($id);
            if($user){
                $user->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                ]);
                return redirect()->back()->with(['success' => 'user has been updated successfully']);
            }
        }catch (\Exception $ex){
            return redirect()->back()->with(['error' => 'something went wrong']);
        }
    }

    public function updateUserWithEmail(UpdateUserWithEmailRequest $request,$id){
        try {
            $user = User::find($id);
            if($user){
                $user->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                ]);
                return redirect()->back()->with(['success' => 'user has been updated successfully']);
            }
        }catch (\Exception $ex){
            return redirect()->back()->with(['error' => 'something went wrong']);
        }
    }


    public function deleteUser($id){
        try{
            $user = User::find($id);
            $user->delete();
            return redirect()->back()->with(['success' => 'user has been deleted successfully']);
        }catch (\Exception $ex){
            return redirect()->back()->with(['error' => 'something went wrong']);
        }
    }


    public function getUsers(){
        try {
            $users = DB::table('users')->paginate(10);
            return view('admin.show_users', compact('users'));
        }catch (\Exception $ex){
            return redirect()->back()->with(['error' => 'something went wrong']);
        }
    }

    public function getAddUserWithEmailForm(){
        return view('admin.add_user_with_email');
    }

    public function getAddUserWithPhoneForm(){
        return view('admin.add_user_with_phone');
    }

    public function getAddProductForm(){
        $users = User::all();
        return view('admin.add_product',compact('users'));
    }


    public function addProduct(AdminAddProductRequest $request)
    {
        try {
            $image = $request->image;
            $image_name = time() . '.' . $image->getClientoriginalExtension();
            $image->move('products-image',$image_name);
            $product = Product::create([
                'description' => $request->description,
                'name' => $request->name,
                'image' => $image_name,
                'user_id' => $request->user_id
            ]);
            $product->save();
            return redirect()->back()->with(['success' => 'product has been added successfully']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'something went wrong']);
        }
    }

    public function getProducts()
    {
        try {
            $products = DB::table('products')->paginate(10);
            return view('admin.show_products', compact('products'));
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'something went wrong']);
        }
    }


    public function editProduct($id){
        try{
            $product = Product::find($id);
            $users = User::all();
            $current_user = DB::table('users')->where('id',$product->user_id)->first();
            if($product){
               return view('admin.edit_product',compact('product','users','current_user'));
            }else{
               return redirect()->back()->with(['error' => 'product not found']);
            }
        }catch (\Exception $ex){
            redirect()->back()->with(['error' => 'something went wrong']);
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
                return redirect()->back()->with(['success' => 'product has been updated successfully']);
            } else {
                return redirect()->back()->with(['error' => 'product not found']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'something went wrong']);
        }
    }


    public function deleteProduct($id)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                $product->delete();
                return redirect()->back()->with(['success' => 'product has been deleted successfully']);
            } else {
                return redirect()->back()->with(['error' => 'product not found']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'something went wrong']);
        }
    }


    public function getUserProducts($id)
    {
        try {
            $products = DB::table('products')->where('user_id', $id)->paginate(10);
            return view('user.show_products',compact('products'));
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'something went wrong']);
        }
    }
}
