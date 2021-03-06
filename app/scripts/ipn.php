<?php

include_once ('db.php');

require_once 'SimpleMail.php';

$orderNumber = $_REQUEST['order'];


//$db = new PDO('mysql:host=gator3320.hostgator.com;dbname=idineth_pwdgroups;charset=utf8', 'idineth_pwdgroup', 'trustnoone');
// STEP 1: Read POST data

// reading posted data from directly from $_POST causes serialization 
// issues with array data in POST
// reading raw POST data from input stream instead. 
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
  $keyval = explode ('=', $keyval);
  if (count($keyval) == 2)
     $myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
   $get_magic_quotes_exists = true;
} 
foreach ($myPost as $key => $value) {        
   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
        $value = urlencode(stripslashes($value)); 
   } else {
        $value = urlencode($value);
   }
   $req .= "&$key=$value";
}


// STEP 2: Post IPN data back to paypal to validate

$ch = curl_init('https://www.paypal.com/cgi-bin/webscr'); // change to [...]sandbox.paypal[...] when using sandbox to test
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

// In wamp like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path 
// of the certificate as shown below.
// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
if( !($res = curl_exec($ch)) ) {
    // error_log("Got " . curl_error($ch) . " when processing IPN data");
    curl_close($ch);
    exit;
}
curl_close($ch);


// STEP 3: Inspect IPN validation result and act accordingly

if (strcmp ($res, "VERIFIED") == 0) {
    // check whether the payment_status is Completed
    // check that txn_id has not been previously processed
    // check that receiver_email is your Primary PayPal email
    // check that payment_amount/payment_currency are correct
    // process payment

    // assign posted variables to local variables
    $item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];
    $payment_status = $_POST['payment_status'];
    if ($_POST['mc_gross'] != NULL)
    	$payment_amount = $_POST['mc_gross'];
    else
   		$payment_amount = $_POST['mc_gross1'];
    $payment_currency = $_POST['mc_currency'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email'];
    $custom = $_POST['custom'];
    
    $order = $db->prepare("SELECT * FROM orders WHERE orderNumber=? LIMIT 1");
    $order->execute(array($custom));
    
    
    if ($order->rowCount()) {
        // update
        $rows = $order->fetchAll(PDO::FETCH_ASSOC);
        $stmtou = $db->exec("UPDATE orders SET payment = '$payment_status' WHERE orderNumber = '$custom'");
   
            $message =  "
<div>
    <h2>Thank you for your purchase!</h2>
   
    <h4>Subtotal: $$payment_amount</h4>
    
    <h3>Order Number: $custom</h3>
    
    <div>
        <a href='https://lasallepub.com/#!/download'>Download</a>
    </div>
</div>            
            ";
            
            
            $mail = new SimpleMail();
            $mail->setTo($payer_email, $payer_email)
                 ->setSubject("LaSallePub Order # $custom")
                 ->setFrom("no-reply@lasallepub.com", "No-Reply")
                 ->addMailHeader('Reply-To', "no-reply@lasallepub.com", "No-Reply")
                 ->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
                 ->addGenericHeader('Content-Type', 'text/html; charset="utf-8"')
                 ->setMessage($message)
                 ->setWrap(78);
            $send = $mail->send();
            
            echo $send;
        //$stmtou->execute(array($payment_status, $custom));
    } else {
        //insert
        //$stmtoui = $db->prepare("INSERT INTO orders(orderid, payment_status) VALUES(:field1,:field2)");
        //$stmtoui->execute(array(':field1' => $custom, ':field2' => $payment_status));
    }
    //$stmtoui = $db->prepare("INSERT INTO payments(orderid, payment_status) VALUES(:field1,:field2)");
	// Insert your actions here

} else if (strcmp ($res, "INVALID") == 0) {
    // log for manual investigation
}
?>