<?php
$datastring =  $live.$order_id.$invoice.$total.$phone.$email.$vid.$curr.$p1.$p2.$p3.$p4.$cbk.$cst.$crl;
/**********************************************************************************************************/
$hashkey = "8fdl0vjofspd23m"; //Supply to us during iPay account registration;
$datastring; //This is a string generated from the data to be posted (see above)
echo $hashid = hash_hmac("sha1", $datastring, $hashkey); //Set hashing algorithm to SHA1;
/**********************************************************************************************************/
?>




<?php
/*
This is a sample PHP script of how you would ideally integrate with iPay Payments Gateway and also handling the
callback from iPay and doing the IPN check

----------------------------------------------------------------------------------------------------
            ************(A.) INTEGRATING WITH iPAY ***********************************************
----------------------------------------------------------------------------------------------------
*/
//Data needed by iPay a fair share of it obtained from the user from a form e.g email, number etc...
$fields = array("live"=> "1",
    "oid"=> "545544534",
    "inv"=> "112020102292999",
    "ttl"=> "1",
    "tel"=> "254792071275",
    "eml"=> "abu.towett10@gmail.com.com",
    "vid"=> "mbeads",
    "curr"=> "KES",
    "p1"=> "airtel",
    "p2"=> "020102292999",
    "p3"=> "",
    "p4"=> "900",

    "cbk"=> "http://wilsonfox.co.ke/pay/1.php",


    "cst"=> "1",
    "crl"=> "0"
);
/*
----------------------------------------------------------------------------------------------------
************(b.) GENERATING THE HASH PARAMETER FROM THE DATASTRING *********************************
----------------------------------------------------------------------------------------------------

The datastring IS concatenated from the data above
*/
$datastring =  $fields['live'].$fields['oid'].$fields['inv'].$fields['ttl'].$fields['tel'].$fields['eml'].$fields['vid'].$fields['curr'].$fields['p1'].$fields['p2'].$fields['p3'].$fields['p4'].$fields['cbk'].$fields['cst'].$fields['crl'];
$hashkey ="8fdl0vjofspd23m";//use "demo" for testing where vid also is set to "demo"

/********************************************************************************************************
 * Generating the HashString sample
 */
$generated_hash = hash_hmac('sha1',$datastring , $hashkey);

?>

/*    Generate the form BELOW   */
<FORM action="https://payments.ipayafrica.com/v3/ke">
    <?php
    foreach ($fields as $key => $value) {
        echo $key;
        echo ' :<input name="'.$key.'" type="text" value="'.$value.'"></br>';
    }
    ?>


    <INPUT name="hsh" type="text" value="<?php echo $generated_hash ?>">
    <button type="submit">  Lipa  </button>

</FORM>
