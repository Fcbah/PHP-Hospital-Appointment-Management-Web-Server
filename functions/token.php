<?php

function token_generate(){
    $token ="";

    $alphabets = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A', 'B', 'C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

    for($i =0; $i<26; $i++){
        //get the random number
        //get the corresponding alphabet
        //add that to the token string
        $index = mt_rand(0,count($alphabets)-1);
        $token .= $alphabets[$index];
    }//end for
    return $token;
}//token generate

function save_token($email, $token_obj)
{
    file_put_contents("db/tokens/" . $email . ".json",$token_obj);
}

function find_token($email){
    $allUserTokens = scandir("db/tokens/");
    $countAllUserTokens = count($allUserTokens);
    

    for($counter=0; $counter < $countAllUserTokens; $counter++){

        $currentTokenfile = $allUserTokens[$counter];
        
        //Email is not CASE SENSITIVE use strtolower to avoid duplication
        if(strtolower($currentTokenfile) == strtolower($email . ".json")){
            return $currentTokenfile;
        }
    }
    return false;


}
?>