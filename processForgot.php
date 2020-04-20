<?php session_start();
$errorCount = 0;

$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;

$_SESSION["email"] = $email;

if($errorCount > 0){
    $_SESSION['error'] = "You have ".$errorCount . " error".(($errorCount >1) ? "s" : "")." in your form submission";
    header("Location: forgot.php");
}else{
     //Count all users
     $allUsers = scandir("db/users/");
     $countAllUsers = count($allUsers);

     //Check if the user already exist
    for($counter=0; $counter < count($allUsers); $counter++){
        $currentUser = $allUsers[$counter];
        if(strtolower($currentUser) == strtolower($email . ".json")){
            //send the email

            /*
            GENERATING TOKEN CODE STARTS
             */

            $token = "hssdfjsfssgdfgdgdssd";
            $token ="";

            $alphabets = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A', 'B', 'C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

            for($i =0; $i<26; $i++){
                //get the random number
                //get the corresponding alphabet
                //add that to the token string
                $index = mt_rand(0,count($alphabets)-1);
                $token .= $alphabets[$index];
            }

            /*
            TOKEN GENERATION ENDS
             */

            $subject = "Password Reset Link";
            $message = "A password reset has been initiated from your account, if you did not initiate this reset, please ignore this message, otherwise, visit: localhost/p/start.ng/SNH/reset.php?token=".$token;
            $headers = "From: no-reply@snh.org". " \r\n". "CC: fcbah1248@snh.org";

            file_put_contents("db/tokens/" . $email . ".json",json_encode(['token'=> $token]));

            $try = mail($email, $subject,$message, $headers);

          
            // print_r($try);
            // die();

            if($try){
                // //display a success message
                // $_SESSION["message"] = "Password reset has been sent to your email:  ". $email;
                // header("Location: login.php");

                //temporary success message
                $_SESSION['message'] = "Password reset has been sent to your email:  ". $email.' "'.$message.'" ';
                header("Location: login.php");   
            }else{
                //temporary error message
                // $_SESSION["error"] = 'Something went wrong, we could not send "'.$message.'" to : '. $email;
                // header("Location: forgot.php");
                
                //display error message
                $_SESSION["error"] = "Something went wrong, we could not send a password reset to :  ". $email;
                header("Location: forgot.php");
            }

            die();
        }
    }
}//end else errorcount > 0

$_SESSION["error"] = "Email not registered with us ";
header("Location: forgot.php");
?>