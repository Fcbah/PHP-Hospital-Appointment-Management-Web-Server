<?php 
require_once("lib/header.php");
require_once("functions/validate.php");?>
<?php require_once("lib/navigate2.php");

require_once("functions/user.php");

$allUsers = scandir("db/users/");
foreach($allUsers as $user){
    if(is_real_directory($user)){
        $userString = file_get_contents("db/users/".$user );
    $userObject = json_decode($userString);
    $userObject->phone_no = "2347050914445";

    update_user($userObject);
    }    
}
echo "<h1> script run successful</h1>";

require_once("lib/bodyend.php")?>
