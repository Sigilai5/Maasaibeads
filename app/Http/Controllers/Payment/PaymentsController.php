<?php

namespace App\Http\Controllers\Payment;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;




class PaymentsController extends Controller
{



    public function showPaymentPage()
    {
        $payment_info = Session::get('payment_info');
        $title = 'Payment Page';

        //has not paid
        if ($payment_info['status'] == 'on_hold') {

            /* iPay*/
            $shipping = 300;
            $total_cost = $payment_info['price'] + $shipping;

            //Data needed by iPay a fair share of it obtained from the user from a form e.g email, number etc...
            $fields = array("live"=> "1",
                "oid"=> $payment_info['order_id'],
                "inv"=> "112020102292999",
                "ttl"=> $total_cost ,
                "tel"=> $payment_info['phone'],
                "eml"=> $payment_info['email'],
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



            return view('payment.paymentpage', ['payment_info' => $payment_info,'shipping'=>$shipping,'generated_hash'=>$generated_hash,'some_data'=>$fields])->with(compact('title'));
        } else {

            return redirect()->route('allProducts')->with(compact('title'));

        }

    }

    private function storePaymentInfo($paypalPaymentID, $paypalPayerID)
    {

        $payment_info = Session::get('payment_info');
        $order_id = $payment_info['order_id'];
        $status = $payment_info['status'];
        $paypal_payment_id = $paypalPaymentID;
        $paypal_payer_id = $paypalPayerID;

        if ($status == 'on_hold') {

            //create (issue) a new payment row in payments table
            $date = date('Y-m-d H:i:s');
            $newPaymentArray = array("order_id" => $order_id, "date" => $date, "amount" => $payment_info['price'], "paypal_payment_id" => $paypal_payment_id, "paypal_payer_id" => $paypal_payer_id);
            $created_order = DB::table("payments")->insert($newPaymentArray);

            //update payment status in orders table to "paid"

            DB::table('orders')->where('id', $order_id)->update(['status' => 'paid']);

        }


    }


    public function showPaymentReceipt($paypalPaymentID, $paypalPayerID)
    {

        if (!empty($paypalPaymentID) && !empty($paypalPayerID)) {
            //will return json which contains transaction status
            $this->validate_payment($paypalPaymentID, $paypalPayerID);

            $this->storePaymentInfo($paypalPaymentID, $paypalPayerID);

            $payment_receipt = Session::get('payment_info');

            $payment_receipt["paypal_payment_id"] = $paypalPaymentID;
            $payment_receipt["paypal_payer_id"] = $paypalPayerID;

            //delete payment info from session
            Session::forget("payment_info");
            $title = 'Payment Receipt';

            return view('payment.paymentReceipt', ['payment_receipt' => $payment_receipt])->with(compact('title'));

        } else {

            return redirect()->route("allProducts");

        }


    }

    private function validate_payment($paypalPaymentID, $paypalPayerID)
    {

        $paypalEnv = 'sandbox'; // Or 'production' for live
        $paypalURL = 'https://api.sandbox.paypal.com/v1/'; //change this to paypal live url when you go live
        $paypalClientID = 'AaAEduiWFpHR8fuvFpIs4fDnxJN-8O2tIKiLrKt_uM9UII5KS-r8jRfEHOzPvV7JchRZSV_CfJaam6bo';
        $paypalSecret = 'EDlkgucMiV1xOnI1uzaUm6bbKRwHkC8IC0FATriTWUY8vG_JHsEi67okZ5oclXCTAwsG0pLXRIbi0--V';


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $paypalURL . 'oauth2/token');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $paypalClientID . ":" . $paypalSecret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $response = curl_exec($ch);
        curl_close($ch);

        if (empty($response)) {
            return false;
        } else {
            $jsonData = json_decode($response);
            $curl = curl_init($paypalURL . 'payments/payment/' . $paypalPaymentID);
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $jsonData->access_token,
                'Accept: application/json',
                'Content-Type: application/xml'
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            // Transaction data
            $result = json_decode($response);

            return $result;
        }

    }

    public function paymentInfo($order_id){

        $paymentInfo = DB::table('payments')->where('order_id',$order_id)->get();
        $title = 'Payment Info';

        return view('payment.paymentInfo',["paymentInfo" => $paymentInfo])->with(compact('title'));

    }




}
