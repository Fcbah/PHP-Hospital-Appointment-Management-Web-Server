<?php
session_start();
require_once("lib/AdminPassword.php");
require_once("functions/redirect.php");
require_once("functions/alert.php");
require_once("functions/user.php");

$email = "admin@here.com"; //it is not case sensitive
$userObject =[
        "id"=> -1,
        "first_name" => "Admin",
        "last_name"=> "User",
        "email" => $email,
        "password" => $Admin_Password,
        "gender" => "Male",
        "designation" => "Super Admin",
        "department" => "Management",
        "reg_date_time" => explode(" ",date("Y m d h i s A"))
    ];

    save_user($userObject);
    
    //defaults to "message"
    set_alert("Admin Initialize Successful, You can now Login");
    redirect_to("login.php");
   ?> 