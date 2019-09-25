<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminProductsController extends Controller
{
    //display all products
    public function index(){

        $products = Product::paginate(10); //Product::all();

        return view('admin.displayProducts',compact('products')); // or ['products'=>$products]

    }

    public function createProductForm(){
        return view('admin.createProductForm');
    }

    //display edit product form
    public function editProductForm($id){
        $product = Product::find($id);

        $product_price = $price = (int) str_replace("$","",$product->price);

        return view('admin.editProductForm',['product'=>$product,'product_price'=>$product_price]);

    }

    //display function edit product image form
    public function editProductImageForm($id){
        $product = Product::find($id);
        return view('admin.editProductImageForm',['product'=>$product]);

    }

    //display Customers contacts
    public function orderCustomer($id){
        $orders = DB::table('orders')->where("id",$id)->get();
        return view('admin.orderCustomer',['orders'=>$orders]);

    }






    //create product image
    public function sendCreateProductForm(Request $request){

        $name = $request->input('name');
        $description = $request->input('description');
        $type = $request->input('type');
        $price = $request->input('price');
        $priceInInt = (float) $price;


        Validator::make($request->all(),['image'=>'required|file|image|mimes:jpg,png,jpeg|max:5000'])->validate();
        //upload new image
        $ext = $request->file('image')->getClientOriginalExtension(); //jpg
        $stringImageReFormat = str_replace(" ","",$request->input('name'));

        $imageName = $stringImageReFormat.".".$ext; //blackdress.jpg
        $imageEncoded = File::get($request->image);

        Storage::disk('local')->put('public/product_images/'.$imageName,$imageEncoded);

        $newProductArray = array("name"=>$name,"description"=>$description,"image"=>$imageName,"type"=>$type,"price"=>$priceInInt);

        $created = DB::table('products')->insert($newProductArray);

        if($created){
            return redirect()->route('adminDisplayProducts')->with('success', 'Product name '.$name.' has been created.');
        }else{
            return "Product was not created";
        }




    }


    //update product image
    public function updateProductImage(Request $request,$id){

        Validator::make($request->all(),['image'=>'required|file|image|mimes:jpg,png,jpeg|max:5000'])->validate();

        if($request->hasFile('image')){

            $product = Product::find($id);
            $exists = Storage::disk('local')->exists("public/product_images/".$product->image);

            //delete old image
            if ($exists){
                Storage::delete('public/product_images/'.$product->image);
            }

            //upload new image
            $ext = $request->file('image')->getClientOriginalExtension(); //jpg

            $request->image->storeAs("public/product_images/",$product->image);//store image with old name

            $arrayToUpdate = array('image'=>$product->image);
            DB::table('products')->where('id',$id)->update($arrayToUpdate);

            return redirect()->route('adminDisplayProducts')->with('success', 'Image of product name '.$product->name.' has been updated.');


        }else{

            $error = "No image was selected";
            return$error;

        }

    }

    //update product details
    public function updateProduct(Request $request,$id){

        $name = $request->input('name');
        $description = $request->input('description');
        $type = $request->input('type');
        $price = $request->input('price');
        $priceInInt = (float) $price;

        $updateArray = array("name"=>$name,"description"=>$description,"type"=>$type,"price"=>$priceInInt);

        DB::table('products')->where('id',$id)->update($updateArray);

        return redirect()->route('adminDisplayProducts')->with('success', 'Product name '.$name.' has been updated.');
    }


    //delete product
    public function deleteProduct($id){

        $product = Product::find($id);
        $exists = Storage::disk('local')->exists("public/product_images/".$product->image);

        //delete old image
        if ($exists){
            Storage::delete('public/product_images/'.$product->image);
        }

       Product::destroy($id);

        return redirect()->route('adminDisplayProducts')->with('success', 'Product name '.$product->name.' has been deleted.');

    }

    //orders list
    public function ordersPanel(){

        $orders = DB::table('orders')->paginate(10);
//        print_r($orders);
        return view('admin.ordersPanel',["orders" => $orders]);

    }

    public function deleteOrder(Request $request,$id){

        $deleted = DB::table('orders')->where("id", $id)->delete();

        if($deleted){
            return redirect()->back()->with('orderDeletionStatus','Order '.$id.' was successfully deleted');
        }else{
            return redirect()->back()->with('orderDeletionStatus','Order '.$id.' was NOT deleted');
        }

    }

    //display edit order form
    public function editOrderForm($order_id){

        $order = DB::table('orders')->where("id",$order_id)->get();

        return view('admin.editOrderForm',['order'=>$order[0]]);

    }


    //update order fields
    public function updateOrder(Request $request,$order_id){

        $date = $request->input('date');
        $delivery_date = $request->input('delivery_date');
        $status = $request->input('status');
        $price = $request->input('price');

        $updateArray = array("date"=>$date,"delivery_date"=>$delivery_date,"status"=>$status,"price"=>$price);

        DB::table('orders')->where('id',$order_id)->update($updateArray);

        return redirect()->route("ordersPanel");

    }


}
