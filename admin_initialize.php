<?php
require("lib/AdminPassword.php");
$email = "admin@here.com";
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

    file_put_contents("db/users/" . $email . ".json",json_encode($userObject));
    $_SESSION["message"] = "Admin Initialize Succesful, You can now Login";
    header("Location: login.php");
   ?> 