<?php

namespace App\CustomLibrary;

use Illuminate\Support\Facades\URL;
use Exception;

class Paypal {
    
    /**
     *Used to hold paypal url
     * @var type 
     */
    private $paypal_url;
    
    public $account_email = null;
    public $is_test_account = false;
    public $debug_mode = false;
    public $ipn_log_file_path = null;






    private $last_error;                 // holds the last error encountered
    private $ipn_log;                    // bool: log IPN results to text file?
    private $ipn_log_file;               // filename of the IPN log
    private $ipn_response;               // holds the IPN response from paypal   
    public $ipn_data = array();         // array contains the POST values for IPN
    public $fields = array();           // array holds the fields to submit to paypal
    
//     $payment_data = [
//            'email'=>'addr24test@gmail.com'
//        ];
//        $invoice_id = time();  
//        
//        $paypal = new Paypal(array(
//            'account_email' => 'addr24test@gmail.com',
//            'is_test_account' => true,
//            'debug_mode' => true,
//            'ipn_log_file_path' => 'paypal_ipn.log',
//        ));
//
//        $paypal->add_field('image_url', Url::to('test.jpg'));
//        $paypal->add_field('return', Url::to('paypal-checkout-complete/'.$locale)); // return url
//        $paypal->add_field('cancel_return', Url::to('paypal-checkout-cancel/'.$locale)); // cancel url
//        $paypal->add_field('notify_url', Url::to('paypal-validate-ipn/'.$locale)); // notify url
//        $paypal->add_field('currency_code', 'USD');
//        $paypal->add_field('business',$payment_data['email']);
//        $paypal->add_field('item_name','Rice Cooker');
//        $paypal->add_field('amount','1000');
//        $paypal->add_field('first_name','Samsher');
//        $paypal->add_field('last_name',"Rana");
//        $paypal->add_field('custom','mail4mytesting@gmail.com');
//        $paypal->add_field('quantity', 1);
//        $paypal->add_field('invoice',$invoice_id);
//        $paypal->add_field('charset', 'utf-8');
//        
//        return $paypal->form_submit(); // submit the fields to paypal
    function __construct($config_array = array()) {
        
        $config_error = '';
        if(isset($config_array['account_email'])){
            $this->account_email = $config_array['account_email'];
        }else{
            $config_error .="<b style=\"color:#f00\">Paypal Account Email \"account_email\" is missing.</b><br>";
        }
        if(isset($config_array['is_test_account'])){
            $this->is_test_account = $config_array['is_test_account'];
        }else{
            $config_error .="<b style=\"color:#f00\">\"is_test_account\" is missing.</b><br>";
        }
        if(isset($config_array['debug_mode'])){
            $this->debug_mode = $config_array['debug_mode'];
        }else{
            $config_error .="<b style=\"color:#f00\">\"debug_mode\" is missing.</b><br>";
        }
        if(isset($config_array['ipn_log_file_path'])){
            $this->ipn_log_file_path = $config_array['ipn_log_file_path'];
        }else{
            $config_error .="<b style=\"color:#f00\">\"ipn_log_file_path\" is missing.</b><br>";
        }
        if($config_error != ''){
            $config_error = '<b style="color:#f00">Invalid Parameters:</b><br>'.$config_error;
            $config_error .= "<b style=\"color:#087b7b\">Following is the example of parameter for constructor</b><br>";
            $config_error .= '<span style="color:#0ca51f">'.str_repeat ('&nbsp;',4)."\$paypal = new Paypal(array(</span><br>";
            $config_error .= '<span style="color:#0ca51f">'.str_repeat ('&nbsp;',30)."'account_email' => 'some_email@gmail.com',</span><br>";
            $config_error .= '<span style="color:#0ca51f">'.str_repeat ('&nbsp;',30)."'is_test_account' => true,</span><br>";
            $config_error .= '<span style="color:#0ca51f">'.str_repeat ('&nbsp;',30)."'debug_mode' => true,</span><br>";
            $config_error .= '<span style="color:#0ca51f">'.str_repeat ('&nbsp;',30)."'ipn_log_file_path' => 'paypal_ipn.log',</span><br>";
            $config_error .= '<span style="color:#0ca51f">'.str_repeat ('&nbsp;',4)."));</span>";
            exit($config_error);
            
        }
        
        
        if($this->is_test_account){
            $this->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';// testing paypal url
        }else{  
            $this->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';// paypal url
        }
        
        $this->add_field('rm', '2');// return method = POST
        $this->add_field('cmd', '_xclick');
    }

