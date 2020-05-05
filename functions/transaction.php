<?php
require_once("validate.php");

function create_master_transaction(){
    $transactarray =[
        "fileName" => "master",
        "count" => 0,
        "New_Transactions" => [],
        "created_date_time" => explode(" ",date("Y m d h i s A"))
    ];
    $transactObject = json_decode(json_encode($transactarray));
    echo $transactObject;
    return $transactObject;
}

function create_transaction($filename){
    $transactarray =[
        "fileName" => $filename,
        "transactions" => [],
        "done" => [],
        "created_date_time" => explode(" ",date("Y m d h i s A"))
    ];
    $transactObject = json_decode(json_encode($transactarray));
    return $transactObject;
}

function add_transaction($transactObject){
    file_put_contents("db/transactions/". $transactObject->fileName. ".json",json_encode($transactObject));
}

/*This searches for a transact object and returns it if found else it returns false */
function get_transaction_object($full_filename){
    $alltransactions = scandir("db/transactions/");
    $countAlltransact = count($alltransactions);

    for($counter=0; $counter < $countAlltransact; $counter++){
        $currentTransact = $alltransactions[$counter];

        //strtolower is to ensure that email verification is not case sensitive
        if(strtolower($currentTransact) == strtolower($full_filename)){

            $transactString = file_get_contents("db/transactions/".$currentTransact );
            $transactObject = json_decode($transactString);
            return  $transactObject;
        }
    }//end for all users
    
    return false;
}
function get_transact_object($filename = "master"){
    return get_transaction_object($filename . ".json");
}

function find_transaction_entry($txref){
    $alluser = scandir("db/transactions/");
    foreach($alluser as $user){
        if(is_real_directory($user) && $user != "master.json"){
            $transactObject = get_transaction_object($user);
            foreach($transactObject->transactions as $transaction){
                if($transaction->transactionID == $txref){
                    return $transaction;
                }
            }
            foreach($transactObject->done as $transaction){
                if($transaction->transactionID == $txref){
                    return $transaction;
                }
            }//end if
        }//end if
    }//end foreach
    return false;
}//end function


/*Returns the previous count of the recorded transcations (using the master transaction list) and increments the count. */
function increment_transaction(){    
    $app_obj = "";
    if(file_exists("db/transactions/master.json")){
        $app_obj = get_transact_object("master");
    }else{
        mkdir("db/transactions", 0777,true);
        $app_obj = create_master_transaction();
    }
    $count = $app_obj->count;
    $app_obj->count = $count + 1;
    add_transaction($app_obj);
    return $count;
}
?>