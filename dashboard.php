<?php include_once("lib/header.php");
require_once("functions/user.php");
require_once("functions/redirect.php");

if(!is_loggedIn()){
    //redirect to our login
    redirect_to("login.php");
}

if(is_patient()){
    redirect_to("patient.php");
}
else if(is_medical_team()){
    redirect_to("medical.php");
}else if(is_super_admin()){
    redirect_to("superAdmin.php");
}else{
    set_alert("You are not authorized to view that page", "error");
    redirect_to("login.php");
}
?>
<?php include_once("lib/footer.php")?>