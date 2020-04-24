<?php include_once("lib/header.php");
require_once("functions/user.php");
require_once("functions/redirect.php");
require_once("functions/appointment.php");

//only logged in medical team can come here
if(!is_loggedIn() || !is_medical_team()){
    
    redirect_to("dashboard.php");
}
?>
   Welcome to SNH Hospital for the ignorant<br/><hr/>
    
<h1>Dashboard</h1><br/>
<p>Welcome, <?php echo $_SESSION["fullName"]?> you are logged in</p> 
<p> Your designation and Access Level is <?php echo $_SESSION["role"]?></p>
<p>
    Your department is <?php echo $_SESSION["department"]; ?>
</p>
<p>
    Your Registration date was <?php $dt =$_SESSION["reg_date_time"]; echo $dt[3].":".$dt[4].":".$dt[5]." ".$dt[6]." on ".$dt[2]."/".$dt[1]."/".$dt[0]?>
</p>
<p>
    Your Last Login Time was <?php $dt =$_SESSION["last_login"]; echo $dt[3].":".$dt[4].":".$dt[5]." ".$dt[6]." on ".$dt[2]."/".$dt[1]."/".$dt[0]?>
</p>
<hr/>
<h2>Your Appointments</h2>
<div class="table-container">
<table>
<?php
$department = $_SESSION["department"];
$all_appointments = get_all_appointments($department);
if ($all_appointments){
    ?>
    <tr>
        <td>Date of appointment</td>
        <td>Patient Name</td>
        <td>Nature of Appointment</td>
        <td>More Information</td>
    </tr>
    <?php
    foreach($all_appointments as $appointment){

        $appointString = file_get_contents("db/appoints/".$department."/".$appointment);

        $appointObject = json_decode($appointString);
        ?>
        <tr>            
            <td><?php echo $appointObject->date_appoint?></td>
            <td><?php echo $appointObject->name?></td>
            <td><?php echo $appointObject->nature_appoint?></td>
            <td><a href="view_patient_details.php?appointment=<?php echo $appointment?>">More Details</a></td>
        </tr>        
        <?php
    }
}else{
    ?>
    <tr>
        <p>
            YOU HAVE NO PENDING APPOINTMENTS
        </p>
    </tr>
    <?php
}
?>
</table>
</div>
<?php include_once("lib/footer.php")?>