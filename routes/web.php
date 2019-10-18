<?php

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

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

Route::get('/',['uses'=>'ProductsController@index','as'=>'allProducts']);

//get all products
Route::get('products',['uses'=>'ProductsController@index','as'=>'allProducts']);

//Get men products
Route::get('products/men',['uses'=>'ProductsController@menProducts','as'=>'menProducts']);

//Get women products
Route::get('products/women',['uses'=>'ProductsController@womenProducts','as'=>'womenProducts']);

//Get perfumes products
Route::get('products/perfumes',['uses'=>'ProductsController@perfumesProducts','as'=>'perfumesProducts']);

//Get jewellery products
Route::get('products/jewellery',['uses'=>'ProductsController@jewelleryProducts','as'=>'jewelleryProducts']);

//Get search products
Route::get('search',['uses'=>'ProductsController@searchProducts','as'=>'searchProducts']);


//add to cart
Route::get('product/addToCart/{id}',['uses'=>'ProductsController@addProductToCart','as'=>'AddToCartProduct']);

//show cart items
Route::get('cart',['uses'=>'ProductsController@showCart','as'=>'cartProducts']);

//delete from cart
Route::get('product/deleteItemFromCart/{id}',['uses'=>'ProductsController@deleteItemFromCart','as'=>'DeleteItemFromCart']);

//increase single product in cart
Route::get('product/increaseSingleProduct/{id}',['uses'=>'ProductsController@increaseSingleProduct','as'=>'IncreaseSingleProduct']);

//decrease single product in cart
Route::get('product/decreaseSingleProduct/{id}',['uses'=>'ProductsController@decreaseSingleProduct','as'=>'DecreaseSingleProduct']);

//checkout page
Route::get('product/checkoutProducts/',['uses'=>'ProductsController@checkoutProducts','as'=>'checkoutProducts']);

//checkout page
Route::post('product/createNewOrder/',['uses'=>'ProductsController@createNewOrder','as'=>'createNewOrder']);

//create an order
Route::get('product/createOrder/',['uses'=>'ProductsController@createOrder','as'=>'createOrder']);

//payment page
Route::get('payment/paymentpage',['uses'=>'Payment\PaymentsController@showPaymentPage','as'=>'showPaymentPage']);

//process payment & receipt page
Route::get('payment/paymentreceipt/{paymentID}/{payerID}',['uses'=>'Payment\PaymentsController@showPaymentReceipt','as'=>'showPaymentReceipt']);

Route::get('payment/newpaymentreceipt',['uses'=>'Payment\PaymentsController@newPaymentReceipt','as'=>'newPaymentReceipt']);

/**ADMIN DASHBOARD**/

# Route::group(['middleware' => ['restrictToAdmin']], function (){ Paste every admin restricted route here }); //RESTRICTION ALTERNATIVE

//Admin panel

//Display Products
Route::get('admin/products',['uses'=>'Admin\AdminProductsController@index','as'=>'adminDisplayProducts'])->middleware('restrictToAdmin');

//Display Users
Route::get('admin/users',['uses'=>'Admin\AdminProductsController@displayUsers','as'=>'adminDisplayUsers'])->middleware('restrictToAdmin');

//Display edit product form in admin
Route::get('admin/editProductForm/{id}',['uses'=>'Admin\AdminProductsController@editProductForm','as'=>'adminEditProductForm'])->middleware('restrictToAdmin');

//Display edit product image form in admin
Route::get('admin/editProductImageForm/{id}',['uses'=>'Admin\AdminProductsController@editProductImageForm','as'=>'adminEditProductImageForm'])->middleware('restrictToAdmin');

//Display edit user form in admin
Route::get('admin/editUserForm/{id}',['uses'=>'Admin\AdminProductsController@editUserForm','as'=>'adminEditUserForm'])->middleware('restrictToAdmin');


//display customer
Route::get('admin/orderCustomer/{id}',['uses'=>'Admin\AdminProductsController@orderCustomer','as'=>'adminOrderCustomer'])->middleware('restrictToAdmin');

//display order item
Route::get('admin/orderItem/{id}',['uses'=>'Admin\AdminProductsController@orderItem','as'=>'adminOrderItem'])->middleware('restrictToAdmin');

//update product image
Route::post('admin/updateProductImage/{id}',['uses'=>'Admin\AdminProductsController@updateProductImage','as'=>'adminUpdateProductImage'])->middleware('restrictToAdmin');

//update product details
Route::post('admin/updateProduct/{id}',['uses'=>'Admin\AdminProductsController@updateProduct','as'=>'adminUpdateProduct'])->middleware('restrictToAdmin');

//Display create product form in admin
Route::get('admin/createProductForm/',['uses'=>'Admin\AdminProductsController@createProductForm','as'=>'adminCreateProductForm'])->middleware('restrictToAdmin');

//send new product data to database
Route::post('admin/sendCreateProductForm/',['uses'=>'Admin\AdminProductsController@sendCreateProductForm','as'=>'adminSendCreateProductForm'])->middleware('restrictToAdmin');

//delete product
Route::get('admin/deleteProduct/{id}',['uses'=>'Admin\AdminProductsController@deleteProduct','as'=>'adminDeleteProduct'])->middleware('restrictToAdmin');

//delete user
Route::get('admin/deleteUser/{id}',['uses'=>'Admin\AdminProductsController@deleteUser','as'=>'adminDeleteUser'])->middleware('restrictToAdmin');


//update user details
Route::post('admin/updateUser/{id}',['uses'=>'Admin\AdminProductsController@updateUser','as'=>'adminUpdateUser'])->middleware('restrictToAdmin');


//orders control panel
Route::get('admin/ordersPanel/',['uses'=>'Admin\AdminProductsController@ordersPanel','as'=>'ordersPanel'])->middleware('restrictToAdmin');

//delete order
Route::get('admin/adminDeleteOrder/{id}',['uses'=>'Admin\AdminProductsController@deleteOrder','as'=>'adminDeleteOrder'])->middleware('restrictToAdmin');

//get Payment info by order id
Route::get('payment/paymentInfo/{order_id}',['uses'=>'Payment\PaymentsController@paymentInfo','as'=>'paymentInfo'])->middleware('restrictToAdmin');

//Display edit order form in admin
Route::get('admin/editOrderForm/{order_id}',['uses'=>'Admin\AdminProductsController@editOrderForm','as'=>'adminEditOrderForm'])->middleware('restrictToAdmin');

Route::post('admin/updateOrder/{order_id}',['uses'=>'Admin\AdminProductsController@updateOrder','as'=>'adminUpdateOrder'])->middleware('restrictToAdmin');

//update order data
/*IMAGE CHEAT CODES*/
//storage
Route::get('/testStorage',function (){

    //return "<img src=".Storage::url('product_images/jacket.jpg').">";
    //return Storage::disk('local')->url('product_images/jacket.jpg');

    /*USE PUBLIC*/
    //print_r(Storage::disk("local")->exists("public/product_images/jacket.jpg");
    //Storage::delete('public/product_images/jacket.jpg');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//Route::post('/test','Controller@getData')->name('test.store');

//Route::post('/test',['uses'=>'ProductsController@getData','as'=>'test.store']);
