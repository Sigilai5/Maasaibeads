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
                            <ul>

                                <li>Payment Status:
                                    @if($payment_info['status'] == 'on_hold')
                                        <span>Not Yet Paid</span>

                                    @endif

                                </li>
                                <li>Shipping Cost:<b>Only for Nairobi Residents<b> <span>300</span></li>
                                <li>ORDER ID: <span>{{$payment_info['order_id']}}</span></li>
                                <li>Total: <span>{{$payment_info['price'] + 300}}</span></li>
                            </ul>

                      <form action="https://www.scentsbygeraldine.co.ke/pay/2.php" method="post">

                          <input type="text" hidden name="1" value="254{{$payment_info['phone']}}">
                          <input type="text" hidden name="2" value="{{$payment_info['price'] + $shipping}}">
                          <input type="text" hidden name="3" value="{{$payment_info['order_id']}}" hidden="true">
                          <input type="text" hidden name="4" value="{{$payment_info['email']}}">

                          <button class="btn btn-default check_out" type="submit" name="submit" >Proceed To Payment</button>

                      </form>

{{--                            <a class="btn btn-default update" href="">Pay with Mpesa</a>--}}
{{--                            <a class="btn btn-default check_out" id="paypal-button-container"></a>--}}
                        </div>
                    </div>



                </div>
            </div>


















        </div>
    </section> <!--/#payment-->



@endsection

{{--<script--}}
{{--        src="https://www.paypal.com/sdk/js?client-id=AaAEduiWFpHR8fuvFpIs4fDnxJN-8O2tIKiLrKt_uM9UII5KS-r8jRfEHOzPvV7JchRZSV_CfJaam6bo">--}}
{{--</script>--}}

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
            sandbox: 'AaAEduiWFpHR8fuvFpIs4fDnxJN-8O2tIKiLrKt_uM9UII5KS-r8jRfEHOzPvV7JchRZSV_CfJaam6bo',
            production: 'YOUR_PRODUCTION_CLIENT_ID'
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
            size: 'small',
            color: 'gold',
            shape: 'pill',
        },

        // Enable Pay Now checkout flow (optional)
        commit: true,

        // Set up a payment
        payment: function(data, actions) {
            return actions.payment.create({
                transactions: [{
                    amount: {
                        total: "{{$payment_info['price']}}",
                        currency: 'USD'
                    }
                }]
            });
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                // Show a confirmation message to the buyer
                window.alert('Thank you for your purchase!');

                window.location = './paymentreceipt/'+data.paymentID+'/'+data.payerID;



            });
        }
    }, '#paypal-button-container');

</script>

{{--<script>--}}
{{--    paypal.Buttons({--}}
{{--        createOrder: function(data, actions) {--}}
{{--            return actions.order.create({--}}
{{--                purchase_units: [{--}}
{{--                    amount: {--}}
{{--                        value: '{{$payment_info['price']}}'--}}
{{--                    }--}}
{{--                }]--}}
{{--            });--}}
{{--        },--}}
{{--        onApprove: function(data, actions) {--}}

{{--            return actions.order.capture().then(function(details) {--}}
{{--                alert('Transaction completed by ' + details.payer.name.given_name);--}}
{{--                console.log(data);--}}
{{--                // window.location = './paymentreceipt/'+data.paymentID+'/'+data.payerID;--}}

{{--                --}}{{--window.location = "{{url('payment/paymentreceipt')}}"+"/"+data.paymentID+"/"+data.payerID;--}}

{{--                // Call your server to save the transaction--}}
{{--                return fetch('/paypal-transaction-complete', {--}}
{{--                    method: 'post',--}}
{{--                    headers: {--}}
{{--                        'content-type': 'application/json'--}}
{{--                    },--}}
{{--                    body: JSON.stringify({--}}
{{--                        orderID: data.orderID--}}
{{--                    })--}}
{{--                });--}}
{{--            });--}}

{{--        }--}}
{{--    }).render('#paypal-button-container');--}}
{{--</script>--}}
