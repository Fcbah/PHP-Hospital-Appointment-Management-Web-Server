<?php
//collecting the data

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$designation = $_POST['designation'];
$department = $_POST['department'];

$errorArray = [];
//Verifying the data, validation

$ct = 0;
if($first_name == ""){
    $errorArray[$ct] = "First_name cannot be blank";
}
//saving the data into the database (folder)

//return back to the page, with a status message
?>