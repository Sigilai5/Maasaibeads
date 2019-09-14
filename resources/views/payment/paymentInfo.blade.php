@extends('layouts.admin')

@section('body')


    <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>



    <style>

        /* The payment window */
        .payment-window {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* payment window content */
        .payment-window-content {
            background-color: #fefefe;
            margin: auto;
            padding: 30px;
            border: 1px solid #888;
            width: 45%;
        }

        /*  payment window close button */
        .payment-window-close {
            color: #aaaaaa;
            float:right;
            margin-left:20px;
            font-size: 28px;
            font-weight: bold;
        }


        .payment-window-close:hover,
        .payment-window-close:focus {
            color: #aaaaaa;
            text-decoration: none;
            cursor: pointer;
        }



    </style>


    <h1>Orders Panel</h1>

    @if(session('orderDeletionStatus'))
        <div class="alert alert-danger"> {{session('orderDeletionStatus')}} </div>
    @endif



    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#id</th>
                <th>Order_id</th>
                <th>Paypal_payment_id</th>
                <th>Paypal_payer_id</th>
                <th>Date</th>
                <th>Amount</th>


            </tr>
            </thead>
            <tbody>

            @foreach($paymentInfo as $order)
                <tr>
                    <td>{{$order->id}}</td>

                    <td>{{$order->order_id}}</td>
                    <td>{{$order->paypal_payment_id}}</td>
                    <td>{{$order->paypal_payer_id}}</td>
                    <td>{{$order->date}}</td>
                    <td>{{$order->amount}}</td>


                </tr>

            @endforeach





            </tbody>
        </table>









    </div>








@endsection




