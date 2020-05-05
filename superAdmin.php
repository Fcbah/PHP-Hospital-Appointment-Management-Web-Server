<?php include_once("lib/header.php");
require_once("functions/user.php");
require_once("functions/redirect.php");
require_once("functions/transaction.php");


//only a loggedin Super_Admin or non_logged in users can register.
if(is_loggedIn() && !is_super_admin()){

    session_destroy();// I am doing this because it can be a security threat
    redirect_to("dashboard.php");
}
?>
<div class="container">
 <span>Welcome to SNH Hospital for the ignorant</span><hr/>
<h1>Dashboard</h1><br/>
<p>
    <?php 
    //This is to ensure the superAdmin can get sucess messages when he registers people
    display_msg()?>
</p>
<p>Welcome, <?php echo $_SESSION["fullName"]?> you are logged in</p> 
<p> Your designation and Access Level is <?php echo $_SESSION["role"]?></p>
<p>
    Your Last Login Time was <?php $dt =$_SESSION["last_login"]; echo $dt[3].":".$dt[4].":".$dt[5]." ".$dt[6]." on ".$dt[2]."/".$dt[1]."/".$dt[0]?>
</p>
<hr/>
<h3>New Transactions</h3>
<table class="table table-bordered">
<?php
$masterList = get_transact_object();
$allTransactions = $masterList->New_Transactions;
    ?>
    <thead>
    <tr>
        <th>Patient Name</th>
        <th>Patient Email</th>
        <th>Department of Appointment</th>
        <th>TransactionID</th>
        <th>Amount Paid</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($allTransactions as $transaction){

        $userObject = find_user($transaction->email);
        ?>
        <tr>            
            <td><?php echo $userObject->first_name ." ". $userObject->last_name?></td>
            <td><?php echo $transaction->email?></td>
            <td><?php echo $transaction->department?></td>
            <td><?php echo $transaction->transactionID?></td>
            <td>₦<?php echo $transaction->amount?></td>
        </tr>        
        <?php
    }
    ?>
    </table>
<!-- <h2>You Can Do One of the Following</h2> -->
<div>
    <a class="btn btn-primary" href="view_all_patients.php">View All Patients</a>
    <a class="btn btn-primary" href="view_all_staff.php">View All Staff</a>
</div>
</div>
<?php include_once("lib/footer.php")?>