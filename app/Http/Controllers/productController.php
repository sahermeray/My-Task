<?php

namespace App\Http\Controllers;

use App\Http\Requests\addProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;

class productController extends Controller
{
    public function addProduct(addProductRequest $request)
    {
        try {
            $image = $request->image;
            $image_name = time() . '.' . $image->getClientoriginalExtension();
            $product_image = Image::make($image)->resize(1200, 800);
            $product_image->save('products-image/' . $image_name, 80);
            $product = new Product();
            $product->name = $request->get('name');
            $product->image = $image_name;
            $product->user_id = Auth::id();
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

    public function webAddProduct(addProductRequest $request)
    {
        try {
            $image = $request->image;
            $image_name = time() . '.' . $image->getClientoriginalExtension();
            $product_image = Image::make($image)->resize(1200, 800);
            $product_image->save('products-image/' . $image_name, 80);
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

    public function webGetProducts()
    {
        try {
            $products = DB::table('products')->paginate(10);
            return view('admin.show_products', compact('products'));
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'something went wrong']);
        }
    }

    /*public function getProduct($id){
        try{
            $product = Product::find($id);
            if($product){
            return response([
                'status' => '200',
                'products'=> $product
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
    }*/

    public function updateProduct(addProductRequest $request, $id)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                if ($request->has('image')) {
                    $image = $request->image;
                    $image_name = time() . '.' . $image->getClientoriginalExtension();
                    $product_image = Image::make($image)->resize(1200, 800);
                    $product_image->save('products-image/' . $image_name, 80);
                    $product->image = $image_name;
                }
                $product->name = $request->get('name');
                $product->user_id = Auth::id();
                $product->price = $request->get('price');
                $product->description = $request->get('description');
                $product->save();
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

    public function webUpdateProduct(addProductRequest $request, $id)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                if ($request->has('image')) {
                    $image = $request->image;
                    $image_name = time() . '.' . $image->getClientoriginalExtension();
                    $product_image = Image::make($image)->resize(1200, 800);
                    $product_image->save('products-image/' . $image_name, 80);
                    $product->image = $image_name;
                }
                $product->name = $request->get('name');
                $product->user_id = Auth::id();
                $product->description = $request->get('description');
                $product->save();
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

    public function webDeleteProduct($id)
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

    public function webGetUserProducts($id)
    {
        try {
            $products = DB::table('products')->where('user_id', $id)->paginate(10);
            return view('user.show_products',compact('products'));
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'something went wrong']);
        }
    }
  }



