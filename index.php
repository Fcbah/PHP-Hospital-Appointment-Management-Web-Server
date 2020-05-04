<?php include_once('lib/header.php');
require_once("functions/user.php");
require_once("functions/redirect.php");

if (is_loggedIn()){
    //session_destroy();//to fix a bug of intefering session on localhost testing
    //session_unset();

    //or to fix the bug I can rename the session variables with a prefix of fcb-loggedIn
    redirect_to("dashboard.php");
}?>
<div class="container">
    Welcome to SNH Hospital for the ignorant
    <br/> <hr/> 
    <p>This is a specialist hospital to cure ignorance</p>
    <p> Come as you are it is completely free!</p>
    </div>
<?php include_once('lib/footer.php');?>