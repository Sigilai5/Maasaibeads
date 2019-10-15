<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class ProductsController extends Controller


{
    //
    public function index(){

        $products = Product::paginate(100);  //Product::all();
        $title = 'Maasaibeads';

        return view('allproducts')->with(compact('products'))->with(compact('title'));

    }

    public function menProducts(){

        $products = DB::table('products')->where('type', 'Men')->get();
        $title = 'Men Products';

        return view('menProducts')->with(compact('products'))->with(compact('title'));
    }

    public function womenProducts(){

        $products = DB::table('products')->where('type', 'Women')->get();
        $title = 'Women Products';
        return view('womenProducts')->with(compact('products'))->with(compact('title'));
    }

    public function perfumesProducts(){

        $products = DB::table('products')->where('category', 'perfumes')->get();
        $title = 'Perfumes';
        return view('perfumesProducts')->with(compact('products'))->with(compact('title'));
    }

    public function jewelleryProducts(){

        $products = DB::table('products')->where('category', 'beads')->get();
        $title = 'Jewellery';
        return view('jewelleryProducts')->with(compact('products'))->with(compact('title'));
    }

    public function searchProducts(Request $request){

        $searchText = $request->get('searchText');
        $products = Product::where('name',"Like",$searchText."%")->paginate(3);
        $title = 'Search Results';

        return view('allproducts')->with(compact('products'))->with(compact('title'));

    }

    public function addProductToCart(Request $request,$id){

        //REMOVE EVERYTHING FROM CART
//        $request->session()->forget("cart");
//        $request->session()->flush();

        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);

        $product = Product::find($id);
        $cart->addItem($id,$product);
        $request->session()->put('cart',$cart);
        $title = 'Added Products to Cart';



        //dump($cart);

        return redirect()->route('allProducts')->with('success', 'Product name '.$product->name.' added to cart.')->with(compact('title'));

    }



    public function showCart(){

       $cart = Session::get('cart');

       //if there is an item in the cart
        $title = 'Cart';
       if($cart){

            return view('cartproducts',['cartItems'=>$cart])->with(compact('title'));

       }
       //empty cart
       else{
            return redirect()->route('allProducts');
       }

    }

    public function deleteItemFromCart(Request $request,$id){

        $cart = $request->session()->get('cart');

        if(array_key_exists($id,$cart->items)){
            unset($cart->items[$id]);

        }

        $prevCart = $request->session()->get('cart');
        $updatedCart = new Cart($prevCart);
        $updatedCart->updatePriceAndQuantity();

        $request->session()->put('cart',$updatedCart);

        return redirect()->route('cartProducts')->with('success', 'Product deleted from cart');

    }

    public function increaseSingleProduct(Request $request,$id){

        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);

        $product = Product::find($id);
        $cart->addItem($id,$product);
        $request->session()->put('cart',$cart);

        return redirect()->route("cartProducts");

    }

    public function decreaseSingleProduct(Request $request,$id){

        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);

        if($cart->items[$id]['quantity'] > 1){
            $product = Product::find($id);
            $price = (int) str_replace("KSH","",$product['price']);
            $cart->items[$id]['quantity'] = $cart->items[$id]['quantity']-1;
            $cart->items[$id]['totalSinglePrice'] = $cart->items[$id]['quantity'] * $price ;

            $cart->updatePriceAndQuantity();

            $request->session()->put('cart',$cart);

        }

        return redirect()->route("cartProducts");

    }

    public function checkoutProducts(){
        $title = 'Added Products to Cart';

        return view('checkoutproducts')->with(compact('title'));;
    }

    public function createNewOrder(Request $request){

        $cart = Session::get('cart');

        $name = $request->input('name');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $email = $request->input('email');

        $isUserLoggedIn = Auth::check();

        if($isUserLoggedIn){
            $user_id = Auth::id();

        }else{
            //guest user
            $user_id = 0;

        }


        //cart is not empty
        if($cart){
            $date = date('Y-m-d H:i:s');
            $newOrderArray = array("user_id"=>$user_id,'status'=>"on_hold","date"=>$date,"delivery_date"=>$date,"price"=>$cart->totalPrice,
                "name"=>$name,"address"=>$address,"email"=>$email,"phone"=>$phone);

            $create_oder = DB::table('orders')->insert($newOrderArray); //INSERT TO 'orders' TABLE
            $order_id = DB::getPdo()->lastInsertId(); //get id of of the order

            foreach ($cart->items as $cart_item){
                $item_id = $cart_item['data']['id'];
                $item_name = $cart_item['data']['name'];
                $quantity =$cart_item['quantity'];
                $item_price = $price = (int) str_replace("KSH","",$cart_item['data']['price']);
                $newItemsInCurrentOrder = array('item_id'=>$item_id,'order_id'=>$order_id,'item_name'=>$item_name,'item_price'=>$item_price,'quantity'=>$quantity);
                $created_order_items = DB::table('order_items')->insert($newItemsInCurrentOrder);


            }



            //delete  cart session
            Session()->forget("cart");

            $payment_info = $newOrderArray;
            $payment_info['order_id'] = $order_id;
            $request->session()->put('payment_info',$payment_info); //PREVENT USER FROM PAYING TWICE
            $title = 'Payment Page';


            return redirect()->route("showPaymentPage")->with(compact('title'));

        }else{
            $title = 'Home';

            return redirect()->route('allProducts')->with(compact('title'));
        }

    }


    public function createOrder(){

        $cart = Session::get('cart');

        //cart is not empty
        if($cart){
            $date = date('Y-m-d H:i:s');
            $newOrderArray = array('status'=>"on_hold","date"=>$date,"delivery_date"=>$date,"price"=>$cart->totalPrice);
            $create_order = DB::table('orders')->insert($newOrderArray); //INSERT TO 'orders' TABLE
            $order_id = DB::getPdo()->lastInsertId(); //get id of of the order

            foreach ($cart->items as $cart_item){
                $item_id = $cart_item['data']['id'];
                $item_name = $cart_item['data']['name'];
                $item_price = $price = (int) str_replace("KSH","",$cart_item['data']['price']);
                $newItemsInCurrentOrder = array('item_id'=>$item_id,'order_id'=>$order_id,'item_name'=>$item_name,'item_price'=>$item_price);
                $created_order_items = DB::table('order_items')->insert($newItemsInCurrentOrder);

            }

            //empty cart
            Session()->forget("cart");
            Session()->flush();
            $title = 'Home';
            return redirect()->route("allProducts")->with('success', 'Thank You for Shopping with us')->with(compact('title'));

        }else{

            $title = 'Home';
            return redirect()->route("allProducts")->with(compact('title'));
        }

    }


    public function test(){

        //Data needed by iPay a fair share of it obtained from the user from a form e.g email, number etc...
        $fields = array("live"=> "1",
            "oid"=> "112",
            "inv"=> "112020102292999",
            "ttl"=> "5",
            "tel"=> "0792071275",
            "eml"=> "briansigilai@gmail.com",
            "vid"=> "mbeads",
            "curr"=> "KES",
            "p1"=> "airtel",
            "p2"=> "020102292999",
            "p3"=> "maasaibeads",
            "p4"=> "900",
            "cbk"=> "http://maasaibeads.com/",
            "cst"=> "1",
            "crl"=> "0"
        );

        $datastring =  $fields['live'].$fields['oid'].$fields['inv'].$fields['ttl'].$fields['tel'].$fields['eml'].$fields['vid'].$fields['curr'].$fields['p1'].$fields['p2'].$fields['p3'].$fields['p4'].$fields['cbk'].$fields['cst'].$fields['crl'];
        $hashkey ="8fdl0vjofspd23m";//use "demo" for testing where vid also is set to "demo"

        /********************************************************************************************************
         * Generating the HashString sample
         */
        $generated_hash = hash_hmac('sha1',$datastring , $hashkey);


        return view('test',['some_data'=>$fields,'generated_hash'=>$generated_hash]);
    }

    public function getData(Request $request)
    {
        $first_name = $request->first_name;

        return $first_name;
    }

//https://stackoverflow.com/questions/33641912/trying-to-get-key-in-a-foreach-loop-to-work-using-blade
//https://stackoverflow.com/questions/34957138/laravel-php-foreach-loop-get-value-by-key
//https://stackoverflow.com/questions/34907047/laravel-5-2-foreach-associative-array-in-key-return-index
//https://stackoverflow.com/questions/1834703/php-foreach-loop-key-value


public function ipay(){

}

}
