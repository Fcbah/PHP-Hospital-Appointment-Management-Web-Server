<?php
$time = date("Y m d h:i:sa");
$userObject =[
        "id"=> 3,
        "first_name" => "noah",
        "last_name"=> "Akinls",
        "email" => "valast@gmail.com",
        "password" => password_hash("1234",PASSWORD_DEFAULT),
        "gender" => "Male",
        "designation" => "Patient",
        "department" => "Consultant",
        "reg_Year" => date("Y")
    ];
print_r($userObject);
    ?>