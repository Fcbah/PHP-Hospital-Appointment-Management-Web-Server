<?php
session_start();
require_once("functions/user.php");
require_once("functions/alert.php");

$loggedIn = false;

if (!is_loggedIn()){    
    $email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
    $token = $_POST['token'] != "" ? $_POST['token'] : $errorCount++;
    $_SESSION["token"] = $token;
    $_SESSION["email"] = $email;
}else{
    $loggedIn = true;
    $email = $_SESSION['email'];
}

$errorCount = 0;


$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;



if($errorCount > 0){
    //Display proper error messages to the user
    
    //using ternary operator to simplify things 
    //conditional pluralization of "error"
    $error_to_set = "You have ".$errorCount ." error".
    (($errorCount >1) ? "s" : "") ." in your form submission";
    set_alert($error_to_set,"error");

    header("Location: reset.php");
}else{    
    //Count all users
    $allUserTokens = scandir("db/tokens/");
    $countAllUserTokens = count($allUserTokens);
    $TokenOkay = false;

    for($counter=0; $counter < $countAllUserTokens; $counter++){

        $currentTokenfile = $allUserTokens[$counter];
        
        //Email is not CASE SENSITIVE use strtolower to avoid duplication
        if(strtolower($currentTokenfile) == strtolower($email . ".json")){

            //now check if the token in the currentTokenFile is the same as $token
            $tokencontent = file_get_contents("db/tokens/" . $email . ".json");
            
            $tokenObject = json_decode($tokencontent);
            $tokenFromDB = $tokenObject->token;
            $TokenOkay = $tokenFromDB == $token;
        }//end if
    }//end for

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
            $headers = "From: no-reply@snh.org". " \r\n". "CC: fcbah1248@snh.org";
            
            $try = mail($email, $subject,$message, $headers);

            //Make loggedIn user login again
            session_unset();

            //by default sets message;
            set_alert("Password Reset Succesful, You can now Login");
            
            header("Location: login.php");
            die();
        }//end if user is found
    }//end if token matches        

    set_alert("Password Reset failed, token/email invalid or expired", "error");
    header("Location: login.php");
}//end else error Count

//TODO: Ensure that register page allows super admin to register and does not redirect to home page

//TODO: Ensure that you curtail the way your admin_initialize works so that in one login it updates password and at the same time logs me in.

//TODO: Redesign your library lib/AdminPassword.php to allow you to also set and change admin username and set project address e.g. set to /localhost --because of the password reset link. So that you don't send the wrong link to the user. and get 404 error.

//TODO: Word your work with comments. Over Saturate it if possible. When xyluz gets to a point and is getting  confused the first thing he does is read comments in that area. And remove all the useless commented text and rename your variables and parameters to easy names.
?>