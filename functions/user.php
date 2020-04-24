<?php 
require_once("alert.php");
require_once("validate.php");


//check if a provided session variable is set
function is_session($parameter){
    return (isset($_SESSION[$parameter]) && !empty($_SESSION[$parameter]));
}

//checks if a provide form get variable is set
function is_get($parameter){
    return (isset($_GET[$parameter]) && !empty($_GET[$parameter]));
}

//checks if a user is logged in
function is_loggedIn(){
    return is_session("loggedIn");
}

function is_role($role){
    return is_session('role') && ($_SESSION["role"] == $role);
}

function is_super_admin(){
    return is_role("Super Admin");
}

function is_patient(){
    return is_role("Patients");
}

function is_medical_team(){
    return is_role("Medical Team (MT)");
}

//checks if token is set
function is_token_set(){
    return is_get_token_set() || is_session_token_set();
}

//checks if token is set in session variable
function is_session_token_set(){
    return is_session("token");
}

//checks if token is set in get variable
function is_get_token_set(){
    return is_get("token");
}

function find_user($email=""){
    if(!$email){
        set_alert("User email not set","error");
        die();
    }

    $allUsers = scandir("db/users/");
    $countAllUsers = count($allUsers);

    for($counter=0; $counter < $countAllUsers; $counter++){
        $currentUser = $allUsers[$counter];

        //strtolower is to ensure that email verification is not case sensitive
        if(strtolower($currentUser) == strtolower($email . ".json")){

            $userString = file_get_contents("db/users/".$currentUser );
            $userObject = json_decode($userString);
            return  $userObject;
        }
    }//end for all users
    
    return false;
}//end function find user

function get_all_patients(){
    $patients = [];
    $count = 0;
    $allUsers = scandir("db/users/");

    foreach($allUsers as $user){
        if(!length_too_short($user,5)){
            $userString = file_get_contents("db/users/".$user );
            $userObject = json_decode($userString);
            $role = $userObject->designation;

            if($role == "Patients"){
                $patients[$count++] = $userObject;
            }
        }
    }

    return $patients;
}

function get_all_staff(){
    $staff = [];
    $count = 0;
    $allUsers = scandir("db/users/");

    foreach($allUsers as $user){
        if(!length_too_short($user,5)){
            $userString = file_get_contents("db/users/".$user );
            $userObject = json_decode($userString);
            $role = $userObject->designation;

            if($role == "Medical Team (MT)"){
                $staff[$count++] = $userObject;
            }
        }
    }

    return $staff;
}

function save_user($userObject){
    file_put_contents("db/users/".$userObject['email']. '.json', json_encode($userObject));
}

function update_user($userObject){
    file_put_contents("db/users/".$userObject->email. '.json', json_encode($userObject));
}

?>