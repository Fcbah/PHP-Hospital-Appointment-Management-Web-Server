<?php
session_start();
require_once("functions/user.php");
require_once("functions/alert.php");
require_once("functions/redirect.php");

$errorCount = 0;

$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;

$_SESSION["email"] = $email;

if($errorCount > 0){
    //Display proper error messages to the user
    
    //using ternary operator to simplify things 
    //conditional pluralization of "error"
    set_alert("You have ".$errorCount . " error". (($errorCount >1 ) ? "s": "") ." in your login details","error");
    redirect_to("login.php");
}

$userObject = find_user($email);

if ($userObject){
    $pass4rmdb = $userObject->password;
        
    if(password_verify($password,$pass4rmdb)){
        $_SESSION['loggedIn'] = $userObject->id;
        $_SESSION["fullName"] = $userObject->first_name. " " . $userObject->last_name; 
        $designat = $_SESSION["role"] = $userObject->designation;
        $userObject->{"last_login"} = explode(" ",date("Y m d h i s A"));
        $_SESSION["reg_date_time"] = $userObject->reg_date_time;
        $_SESSION["last_login"] = $userObject->last_login;
        $_SESSION["department"] = $userObject->department;
        
        if(is_patient()){
            update_user($userObject);        
            redirect_to("patient.php");            
        }
        else if(is_medical_team()){
            update_user($userObject);
            redirect_to("medical.php");
        }else if(is_super_admin()){
            update_user($userObject);
            redirect_to("superAdmin.php");         
        }else{
            set_alert("Invalid user, with invalid designation","error");
            redirect_to("register.php");
        }
        
    }else{

        //To check if admin password has been changed in server files.
        if(strtolower($email) == strtolower("Admin@here.com")){
           redirect_to("admin_initialize.php");
        }else{
            set_alert("Wrong Email or PassWord","error");
            redirect_to("login.php");
        }
    }
}        

//Incase the admin user has not been initialized at all
if(strtolower($email) == strtolower("Admin@here.com")){
    redirect_to("admin_initialize.php");
}


set_alert("Invalid Email or PassWord","error");
redirect_to("login.php");

?>