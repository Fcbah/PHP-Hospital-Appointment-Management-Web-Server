<?php
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

function add_transaction($transactObject){
    file_put_contents("db/transactions/". $transactObject->fileName. ".json",json_encode($transactObject));
}

/*This searches for a transact object and returns it if found else it returns false */
function get_transact_object($filename = "master"){
    $alltransactions = scandir("db/transactions/");
    $countAlltransact = count($alltransactions);

    for($counter=0; $counter < $countAlltransact; $counter++){
        $currentTransact = $alltransactions[$counter];

        //strtolower is to ensure that email verification is not case sensitive
        if(strtolower($currentTransact) == strtolower($filename . ".json")){

            $transactString = file_get_contents("db/transactions/".$currentTransact );
            $transactObject = json_decode($transactString);
            return  $transactObject;
        }
    }//end for all users
    
    return false;
}


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