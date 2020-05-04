<?php
require_once("functions/redirect.php");
require_once("functions/user.php");

print_r($_GET);
die();

if (is_get("failure")){
    redirect_to("patient.php?From=failure");
}else{
    redirect_to("payBills.php?From=No_get_0");
}
//check that the payment is successful



// create transaction and add to the transaction list and attach to the list of appointmentID
//if I had book appointment with a department before and it is not yet handled, it would only update the content but the appointment ID will not change.back
//The last appointmentID must be stored in the user db and in the session variable.
//
?>