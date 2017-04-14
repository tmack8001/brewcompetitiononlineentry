<?php
// PayPal settings
$paypal_email = $_POST['business'];
$return_url = $_POST['return'];
$cancel_url = $_POST['cancel_return'];
$notify_url = $base_url."ppv.php";
$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
// $paypal_url = "https://www.paypal.com/cgi-bin/webscr";

$item_name = $_POST['item_name'];
$item_amount = $_POST['amount'];

// Include Functions
// include("../sections/functions.php");

// ---------------------------- Check if paypal request or response  ---------------------------

// Request payment

$query_string = "";
	
// Append PayPal account to querystring
$query_string .= "?business=".urlencode($paypal_email)."&";

// Loop for posted values and append to querystring
foreach($_POST as $key => $value){
	if (($key != "cancel_return") && ($key != "return")) {
		$value = urlencode(stripslashes($value));
		$query_string .= "$key=$value&";
	}
}

// Append paypal return addresses
$query_string .= "return=".urlencode(stripslashes($return_url))."&";
$query_string .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
$query_string .= "notify_url=".urlencode($notify_url);

// Redirect to PayPal IPN
header(sprintf('location:%s%s',$paypal_url,$query_string));
exit();

?>
