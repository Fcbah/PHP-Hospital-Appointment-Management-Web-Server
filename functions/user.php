<?php 
//check if a provided session variable is set
function is_sess($parameter){
    return (isset($_SESSION[$parameter]) && !empty($_SESSION[$parameter]));
}

//checks if a provide form get variable is set
function is_get($parameter){
    return (isset($_GET[$parameter]) && !empty($_GET[$parameter]));
}

//checks if a user is logged in
function is_loggedIn(){
    return is_sess("loggedIn");
}

//checks if token is set
function is_token_set(){
    return is_get_token_set() || is_session_token_set();
}

//checks if token is set in session variable
function is_session_token_set(){
    return is_sess("token");
}

//checks if token is set in get variable
function is_get_token_set(){
    return is_get("token");
}



?>