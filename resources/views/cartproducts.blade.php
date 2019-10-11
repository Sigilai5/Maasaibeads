@extends('layouts.index')



@section('center')

    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success')  }}</p>

        </div><br \>
    @endif

<section id="cart_items" >
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>

{{--           {{$user->name}}--}}


                <tr class="cart_menu">

                </tr>
                </thead>
                <tbody>

                @foreach($cartItems->items as $item)

                    <tr width="40px">

                        <div class="product-image-wrapper" width="5%" height="5%">
                            <div class="single-products" >
                                <div class="productinfo text-center">
                                    <img src="{{Storage::disk('local')->url('product_images/'.$item['data']['image'])}}" alt="" />
                                    <h2>{{$item['data']['name']}}</h2>
                                    <p>{{$item['data']['description']}} - {{$item['data']['type']}}</p>
                                    <p>{{$item['data']['price']}}</p>
                                    <p class="cart_total_price">Total Price:KSH {{$item['totalSinglePrice']}}</p>
                                    <a class="cart_quantity_delete" href="{{route('DeleteItemFromCart',['id' => $item['data']['id']])}}"><i class="fa fa-trash-o"></i></a>


                                    <div class="cart_quantity_button">
                                                                        <a class="cart_quantity_up" href="{{route('IncreaseSingleProduct',['id' => $item['data']['id']])}}"> + </a>
                                                                        <input class="cart_quantity_input" type="text" name="quantity" value="{{$item['quantity']}}" autocomplete="off" size="2">
                                                                        <a class="cart_quantity_down" href="{{route('DecreaseSingleProduct',['id' => $item['data']['id']])}}"> - </a>
                                                                    </div>



                                </div>
                                {{--                                        <div class="product-overlay">--}}
                                {{--                                            <div class="overlay-content">--}}
                                {{--                                                <h2>{{$product->price}}</h2>--}}
                                {{--                                                <p>{{$product->name}}</p>--}}
                                {{--                                                <a href="{{route('AddToCartProduct',['id'=>$product->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                            </div>
                            <div class="choose">
                                {{--                                        <ul class="nav nav-pills nav-justified">--}}
                                {{--                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>--}}
                                {{--                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>--}}
                                {{--                                        </ul>--}}
                            </div>
                        </div>



{{--                        <td class="cart_product">--}}
{{--                            <a href=""><img src="{{Storage::disk('local')->url('product_images/'.$item['data']['image'])}}" alt=""></a>--}}
{{--                        </td>--}}
{{--                        <td class="cart_description">--}}
{{--                            <h4><a href="">{{$item['data']['name']}}</a></h4>--}}
{{--                            <p>{{$item['data']['description']}} - {{$item['data']['type']}}</p>--}}
{{--                            <p>Web ID: {{$item['data']['id']}}</p>--}}
{{--                        </td>--}}
{{--                        <td class="cart_price">--}}
{{--                            <p>{{$item['data']['price']}}</p>--}}
{{--                        </td>--}}
{{--                        <td class="cart_quantity">--}}
{{--                            <div class="cart_quantity_button">--}}
{{--                                <a class="cart_quantity_up" href="{{route('IncreaseSingleProduct',['id' => $item['data']['id']])}}"> + </a>--}}
{{--                                <input class="cart_quantity_input" type="text" name="quantity" value="{{$item['quantity']}}" autocomplete="off" size="2">--}}
{{--                                <a class="cart_quantity_down" href="{{route('DecreaseSingleProduct',['id' => $item['data']['id']])}}"> - </a>--}}
{{--                            </div>--}}
{{--                        </td>--}}
{{--                        <td class="cart_total">--}}
{{--                            <p class="cart_total_price">{{$item['totalSinglePrice']}}</p>--}}
{{--                        </td>--}}
{{--                        <td class="cart_delete">--}}
{{--                            <a class="cart_quantity_delete" href="{{route('DeleteItemFromCart',['id' => $item['data']['id']])}}"><i class="fa fa-times"></i></a>--}}
{{--                        </td>--}}
                    </tr>

                @endforeach




                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
{{--            <h3>What would you like to do next?</h3>--}}
{{--            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>--}}
        </div>
        <div class="row">
{{--            <div class="col-sm-6">--}}
{{--                <div class="chose_area">--}}
{{--                    <ul class="user_option">--}}
{{--                        <li>--}}
{{--                            <input type="checkbox">--}}
{{--                            <label>Use Coupon Code</label>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <input type="checkbox">--}}
{{--                            <label>Use Gift Voucher</label>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <input type="checkbox">--}}
{{--                            <label>Estimate Shipping & Taxes</label>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                    <ul class="user_info">--}}
{{--                        <li class="single_field">--}}
{{--                            <label>Country:</label>--}}
{{--                            <select>--}}
{{--                                <option>United States</option>--}}
{{--                                <option>Bangladesh</option>--}}
{{--                                <option>UK</option>--}}
{{--                                <option>India</option>--}}
{{--                                <option>Pakistan</option>--}}
{{--                                <option>Ucrane</option>--}}
{{--                                <option>Canada</option>--}}
{{--                                <option>Dubai</option>--}}
{{--                            </select>--}}

{{--                        </li>--}}
{{--                        <li class="single_field">--}}
{{--                            <label>Region / State:</label>--}}
{{--                            <select>--}}
{{--                                <option>Select</option>--}}
{{--                                <option>Dhaka</option>--}}
{{--                                <option>London</option>--}}
{{--                                <option>Dillih</option>--}}
{{--                                <option>Lahore</option>--}}
{{--                                <option>Alaska</option>--}}
{{--                                <option>Canada</option>--}}
{{--                                <option>Dubai</option>--}}
{{--                            </select>--}}

{{--                        </li>--}}
{{--                        <li class="single_field zip-field">--}}
{{--                            <label>Zip Code:</label>--}}
{{--                            <input type="text">--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                    <a class="btn btn-default update" href="">Get Quotes</a>--}}
{{--                    <a class="btn btn-default check_out" href="">Continue</a>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-sm-12">
                <div class="total_area">
                    <ul>
                        <li>Quantity<span>{{$cartItems->totalQuantity}} Items</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>KSH {{$cartItems->totalPrice}}</span></li>
                    </ul>
{{--                    <a class="btn btn-default update" href="">Update</a>--}}
                    <a class="btn btn-default check_out" href="{{route('checkoutProducts')}}">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection


