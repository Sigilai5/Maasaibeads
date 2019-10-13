
@extends('layouts.index')



@section('center')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>




            @if(Auth::check())





                <div class="shopper-informations">
                    <div class="row">

                        <div class="col-sm-12 clearfix">
                            <div class="bill-to">
                                <p> Shipping/Bill To</p>
                                <div class="form-one">
                                    <form action="/product/createNewOrder" method="post">




                                        {{csrf_field()}}


                                        <input type="text" name="name" placeholder="Name *" value="{!! Auth::user()->name !!}" required>
                                        <input type="text" name="email" placeholder="Email*" value="{!! Auth::user()->email !!}" required>
                                        <input type="tel" name="phone" placeholder="Phone Number *" required>

                                        </textarea>

                                        <textarea name="address" placeholder="Enter Shipping Location e.g Maruti Heights,Langata Link Road 6th Floor Room 8" required></textarea>

                                        <button class="btn btn-default check_out" type="submit" name="submit" >Proceed To Payment</button>

                                    </form>
                                </div>
                                <div class="form-two">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>


















        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
{{--            <div class="heading">--}}
{{--                <h3>What would you like to do next?</h3>--}}
{{--                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="chose_area">--}}
{{--                        <ul class="user_option">--}}
{{--                            <li>--}}
{{--                                <input type="checkbox">--}}
{{--                                <label>Use Coupon Code</label>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <input type="checkbox">--}}
{{--                                <label>Use Gift Voucher</label>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <input type="checkbox">--}}
{{--                                <label>Estimate Shipping & Taxes</label>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                        <ul class="user_info">--}}
{{--                            <li class="single_field">--}}
{{--                                <label>Country:</label>--}}
{{--                                <select>--}}
{{--                                    <option>United States</option>--}}
{{--                                    <option>Bangladesh</option>--}}
{{--                                    <option>UK</option>--}}
{{--                                    <option>India</option>--}}
{{--                                    <option>Pakistan</option>--}}
{{--                                    <option>Ucrane</option>--}}
{{--                                    <option>Canada</option>--}}
{{--                                    <option>Dubai</option>--}}
{{--                                </select>--}}

{{--                            </li>--}}
{{--                            <li class="single_field">--}}
{{--                                <label>Region / State:</label>--}}
{{--                                <select>--}}
{{--                                    <option>Select</option>--}}
{{--                                    <option>Dhaka</option>--}}
{{--                                    <option>London</option>--}}
{{--                                    <option>Dillih</option>--}}
{{--                                    <option>Lahore</option>--}}
{{--                                    <option>Alaska</option>--}}
{{--                                    <option>Canada</option>--}}
{{--                                    <option>Dubai</option>--}}
{{--                                </select>--}}

{{--                            </li>--}}
{{--                            <li class="single_field zip-field">--}}
{{--                                <label>Zip Code:</label>--}}
{{--                                <input type="text">--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                        <a class="btn btn-default update" href="">Get Quotes</a>--}}
{{--                        <a class="btn btn-default check_out" href="">Continue</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="total_area">--}}

{{--                        <a class="btn btn-default update" href="">Update</a>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}






            @else


                <div class="alert alert-danger" role="alert">
                    <strong>Please!</strong> <a href="{{route('register') }}">Register</a> in order to create an order
                </div>



            @endif







        </div>
    </section><!--/#do_action-->


@endsection



