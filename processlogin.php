<?php
session_start();

$errorCount = 0;

$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;

$_SESSION["email"] = $email;

if($errorCount > 0){
    //Display proper error messages to the user
    //
    $_SESSION['error'] = "You have ".$errorCount . " error". (($errorCount >1 ) ? "s": "") ." in your login details";
    header("Location: login.php");
}else{
    echo "No errors";
}

$allUsers = scandir("db/users/");
if(strtolower($email)  == strtolower("Admin@here.com")){
    require("lib/AdminPassword.php");
    if(password_verify($password,$Admin_Password)){
        $_SESSION["Mode"] = "SuperAdmin";
        header("Location: superAdmin.php");
        die();                   
    }     
}

for($counter=0; $counter < count($allUsers); $counter++){
    $currentUser = $allUsers[$counter];
    if($currentUser == $email . ".json"){
        $userString = file_get_contents("db/users/".$currentUser );
        $userObject = json_decode($userString);
        $pass4rmdb = $userObject->password;
        
        if(password_verify($password,$pass4rmdb)){
            $_SESSION['loggedIn'] = $userObject->id;
            $_SESSION["fullName"] = $userObject->first_name. " " . $userObject->last_name; 
            $designat = $_SESSION["role"] = $userObject->designation;
            if($desginat == "Patient"){
                header("Location: patient.php");
            }
            else if($designat == "Medical Team (MT)"){
                header("Location: medical.php");
            }else{
                session_unset();
                $_SESSION["error"] = "Invalid user, with invalid designation";
                header("Location: register.php");
            }
            die();
        }
        else{
            $_SESSION["error"] = "Wrong Email or PassWord";
            header("Location: login.php");
            die();
        }
           
    }
}

$_SESSION["error"] = "Invalid Email or PassWord";
header("Location: login.php");
die(); 

?>