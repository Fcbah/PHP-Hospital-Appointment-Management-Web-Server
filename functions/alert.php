<?php
function display_error(){
    if(isset($_SESSION["error"]) && !empty($_SESSION["error"])){
        echo "<span style='color:red'>". $_SESSION['error']."</span>";
        //session_unset();
        session_destroy();
    }//end if
}//end funtion

function display_msg(){
    if(isset($_SESSION["message"]) && !empty($_SESSION["message"])){
        echo "<span style='color:green'>". $_SESSION['message']."</span>";
        //session_unset();
        session_destroy();
    }//end if
}//end function

function display_alert(){
    //to track if the session should be destroyed or not
    $destroySession = false;

    if(isset($_SESSION["error"]) && !empty($_SESSION["error"])){
        echo "<span style='color:red'>". $_SESSION['error']."</span>";
        $destroySession = true;
    }//end if
    if(isset($_SESSION["message"]) && !empty($_SESSION["message"])){
        echo "<span style='color:green'>". $_SESSION['message']."</span>";
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
}//end function

?>