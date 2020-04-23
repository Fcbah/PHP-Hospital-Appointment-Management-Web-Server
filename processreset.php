<?php
session_start();
require_once("functions/user.php");
require_once("functions/alert.php");
require_once("functions/redirect.php");
require_once("functions/token.php");
require_once("functions/email.php");

$loggedIn = false;
$errorCount = 0;

if (!is_loggedIn()){    
    $email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
    $token = $_POST['token'] != "" ? $_POST['token'] : $errorCount++;
    $_SESSION["token"] = $token;
    $_SESSION["email"] = $email;
}else{
    $loggedIn = true;
    $email = $_SESSION['email'];
}

$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;

if($errorCount > 0){
    //Display proper error messages to the user
    
    //using ternary operator to simplify things 
    //conditional pluralization of "error"
    $error_to_set = "You have ".$errorCount ." error".
    (($errorCount >1) ? "s" : "") ." in your form submission";
    set_alert($error_to_set,"error");

    redirect_to("reset.php");
}else{

    $TokenOkay = false;//initial value

    $currentTokenfile =find_token($email);

    if($currentTokenfile){
        //now check if the token in the currentTokenFile is the same as $token
        $tokencontent = file_get_contents("db/tokens/" . $currentTokenfile);
            
        $tokenObject = json_decode($tokencontent);
        $tokenFromDB = $tokenObject->token;
        $TokenOkay = $tokenFromDB == $token;
    }

    if ($loggedIn){
        $TokenOkay = true;
    }

    if($TokenOkay){

        //check if user email is valid
        $userObject = find_user($email);
        if($userObject != false){

            // Now update your password;
            $userObject->password = password_hash($password,PASSWORD_DEFAULT);

            if(!$loggedIn){
                unlink("db/tokens/".$currentTokenfile);//delete token file
            }                
            
            update_user($userObject);
            
            $subject = "Password Reset Successful";
            $message = "Your password has been successfully reset, If you did not initiate it, Contact our customer care as soon as possible";
            
            send_mail($email,$subject,$message);

            //Make loggedIn user login again
            session_unset();

            //by default sets message;
            set_alert("Password Reset Succesful, You can now Login");
            
            redirect_to("login.php");
        }
    }

    set_alert("Password Reset failed, token/email invalid or expired", "error");
    redirect_to("login.php");
}


//TODO: Ensure that you curtail the way your admin_initialize works so that in one login it updates password and at the same time logs me in.

//TODO: Redesign your library lib/AdminPassword.php to allow you to also set and change admin username 
?>