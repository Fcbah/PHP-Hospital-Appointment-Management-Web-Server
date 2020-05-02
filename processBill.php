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

?>