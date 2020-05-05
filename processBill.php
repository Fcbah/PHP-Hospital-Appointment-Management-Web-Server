<?php
session_start();
require_once("functions/redirect.php");
require_once("functions/user.php");
require_once("functions/appointment.php");
require_once("functions/transaction.php");
require_once("functions/email.php");

if (!is_loggedIn()){
    redirect_to("login.php");
}
if(!is_patient()){
    set_alert("This page is not meant for you","message");
    redirect_to("dashboard.php");
}

$amount = $_GET['amount'];
$transactionID = $_GET['txref'];
$department = $_GET['department'];
$email = $_SESSION["email"];
$department = find_department($department);

$query = array(
    "SECKEY" => "FLWSECK_TEST-c53f8c56a3b9370578de32b0293206dc-X",
    "txref" => $transactionID
);

$data_string = json_encode($query);
        
$ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify ');                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$response = curl_exec($ch);

$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$header = substr($response, 0, $header_size);
$body = substr($response, $header_size);

curl_close($ch);

$resp = json_decode($response, true);

$vamount = $resp["data"]["amount"];
$vcurrency = $resp["data"]["currency"];
$vtransactionID = $resp["data"]["txref"];
$vemail = $resp["data"]["custemail"];

if($vemail == $email && $vcurrency=="NGN" && $vamount == $amount){
    $valid = true;
}else{
    
    set_alert("This is a fraudulent action. Client data must tally with server data.","error");
        
    session_destroy();
    redirect_to("login.php");
}

/* Ensure the transaction ID has never been used before and that appointment has not been paid for.*/

$appointObject = get_appointObject($department,find_appointment($department,$email));

if(!property_exists($appointObject,"status") || $appointObject->status == "unpaid"){
    if(find_transaction_entry($transactionID)){
        set_alert("This is a fraudulent action. Every transaction must be unique.","error");
        
        redirect_to("login.php");
    }else{
        $valid = true;
    }
}else{
    set_alert("Your Transaction for appointment to ".$_GET['department']. " failed. Paid appointment already exist","error");

    redirect_to("login.php");
}



if (is_get("success") && $_GET['success'] == "true" && $valid){
    
    $appointObject->transactionID = $transactionID;
    $appointObject->status = "paid";

    update_appointment($department,$appointObject);

    $transactObj =get_transact_object($email);
    $entry =[
        "department" =>$department,
        "transactionID" => $transactionID,//or txref
        "email" => $email,
        "amount" => $amount,//Amount in Naira
        "created_date_time" => explode(" ",date("Y m d h i s A"))
    ];
    $entry = json_decode(json_encode($entry));//converting to an object

    if($transactObj){        
        array_push($transactObj->transactions,$entry);
    }else{
        $transactObj = create_transaction($email);
        array_push($transactObj->transactions,$entry);
    }
    add_transaction($transactObj);

    $masterTransact = get_transact_object();
    array_push($masterTransact->New_Transactions,$entry);
    add_transaction($masterTransact);

    /* Send success Email */
    $subject = "Transaction Successful";
    $message = "A payment of ₦". $amount ." has been succesfully received for your appointment with ". $department ." department at SNG HOSPITAL";

    $try = send_mail($email, $subject, $message);

    set_alert("Transaction for your appointment with the ".$department ." department was successfully received. ");
    redirect_to("patient.php");    

}elseif(is_get("chargeResponseMessage") && is_get("department")){
    
    set_alert("Your Transaction for appointment to ".$_GET['department']. " failed due to '".$_GET['chargeResponseMessage']."' Please try again later.","message");

    redirect_to("payBills.php");
}

//check if the appointment exist and the transaction as not been marked paid before

//check that the payment is successful

//attach transactionID to the attached appointment(s) and update appointment(s) status to paid

//create or upadate a transaction saved with email and add a transaction array entry with attached department(s), transactionID 

//create a record in the new transactions list of the master transaction. - (Also Allow super admin to wipe the list to avoid overwhelming screen data)

//send email of successful transaction.

//For handled appointments they should be moved into a folder "done" under each department. They should be renamed with transactionID.json and should have a new field for Doctor's comment. It  can only be assessed by either checking the user's list for transactionID or search each transactionID and check their status.
?>