<?php 
session_start();
require_once("functions/user.php");
require_once("functions/token.php");
require_once("functions/validate.php");
require_once("functions/redirect.php");
//collecting the data
$errorCount = 0;

$first_name = $_POST['first_name'] != "" ? $_POST['first_name'] :  $errorCount++;
$last_name = $_POST['last_name'] != "" ? $_POST['last_name'] :$errorCount++;
$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;
$gender = $_POST['gender'] != "" ? $_POST['gender'] : $errorCount++;
$designation = $_POST['designation'] != "" ? $_POST['designation'] : $errorCount++;
$department = $_POST['department'] != "" ?$_POST['department'] : $errorCount++;

$_SESSION["first_name"] = $first_name;
$_SESSION["last_name"] = $last_name;
$_SESSION["email"] = $email;
//$_SESSION["password"] = $password;
$_SESSION["gender"] = $gender;
$_SESSION["designation"] = $designation;
$_SESSION["department"] = $department;


if($errorCount > 0){
    //Display proper error messages to the user
    
    //using ternary operator to simplify things 
    //conditional pluralization of "error"
    $error_msg = "You have ".$errorCount . " error".(($errorCount >1) ? "s" : "")." in your form submission";
    set_alert($error_msg, "error");
    redirect_to("register.php");
}else{
    
    //check if name contains numbers (forbidden)
    if(contain_numbers($first_name.$last_name) )
    {           
        set_alert("Your name cannot contain numbers", "error");
        redirect_to("register.php");        
    }

    
    //check if name is not too short
    if(length_too_short($first_name,2) || length_too_short($last_name,2) ){
        set_alert("Your name is too short", "error");
        redirect_to("register.php");
    }
    
    //check if email contain @ and . (required characters)
    if(!email_valid($email)){
        set_alert("Please Enter a valid Email", "error");
        redirect_to("register.php");
    }
    

    //check if email is not too short
    if(length_too_short($email,5)){
        set_alert("Your email is invalid, too short", "error");
        redirect_to("register.php");
    }


    $validityError = department_name_valid($department);
    
    if($validityError > 0){

        //using ternary operator to simplify things 
        //conditional pluralization of "error"
        $valid_err_msg = "You have ".$validityError . " invalid character".(($validityError >1) ? "s" : "")." in your department name submission";

        set_alert($valid_err_msg,"error");

        redirect_to("register.php");
    }

    //Count all users
    $allUsers = scandir("db/users/");
    $countAllUsers = count($allUsers);

    $newUserID  = $countAllUsers-1;

    $userObject =[
        "id"=> $newUserID,
        "first_name" => $first_name,
        "last_name"=> $last_name,
        "email" => $email,
        "password" => password_hash($password,PASSWORD_DEFAULT),
        "gender" => $gender,
        "designation" => $designation,
        "department" => $department,
        "reg_date_time" => explode(" ",date("Y m d h i s A"))
    ];
    

    //Check if the user already exist

    $userExist = find_user($email);

    if($userExist)
    {
        set_alert("Registration failed, User already exists", "error");

        redirect_to("register.php"); 
    }

    //save in the database
    save_user($userObject);

    //set_alert() defaults to sending message
    set_alert("Registration Succesful, You can now Login");

    redirect_to("login.php");
}// if error count > 0


?>