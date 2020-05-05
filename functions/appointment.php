<?php
require_once("validate.php");

function find_department($department){
    $result = scandir("db/appoints/");

    if($result != false){

        $allDepartment = $result;

        for($counter=0; $counter < count($allDepartment); $counter++){

            $currentDepartment = $allDepartment[$counter];

            if(strtolower($currentDepartment) == strtolower($department)){

                return $currentDepartment;
            }
        }
    }
    return false;
}

function get_appointObject($department,$appointment){
    $appointString = file_get_contents("db/appoints/".$department.'/'. $appointment);
    $appointObject = json_decode($appointString);
    return  $appointObject;
}

function find_appointment($department,$email){
    foreach(get_all_appointments($department) as $appointment){
        if(strtolower($email.".json") ==strtolower($appointment)){
            return $appointment;
        }//end if
    }//end foreach
    return false;
}
/*
Returns all pending appointments opened by the user
*/
function get_all_my_appointment_department($email){
    $valid=[];
    $count =0;

    //get_all_department() returns an array so dont be afraid
    foreach(get_all_department() as $department){
        $appointments = scandir("db/appoints/".$department);
        foreach($appointments as $appointment){
            if(strtolower($email.".json") ==strtolower($appointment)){
                $valid[$count++] = $department;
            }//end if
        }//end foreach
    }//end foreach

    return $valid;//if evaluates to false, when array is empty
}//end function

function get_all_my_unpaid_department($email){
    $valid=[];
    $count =0;
    foreach(get_all_department() as $department){
        $appointments = scandir("db/appoints/".$department);
        foreach($appointments as $appointment){
            if(strtolower($email.".json") ==strtolower($appointment)){
                $appointString = file_get_contents("db/appoints/".$department.'/'. $appointment);
                $appointObject = json_decode($appointString);
                if(appointment_unpaid($appointObject)){
                    $valid[$count++] = $department;                   
                }
            }//end if
        }//end foreach
    }//end foreach

    return $valid;//if evaluates to false, when array is empty
}
function appointment_unpaid($appointObject){
    if(!property_exists($appointObject,"status") || $appointObject->status == "unpaid"){
        return true;
    }
    return false;
}
function appointment_paid($appointObject){
    if(property_exists($appointObject,"status") && $appointObject->status == "paid"){
        return true;
    }
    return false;
}
function appointment_done($appointObject){
    if(property_exists($appointObject,"status") && $appointObject->status == "done"){
        return true;
    }
    return false;
}

function get_all_department(){
    $result = scandir("db/appoints/");
    
    $valid =[];
    if($result != false){

        $allDepartment = $result;
        $count =0;
        foreach($allDepartment as $department)
        {
            if(is_real_directory($department)){
                $valid[$count++] = $department;
            }
        }
    }
    return $valid;
}

function get_all_appointments($department){
    $result = scandir("db/appoints/");
    $valid = [];
    if($result != false){

        $allDepartment = $result;
        for($counter=0; $counter < count($allDepartment); $counter++){

            $currentDepartment = $allDepartment[$counter];

            if(strtolower($currentDepartment) == strtolower($department)){

                $appointments = scandir("db/appoints/".$department);

                if(count($result)>2){
                    $count =0;
                    foreach($appointments as $appointment)
                    {
                        if(!length_too_short($appointment,5)){
                            $valid[$count++] = $appointment;
                        }
                    }
                    return $valid;
                }
            }
        }
    }
    return $valid;
}

function add_appointment($department, $appointObject){
    file_put_contents("db/appoints/".$department."/" . $appointObject["email"] . ".json",json_encode($appointObject));
}
function update_appointment($department,$appointObject){
    file_put_contents("db/appoints/".$department."/" . $appointObject->email . ".json",json_encode($appointObject));
}
?>