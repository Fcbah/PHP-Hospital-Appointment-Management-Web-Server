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
<div>
    <h2>Patient Details Page</h2>
    <table>
        <tr>
            <td>Info:</td>
            <td>Details</td>
        </tr>
        <tr>
            <td>Patient Name</td>
            <td><?php echo  $appointObject->name?></td>
        </tr>
        <tr>
            <td>Date of appointment</td>
            <td><?php echo  $appointObject->date_appoint?></td>
        </tr>
        <tr>
            <td>Time of appointment</td>
            <td><?php echo  $appointObject->time_appoint?></td>
        </tr>
        <tr>
            <td>Nature of Complaints</td>
            <td><?php echo  $appointObject->nature_appoint?></td>
        </tr>
        <tr>
            <td>Initial Complaints</td>
            <td><?php echo  $appointObject->initial_complaint?></td>
        </tr>
        <?php
        ?>
    </table>    
</div>
<div>
    <a href="medical.php">Return back to Dashboard</a>
</div>

<?php require_once("lib/footer.php")?>