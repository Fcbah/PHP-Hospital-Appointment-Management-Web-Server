<?php
session_start();
$loggedIn = false;

if (!isset($_SESSION['loggedIn']) || empty($_SESSION['loggedIn'])){    
    $email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
    $token = $_POST['token'] != "" ? $_POST['token'] : $errorCount++;
}else{
    $loggedIn = true;
    $email = $_SESSION['email'];
}

$errorCount = 0;


$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;

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
        // echo "User can update password";
        
        $allUsers = scandir("db/users/");

        for($counter=0; $counter < count($allUsers); $counter++){
            $currentUser = $allUsers[$counter];
            if(strtolower($currentUser) == strtolower($email . ".json")){
                $userString = file_get_contents("db/users/".$currentUser );
                $userObject = json_decode($userString);
                $userObject->password = password_hash($password,PASSWORD_DEFAULT);

                file_put_contents("db/users/".$currentUser,json_encode($userObject));

                if(!$loggedIn){
                    unlink("db/tokens/".$currentTokenfile);//delete file
                }                
                
                file_put_contents("db/users/".$currentUser,json_encode($userObject));
                
                $subject = "Password Reset Successful";
                $message = "A password reset has been successfully initiated from your account, if you did not initiate this reset, please ignore this message, otherwise, visit: localhost/p/start.ng/SNH/reset.php?token=".$token;
                $headers = "From: no-reply@snh.org". " \r\n". "CC: fcbah1248@snh.org";

                file_put_contents("db/tokens/" . $email . ".json",json_encode(['token'=> $token]));

            $try = mail($email, $subject,$message, $headers);

                //Make loggedIn user login again
                session_unset();

                $_SESSION["message"] = "Password Reset Succesful, You can now Login";
                header("Location: login.php");




                die();
            }//end if
        }//end for
    }            

    $_SESSION["message"] = "Password Reset failed, token/email invalid or expired";
    header("Location: login.php");
}//end else error Count

//TODO: Ensure that register page allows super admin to register and does not redirect to home page

//TODO: Ensure that you curtail the way your admin_initialize works so that in one login it updates password and at the same time logs me in.

//TODO: Redesign your library lib/AdminPassword.php to allow you to also set and change admin username and set project address e.g. set to /localhost --because of the password reset link. So that you don't send the wrong link to the user. and get 404 error.

//TODO: Word your work with comments. Over Saturate it if possible. When xyluz gets to a point and is getting  confused the first thing he does is read comments in that area. And remove all the useless commented text and rename your variables and parameters to easy names.
?>