<?php
session_start();

if (!isset($_SESSION["loggedIn"]) || empty($_SESSION["loggedIn"])){
    header("Location: login.php");
    die();
}
if(!isset($_SESSION["role"]) || $_SESSION["role"] != "Patients"){
    $_SESSION["error"] = "You are not authorized to view that page";
        header("Location: login.php");
        die();
}

//collecting the data
$errorCount = 0;

$email = $_SESSION['email'] != "" ? $_SESSION['email'] : $errorCount++;
$department = $_POST['department'] != "" ? $_POST['department'] : $errorCount++;
$date_appoint = $_POST['date_appoint'] != "" ? $_POST['date_appoint'] : $errorCount++;
$time_appoint = $_POST['time_appoint'] != "" ? $_POST['time_appoint'] : $errorCount++;
$nature_appoint = $_POST['nature_appoint'] != "" ? $_POST['nature_appoint'] : $errorCount++;
$initial_complaint = $_POST['initial_complaint'] != "" ?$_POST['initial_complaint'] : $errorCount++;

//$_SESSION["department"] = $department;
$_SESSION["date_appoint"] = $date_appoint;
$_SESSION["time_appoint"] = $time_appoint;
$_SESSION["nature_appoint"] = $nature_appoint;
$_SESSION["initial_complaint"] = $initial_complaint;


if($errorCount > 0){
    $_SESSION['error'] = "You have ".$errorCount . " error".(($errorCount >1) ? "s" : "")." in your form submission";
    header("Location: bookAppointment.php");
}else{

    //ensure that department does not contain invalid characters
    //because you will use it to create filename for appointments
    $valid = "abcdefghijklmnopqrstuvwxyz_-ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $validityError = 0;
    foreach(str_split($department) as $inp){
        if(strpos($valid,$inp) === false){
            $validityError++;            
        }
    }

    if($validityError > 0){
        $_SESSION['error'] = "You have ".$validityError . " invalid character".(($validityError >1) ? "s" : "")." in your department name submission";
            header("Location: bookAppointment.php");
            die();
    }
    
    $appointObject =[
        "date_appoint" => $date_appoint,
        "time_appoint"=> $time_appoint,
        "email" => $email,
        "nature_appoint" => $nature_appoint,
        "initial_complaint" => $initial_complaint,
        "reg_date_time" => explode(" ",date("Y m d h i s A"))
    ];

    $departmentExist = false;
    $result = scandir("db/appoints/");
    if($result != false){
        $allDepartment = $result;
        for($counter=0; $counter < count($allDepartment); $counter++){
            $currentDepartment = $allDepartment[$counter];
            if(strtolower($currentDepartment) == strtolower($department)){
                $departmentExist = true;
            }
        }
    }//end result
    
    
    if($departmentExist){
        file_put_contents("db/appoints/".$department."/" . $email . ".json",json_encode($appointObject));
        echo "directory dey";
    }
    else{
        mkdir("db/appoints/".$department, 0777,true);
        echo("No directory");
        file_put_contents("db/appoints/".$department."/" . $email . ".json",json_encode($appointObject));
    }
    $_SESSION["message"] = "Appointment Succesful registered";
    header("Location: dashboard.php");
}
?>