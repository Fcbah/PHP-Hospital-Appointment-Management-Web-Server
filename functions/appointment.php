<?php
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

function get_all_appointments($department){
    $result = scandir("db/appoints/");
    if($result != false){

        $allDepartment = $result;
        for($counter=0; $counter < count($allDepartment); $counter++){

            $currentDepartment = $allDepartment[$counter];

            if(strtolower($currentDepartment) == strtolower($department)){

                $result = scandir("db/appoints/".$department);

                if(count($result)>2){
                    return $result;
                }
            }
        }
    }
    return false;
}

function add_appointment($department, $appointObject){
    file_put_contents("db/appoints/".$department."/" . $appointObject->email . ".json",json_encode($appointObject));
}
?>