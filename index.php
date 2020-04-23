<?php include_once('lib/header.php');
require_once("functions/user.php");
require_once("functions/redirect.php");

if (is_loggedIn()){
    redirect_to("dashboard.php");
}?>
    Welcome to SNH Hospital for the ignorant
    <br/> <hr/> 
    <p>This is a specialist hospital to cure ignorance</p>
    <p> Come as you are it is completely free!</p>
<?php include_once('lib/footer.php');?>