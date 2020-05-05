<?php 
require_once("lib/header.php");
require_once("functions/appointment.php");
require_once("functions/user.php");
require_once("functions/redirect.php");

//check if get variable is set
if(!is_medical_team() || !is_get("appointment")){
    redirect_to("medical.php");
}
$appointment = $_GET["appointment"];
$department =$_SESSION["department"];

$appointObject = get_appointObject($department,$appointment);

?>
<div class="container">
    <h2 class="text-center">Patient Details Page</h2>
    <table class="table table-bordered table-dark table-hover table-striped">
        <thead>
        <tr>
            <th>Info</th>
            <td>Details</td>
        </tr>
        </thead>
        <tbody>        
        <tr>
            <th>Patient Name</th>
            <td><?php echo  $appointObject->name?></td>
        </tr>
        <tr>
            <th>Date of appointment</th>
            <td><?php echo  $appointObject->date_appoint?></td>
        </tr>
        <tr>
            <th>Time of appointment</th>
            <td><?php echo  $appointObject->time_appoint?></td>
        </tr>
        <tr>
            <th>Nature of Complaints</th>
            <td><?php echo  $appointObject->nature_appoint?></td>
        </tr>
        <tr>
            <th>Initial Complaints</th>
            <td><?php echo  $appointObject->initial_complaint?></td>
        </tr>
        <tr>
            <th>Payment Status</th>
            <td><?php echo  $appointObject->status?></td>
        </tr>
        <?php
        ?>
    </tbody>
    </table>
    <div>
    <a class="btn btn-primary" href="medical.php">Return back to Dashboard</a>
</div>    
</div>


<?php require_once("lib/footer.php")?>