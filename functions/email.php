<?php
function send_mail($email, $subject,$message){
    
    $headers = "From: no-reply@snh.org". " \r\n". "CC: fcbah1248@snh.org";
    
    $try = mail($email, $subject,$message, $headers);

    return $try;
}
?>