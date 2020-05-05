<?php
function display_error(){
    if(isset($_SESSION["error"]) && !empty($_SESSION["error"])){
        echo "<span style='color:red'>". $_SESSION['error']."</span>";
        session_destroy();
    }
}

//I will not destroy session for display message because superAdmin can get messages when registering people. So as not to log the superAdmin out unnecessarily.
function display_msg(){
    if(isset($_SESSION["message"]) && !empty($_SESSION["message"])){
        echo "<span style='color:green'>". $_SESSION['message']."</span>";
        unset($_SESSION["message"]);//so as not to destroy superAdmin session during registration
        unset($_SESSION["error"]);
    }
}

function display_alert(){
    //to track if the session should be destroyed or not
    $destroySession = false;

    if(isset($_SESSION["error"]) && !empty($_SESSION["error"])){
        echo "<span style='color:red'>". $_SESSION['error']."</span>";
        $destroySession = true;
    }
    if(isset($_SESSION["message"]) && !empty($_SESSION["message"])){
        echo "<span style='color:green'>". $_SESSION['message']."</span>";
        unset($_SESSION["message"]);//so as not to destroy superAdmin session during registration;
    }
    if(isset($_SESSION["info"]) && !empty($_SESSION["info"])){
        echo "<span style='color:grey'>". $_SESSION['message']."</span>";
        $destroySession = true;
    }
    if ($destroySession){
        session_destroy();
    }
}

function set_alert($content = "",$type = "message"){
    switch($type){
        case "message":
            $_SESSION['message'] = $content;
        break;

        case "error":
            $_SESSION['error'] = $content;
        break;

        case "info":
            $_SESSION['info'] = $content;
        break;

        default:
            $_SESSION['message'] = $content;
        break;
    }
}

?>