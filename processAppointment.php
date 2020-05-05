<?php
session_start();
require_once('functions/user.php');
require_once('functions/redirect.php');
require_once('functions/alert.php');
require_once('functions/validate.php');
require_once('functions/appointment.php');



if (!is_loggedIn()){
    redirect_to("login.php");
}
if(!is_patient()){
    set_alert("This page is not meant for you","message");
    redirect_to("dashboard.php");
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

    //using ternary operator to simplify things 
    //conditional pluralization of "error"
    $error_msg = "You have ".$errorCount . " error".(($errorCount >1) ? "s" : "")." in your form submission";
    
    set_alert($error_msg,"error");
    redirect_to("bookAppointment.php");
}else{

    //ensure that department name does not contain invalid characters
    $validityError = department_name_valid($department);

    if($validityError > 0){

        //using ternary operator to simplify things 
        //conditional pluralization of "error"
        $error_msg = "You have ".$validityError . " invalid character".(($validityError >1) ? "s" : "")." in your department name submission";

        set_alert($error_msg);
        redirect_to("bookAppointment.php");
    }
    
    $appointObject =[
        "name" =>$_SESSION['fullName'],
        "date_appoint" => $date_appoint,
        "time_appoint"=> $time_appoint,
        "email" => $email,
        "nature_appoint" => $nature_appoint,
        "initial_complaint" => $initial_complaint,
        "status" => "unpaid",
        "reg_date_time" => explode(" ",date("Y m d h i s A"))
    ];

    $departmentExist = find_department($department);   
    
    if($departmentExist){
        $department = $departmentExist;
        
        $appointment = find_appointment($department,$email);
        
        if($appointment){
            $appointObject = get_appointObject($department,$appointment);

            $appointObject->date_appoint = $date_appoint;
            $appointObject->time_appoint = $time_appoint;
            $appointObject->nature_appoint = $nature_appoint;
            $appointObject->initial_complaint = $initial_complaint;

            update_appointment($department,$appointObject);
        }else{
            add_appointment($department,$appointObject);
        }
    }
    else{
        mkdir("db/appoints/".$department, 0777,true);
        add_appointment($department,$appointObject);
    }
    
    set_alert("Appointment Succesfully registered");
    redirect_to("dashboard.php");
}
?>