<?php
function contain_numbers($input)
{
    $nums = ["0","1","2","3","4","5","6","7","8","9"];
    foreach( $nums as $num)
    {
        //I try to split the concatenation of both names using the invalid character as a delimiter. if the string splits, then it contains the invalid character
        if(count(explode($num,$input))>1)
        {         
            return true;        
        }
    }
    return false;

}//end function contain numvbers

function length_too_short($input,$min_length){
    if(strlen($input)< $min_length ){
        return true;
    }

}//end function length too short

function email_valid($email){
    $chars = ["@","."];
    foreach( $chars as $char)
    {
        //strategy is same as above line-37
        if($char=="." && count(explode($char,$email)) > 2 ){
            //DO NOTHING
            //to allow for sub-domains email e.g. fcbah@contact.hng.com
        }else if(count(explode($char,$email))!=2){
                       
            return false;        
        }
    }
    return true;
}//end email_valid

//ensure that department does not contain invalid characters
//because you will use it to create filename for appointments
//returns the number of validity errors
function department_name_valid($name){
    
    $valid = "abcdefghijklmnopqrstuvwxyz_-ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $validityError = 0;
    foreach(str_split($name) as $inp){
        if(strpos($valid,$inp) === false){
            $validityError++;            
        }
    }
    return $validityError;
}

function is_real_directory($name){
    if($name != "." &&  $name != "..")
    {
        return true;
    }
    return false;
}

?>