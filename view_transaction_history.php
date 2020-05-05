<?php include_once("lib/header.php");
require_once("functions/user.php");
require_once("functions/redirect.php");
require_once("functions/transaction.php");


if(!is_loggedIn() || !is_patient()){
    redirect_to("login.php");
}


?>
<div class="container">
    <h1>View Transaction History</h1><hr/>
    <table class="table table-bordered">
<?php
$transactObject = get_transact_object($_SESSION["email"]);
if($transactObject){
$allTransactions = $transactObject->transactions;
    ?>
    <thead>
    <tr>
        <th>Email</th>
        <th>Department of Appointment</th>
        <th>TransactionID</th>
        <th>Amount Paid</th>
        <th>Date/Time of Payment</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($allTransactions as $transaction){
        ?>
        <tr>
            <td><?php echo $transaction->email?></td>
            <td><?php echo $transaction->department?></td>
            <td><?php echo $transaction->transactionID?></td>
            <td>₦<?php echo $transaction->amount?></td>
            <td><?php echo implode("-",array_slice($transaction->created_date_time,0,3))."\t ". implode(":",array_slice($transaction->created_date_time,3,2)) .".". $transaction->created_date_time[5]; ?></td>
        </tr>        
        <?php
    }
    ?>
    </tbody>
<?php }else{
    ?>
    YOU DONT HAVE ANY TRANSACTION YET
    <?php
} ?>
    </table>
    <a href="patient.php" class="btn btn-primary">Return to Dashboard</a>
</div>
<?php include_once("lib/footer.php")?>