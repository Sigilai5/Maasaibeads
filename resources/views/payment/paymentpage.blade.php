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
                                <li>Shipping Cost: <span>Free</span></li>
                                <li>ORDER ID: <span>{{$payment_info['order_id']}}</span></li>
                                <li>Total: <span>{{$payment_info['price']}}</span></li>
                            </ul>

                            <form
                                id="eazzycheckout-payment-form"
                                action=" https://api-test.equitybankgroup.com/v2/checkout/launch" method="POST">
                                <input type="hidden" id="token" name="token" value="0UbDiQVo8bXnqqAd9Kr5mN3avrPX">

                                <input type="hidden" id="amount" name="amount" value="{{$payment_info['price']}}0000.0">
                                <input type="hidden" id="orderReference" name="orderReference" value="{{$payment_info['order_id']}}">

                                <input type="hidden" id="merchantCode" name="merchantCode" value="5067002602">
                                <input type="hidden" id="merchant" name="merchant" value="MerchantXYZ">
                                <input type="hidden" id="currency" name="currency" value="KES">
                                <input type="hidden" id="custName" name="custName" value="Sigi">
                                <input type="hidden" id="outletCode" name="outletCode" value="8852175642">
                                <input type="hidden" id="extraData" name="extraData" value="firsttest">
                                <input type="hidden" id="popupLogo" name="popupLogo" value="http://mwafrika.co.ke/JENGA/sbg.jpg">
                                <input type="hidden" id="ez1_callbackurl" name="ez1_callbackurl" value="http://mwafrika.co.ke">
                                <input type="hidden" id="ez2_callbackurl" name="ez2_callbackurl" value="http://mwafrika.co.ke">
                                <input type="hidden" id="expiry" name="expiry" value="2025-02-17T19:00:00">
                                <input type="submit" id="submit-cg" role="button" class="btn btn-primary col-md-4"
                                       value="Checkout"/>
                            </form>

{{--                            <a class="btn btn-default update" href="">Pay with Mpesa</a>--}}
                            <a class="btn btn-default check_out" id="paypal-button-container"></a>
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
