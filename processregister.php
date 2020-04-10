<?php 
session_start();
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
    //
    $_SESSION['error'] = "You have ".$errorCount . " error".(($errorCount >1) ? "s" : "")." in your form submission";
    header("Location: register.php");
}else{
    //Count all users
    $allUsers = scandir("db/users/");
    $countAllUsers = count($allUsers);
    
    $nums = ["0","1","2","3","4","5","6","7","8","9"];
    foreach( $nums as $num)
    {
        if(count(explode($num,$first_name.$last_name))>1)
        {           
            $_SESSION['error'] = "Your name cannot contain numbers";
            header("Location: register.php");
            die();        
        }
    }
    if(strlen($first_name)< 2 || strlen($last_name)<2){
        $_SESSION['error'] = "Your name is too short";
        header("Location: register.php");
        die();
    }

    $nums = ["@","."];
    foreach( $chars as $char)
    {
        if(count(explode($char,$email))!=2)
        {           
            $_SESSION['error'] = "Please Enter a valid Email";
            header("Location: register.php");
            die();        
        }
    }
    if(strlen($email)< 5){
        $_SESSION['error'] = "Your email is invalid, too short";
        header("Location: register.php");
        die();
    }

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
    for($counter=0; $counter < count($allUsers); $counter++){
        $currentUser = $allUsers[$counter];
        if($currentUser == $email . ".json"){
            $_SESSION["error"] = "Registration failed, User already exists";
            header("Location: register.php");
            die(); 
        }
    }
   
    // *** Count all the users,
    // *** assign the next id to the new user
    // Count ($users) => 1, next user should then be Id = 2

    //save in the database
    file_put_contents("db/users/" . $email . ".json",json_encode($userObject));
    $_SESSION["message"] = "Registration Succesful, You can now Login";
    header("Location: login.php");
}// if error count > 0


?>