    function add_field($field, $value) {

        $this->fields["$field"] = $value;
    }
    /**
     * <b>Used to generates entire HTML page with hidden input elements<b>
     * <li>User will see a short message like "Please wait, your order is being processed..." on the screen </li>
     * <li>and then it is immediately redirected to paypal</li>
     * @return string
     */
    public function form_submit() {
        
        $form_data = '';
        $form_data .= '<html>'.PHP_EOL;
        //$form_data.= '<head><title>Processing Payment...</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>'.PHP_EOL;
        $form_data .= '<body onLoad="document.forms[\'paypal_form\'].submit();">'.PHP_EOL;
        $form_data .= '<center><h2>Please wait, your order is being processed and you will be redirected to the paypal website.</h2></center>'.PHP_EOL;
        $form_data .= '<form method="post" name="paypal_form" action="' . $this->paypal_url . '">'.PHP_EOL;
        foreach ($this->fields as $name => $value) {
            $form_data .= '<input type="hidden" name="'.$name.'" value="'.$value.'"/>'.PHP_EOL;
        }
        $form_data .= '<input type="hidden" name="cbt" value="Continue >>">';
        $form_data .= '<center><br/><br/>If you are not automatically redirected to paypal within 5 seconds...';
        $form_data .= '<br/><br/>'.PHP_EOL;
        $form_data .= '<input type="submit" value="CLICK HERE"></center>'.PHP_EOL;
        $form_data .= '</form>'.PHP_EOL;
        $form_data .= '</body></html>'.PHP_EOL;
        
        return $form_data;
    }
    public function get_fields(){
        return $this->fields;
    }
    public function run_ipn_validation($data,$debug_mode,$test_account,$email_param){
        
        //business email id
        //$paypal_account="sujit1_1189237769_biz@viewnepal.net";
        $paypal_account = "rubids@emts.com";
        $notify_email = "sujit2039@gmail.com"; //"sujit2039@gmail.com";
        $headers = "From: admin@emultitechsolution.com";
        $from = 'Emultitechsolution Pvt. Ltd.';
        //mail($notify_email,'NST test','test',$headers);
        // CONFIG: Enable debug mode. This means we'll log requests into 'ipn.log' in the same directory.
        // Especially useful if you encounter network errors or other intermittent problems with IPN (validation).
        // Set this to 0 once you go live or don't require logging.
        define("DEBUG", 1);
        // Set to 0 once you're ready to go live
        define("USE_SANDBOX", 1);
        define("LOG_FILE", "./ipn.log");
        
        
        
        
       
        // Read POST data
        // reading posted data directly from $_POST causes serialization
        // issues with array data in POST. Reading raw POST data from input stream instead.
        $raw_post_data = file_get_contents('php://input');
        
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
            $keyval = explode('=', $keyval);
            if (count($keyval) == 2)
                $myPost[$keyval[0]] = urldecode($keyval[1]);
        }
        // read the post from PayPal system and add 'cmd'
        $req = 'cmd=_notify-validate';
        if (function_exists('get_magic_quotes_gpc')) {
            $get_magic_quotes_exists = true;
        }
        foreach ($myPost as $key => $value) {
            if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
            } else {
                $value = urlencode($value);
            }
            $req .= "&$key=$value";
        }
        // Post IPN data back to PayPal to validate the IPN data is genuine
        // Without this step anyone can fake IPN data
        if (USE_SANDBOX == true) {
            $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
        } else {
            $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
        }
        $ch = curl_init($paypal_url);
        if ($ch == FALSE) {
            return FALSE;
        }
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if (DEBUG == true) {
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        }
        // CONFIG: Optional proxy configuration
        //curl_setopt($ch, CURLOPT_PROXY, $proxy);
        //curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
        // Set TCP timeout to 30 seconds
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        // CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
        // of the certificate as shown below. Ensure the file is readable by the webserver.
        // This is mandatory for some environments.
        //$cert = __DIR__ . "./cacert.pem";
        //curl_setopt($ch, CURLOPT_CAINFO, $cert);
        $res = curl_exec($ch);
        if (curl_errno($ch) != 0) { // cURL error
            if (DEBUG == true) {
                error_log(date('[Y-m-d H:i e] ') . "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
            }
            curl_close($ch);
            exit;
        } else {
            // Log the entire HTTP response if debug is switched on.
            if (DEBUG == true) {
                error_log(date('[Y-m-d H:i e] ') . "HTTP request of validation request:" . curl_getinfo($ch, CURLINFO_HEADER_OUT) . " for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
                error_log(date('[Y-m-d H:i e] ') . "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);
            }
            curl_close($ch);
        }
// Inspect IPN validation result and act accordingly
// Split response headers and payload, a better way for strcmp
        $tokens = explode("\r\n\r\n", trim($res));
        $res = trim(end($tokens));
        
        if (strcmp($res, "VERIFIED") == 0) {
            // check whether the payment_status is Completed
            // check that txn_id has not been previously processed
            // check that receiver_email is your PayPal email
            // check that payment_amount/payment_currency are correct
            // process payment and mark item as paid.
            // assign posted variables to local variables
            
            $item_name = $_POST['item_name'];
            $business = $_POST['business'];
            $item_number = $_POST['item_number'];
            $payment_status = $_POST['payment_status'];
            $mc_gross = number_format($_POST['mc_gross'], 2, ".", '');
            $payment_currency = $_POST['mc_currency'];
            $txn_id = $_POST['txn_id'];
            $receiver_email = $_POST['receiver_email'];
            $receiver_id = $_POST['receiver_id'];
            $quantity = $_POST['quantity'];
            $num_cart_items = $_POST['num_cart_items'];
            $payment_date = $_POST['payment_date'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $payment_type = $_POST['payment_type'];
            $payment_status = $_POST['payment_status'];
            $payment_gross = $_POST['payment_gross'];
            $payment_fee = $_POST['payment_fee'];
            $settle_amount = $_POST['settle_amount'];
            $memo = $_POST['memo'];
            $payer_email = $_POST['payer_email'];
            $txn_type = $_POST['txn_type'];
            $payer_status = $_POST['payer_status'];
            $address_street = $_POST['address_street'];
            $address_city = $_POST['address_city'];
            $address_state = $_POST['address_state'];
            $address_zip = $_POST['address_zip'];
            $address_country = $_POST['address_country'];
            $address_status = $_POST['address_status'];
            $item_number = $_POST['item_number'];
            $tax = number_format($_POST['tax'], 2, ".", '');
            $option_name1 = $_POST['option_name1'];
            $option_selection1 = $_POST['option_selection1'];
            //$option_name2 = $_POST['option_name2'];
            $option_selection2 = $_POST['option_selection2'];
            $for_auction = $_POST['for_auction'];
            $invoice = $_POST['invoice'];
            $custom = $_POST['custom'];
            $notify_version = $_POST['notify_version'];
            $verify_sign = $_POST['verify_sign'];
            $payer_business_name = $_POST['payer_business_name'];
            $payer_id = $_POST['payer_id'];
            $mc_currency = $_POST['mc_currency'];
            $mc_fee = number_format($_POST['mc_fee'], 2, ".", '');
            $exchange_rate = $_POST['exchange_rate'];
            $settle_currency = $_POST['settle_currency'];
            $parent_txn_id = $_POST['parent_txn_id'];
            $pending_reason = $_POST['pending_reason'];
            //mail($notify_email, "VERIFIED", "$res\n $req\n ",$headers);	
            // PAYMENT VALIDATED & VERIFIED!  
            if ($payment_status == 'Completed') { //check if the transaction status is completed or not
                //mail($notify_email, $member_id."=Completed", "$res\n $req\n ",$headers);	
                
                
                if (trim($business) == trim($paypal_account)) { //checking the business email address and   //mail($notify_email, "Business Email Verify", "$res\n $req\n ",$headers);	
                    
                    
                    $this->load->library('email');
                    $config['smtp_user'] = "emts.testers@gmail.com";
                    $config['smtp_pass'] = "emts5526001";
                    $config['charset'] = "utf-8";
                    $config['mailtype'] = "html";
                    $config['newline'] = "\r\n";
                    
                    $payied_amount = "$mc_currency$mc_gross";
                    //send email to buyer
                    $buyer_body = "<p>Thank you for your purchase script!</p>";
                    $buyer_body .= "<p>Order number is: $invoice</p>";
                    $buyer_body .= "<p>Script Name:$item_name</p>";
                    $buyer_body .= "<p>Amount:$payied_amount</p>";
                    $buyer_body .= "<p>Our team will contact you within 24 hours!</p>";
                    $buyer_body .= "<p>Regards,</p>";
                    $buyer_body .= "<p>Emultitechsolution Pvt. Ltd.</p>";
                    
                    //$buyer_body = json_encode($_POST);
                    
                    $this->email->initialize($config);
                    $this->email->from($notify_email,$from);
                    //$this->email->to($payer_email);
                    $this->email->to($custom);
                    $this->email->subject("E-multitechsolution - Purchase " . $item_name);
                    $this->email->message($buyer_body);
                    $this->email->send();
                    
                    //send mail to admin
                    $admin_body = "<p>Thank you for your purchase script!</p>";
                    $admin_body .= "<p>Order number is: $invoice</p>";
                    $admin_body .= "<p>Transaction Id is: $parent_txn_id</p>";
                    $admin_body .= "<p>First Name:$first_name</p>";
                    $admin_body .= "<p>Last Name:$last_name</p>";
                    $admin_body .= "<p>Email:$custom</p>";
                    $admin_body .= "<p>Payer Email:$payer_email</p>";
                    $admin_body .= "<p>Script Name:$item_name</p>";
                    $admin_body .= "<p>Amount:$payied_amount</p>";
                    $admin_body .= "<p>Regards,</p>";
                    $admin_body .= "<p>Emultitechsolution Pvt. Ltd.</p>";
                    
                    $this->email->initialize($config);
                    $this->email->from($notify_email,$from);
                    $this->email->to($notify_email);
                    $this->email->subject("E-multitechsolution - Purchase " . $item_name);
                    $this->email->message($admin_body);
                    $this->email->send();
                    
                } else { // if business is not our paypal account
                    //suspicious transaction notify from the email and go for manual investigation
                    mail($notify_email, "Invalid Business Account" . $business . "==" . $paypal_account, "$res\n $req\n ", $headers);
                }
            } else if ($payment_status == 'Refunded') {
                mail($notify_email, "Refunded", "$res\n $req\n ", $headers);
            } else if ($payment_status == 'Pending') {
                mail($notify_email, "Pending", "$res\n $req\n ", $headers);
            } else {
                //send the email to the adminnistrator
                mail($notify_email, "UnCompleted Transaction", "$res\n $req\n ", $headers);
            }
            if (DEBUG == true) {
                error_log(date('[Y-m-d H:i e] ') . "Verified IPN: $req " . PHP_EOL, 3, LOG_FILE);
            }
        } else if (strcmp($res, "INVALID") == 0) {
            // log for manual investigation
            // Add business logic here which deals with invalid IPN messages
            if (DEBUG == true) {
                error_log(date('[Y-m-d H:i e] ') . "Invalid IPN: $req" . PHP_EOL, 3, LOG_FILE);
            }
        }
    }

}
