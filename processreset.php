<?php
session_start();
// print_r($_POST); This is to

$errorCount = 0;

$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;
$token = $_POST['token'] != "" ? $_POST['token'] : $errorCount++;

$_SESSION["token"] = $token;
$_SESSION["email"] = $email;

if($errorCount > 0){
    //Display proper error messages to the user
    //
    $_SESSION['error'] = "You have ".$errorCount ." error".
    (($errorCount >1) ? "s" : "")   //using ternary operator to simplify things
    ." in your form submission";

    header("Location: register.php");
}else{
    //TODO: actual reset things here

    //check that the email is registered in token folder
    //check if the token registered token in our folder is the same with supplied.

    //Count all users
    $allUserTokens = scandir("db/tokens/");
    $countAllUserTokens = count($allUserTokens);

    for($counter=0; $counter < count($allUserTokens); $counter++){

        $currentTokenfile = $allUserTokens[$counter];
        
        //Email is not CASE SENSITIVE use strtolower to avoid duplication
        if(strtolower($currentTokenfile) == strtolower($email . ".json")){
            //now check if the token in the currentTokenFile is the same as $token
            $tokencontent = file_get_contents("db/tokens/" . $email . ".json");
            
            $tokenObject = json_decode($tokencontent);
            $tokenFromDB = $tokenObject->token;

            if($tokenFromDB == $token){
                echo "User can update password";
            }

            die(); 
        }
    }
    $_SESSION["message"] = "Password Reset failed, token/email invalid or expired";
    header("Location: login.php");
}
?>