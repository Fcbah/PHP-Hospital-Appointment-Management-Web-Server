<?php
require_once("validate.php");

function find_department($department){
    $result = scandir("db/appoints/");

    if($result != false){

        $allDepartment = $result;

        for($counter=0; $counter < count($allDepartment); $counter++){

            $currentDepartment = $allDepartment[$counter];

            if(strtolower($currentDepartment) == strtolower($department)){

                return true;
            }
        }
    }
    return false;
}

function get_appointment($department,$appointment){
    $appointString = file_get_contents("db/appoints/".$department.'/' );
    $userObject = json_decode($userString);
    return  $userObject;
}

function get_all_appointments($department){
    $result = scandir("db/appoints/");
    if($result != false){

        $allDepartment = $result;
        for($counter=0; $counter < count($allDepartment); $counter++){

            $currentDepartment = $allDepartment[$counter];

            if(strtolower($currentDepartment) == strtolower($department)){

                $appointments = scandir("db/appoints/".$department);

                if(count($result)>2){
                    $valid = [];
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
    return false;
}

function add_appointment($department, $appointObject){
    file_put_contents("db/appoints/".$department."/" . $appointObject["email"] . ".json",json_encode($appointObject));
}
?>