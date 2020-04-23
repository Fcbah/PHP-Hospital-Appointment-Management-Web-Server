<?php session_start();
require_once('functions/user.php');
require_once('functions/redirect.php');
require_once('functions/alert.php');
require_once('functions/token.php');
require_once('functions/email.php');

$errorCount = 0;

$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;

$_SESSION["email"] = $email;

if($errorCount > 0){
    $error_msg = "You have ".$errorCount . " error".(($errorCount >1) ? "s" : "")." in your form submission";

    set_alert($error_msg,"error");
    redirect_to("forgot.php");
}else{
    
    $userExist = find_user($email);

    if($userExist){
        $token = token_generate();

        save_token($email, json_encode(['token'=> $token]));

        /*
        The remaining lines is all about sending the email notification and redirecting to login page.
        */


        //To ensure that the reset link is point to the right location 
        //even though the domain name of the server is changed.
        $server = dirname($_SERVER['HTTP_REFERER']);

        $subject = "Password Reset Link";
        $message = "A password reset has been initiated from your account, if you did not initiate this reset, please ignore this message, otherwise, visit: ". $server."/reset.php?token=".$token;

        $try = send_mail($email, $subject, $message);

        if($try){
            // //display a success message
            // set_alert("Password reset has been sent to your email: ". $email);
            // redirect_to("login.php");

            //temporary_success_message
            set_alert("Password reset has been sent to your email: ". $email.' "'.$message.'" ');
            redirect_to("login.php");

        }else{
            set_alert("Something went wrong, we could not send a password reset to : ". $email, "error");
            redirect_to("login.php");
        }

    }//end if email is registered
}//end else errorcount > 0

set_alert("Email not registered with us ","error");
redirect_to("forgot.php");
?>