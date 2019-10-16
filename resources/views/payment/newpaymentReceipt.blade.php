
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





            <div class="shopper-informations">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="total_area">
                            <p> Payment Receipt</p>
                            <h1 class="text-center">Thank you for shopping with us,your order is being processed.!</h1>
                            <ul>
                                <li>Order ID<span>{{$order_id}}</span></li>
                                <li>Payer Name<span>{{$name}}</span></li>
                                <li>Phone<span>{{$phone}}</span></li>
                                <li>Amount <span id="amount">KSH {{$amount}}</span></li>
                                <li>Channel <span>{{$channel}}</span></li>
                            </ul>
                            {{--                    <a class="btn btn-default update" href="">Update</a>--}}
                            <a class="btn btn-default update" href="{{route('allProducts')}}">Shop Again!</a>
                        </div>
                    </div>

                </div>
            </div>
















        </div>
    </section> <!--/#payment-->



@endsection



