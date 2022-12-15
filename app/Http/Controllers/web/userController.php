<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\addProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class userController extends Controller
{
  public function getAddProductForm(){
      return view('user.add_product');
  }


  public function myProfile($id){
      try {
          $user = DB::table('users')->find($id);
          return view('user.profile', compact('user'));
      }catch (\Exception $ex) {
          return redirect()->back()->with(['error' => 'something went wrong']);
      }
  }

  public function getMyProducts($id){
      try {
          $products = DB::table('products')->where('user_id', $id)->paginate(10);
          return view('user.show_products', compact('products'));
      }catch (\Exception $ex){
          return redirect()->back()->with(['error' => 'something went wrong']);
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
            return redirect()->back()->with(['success' => 'product has been added successfully']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'something went wrong']);
        }
    }

}
