<?php include_once("lib/header.php");
require_once("functions/user.php");
require_once("functions/redirect.php");
require_once("functions/appointment.php");

//only logged in medical team can come here
if(!is_loggedIn() || !is_medical_team()){
    
    redirect_to("dashboard.php");
}
?>
<div class="container">
   Welcome to SNH Hospital for the ignorant<br/><hr/>
    
<h1>Dashboard</h1><hr/>
<p>
<?php display_msg();?></p>
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
<table class="table table-bordered table-hover table-striped">
<?php
$department = $_SESSION["department"];
$all_appointments = get_all_appointments($department);
if ($all_appointments){
    ?>
    <thead>
    <tr>
        <th>Date of appointment</th>
        <th>Patient Name</th>
        <th>Nature of Appointment</th>
        <th>Payment Status</th>
        <th>More Information</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($all_appointments as $appointment){

        $appointString = file_get_contents("db/appoints/".$department."/".$appointment);

        $appointObject = json_decode($appointString);
        ?>
        <tr>            
            <td><?php echo $appointObject->date_appoint?></td>
            <td><?php echo $appointObject->name?></td>
            <td><?php echo $appointObject->nature_appoint?></td>
            <td><?php echo $appointObject->status?></td>
            <td><a href="view_patient_details.php?appointment=<?php echo $appointment?>">More Details</a></td>
        </tr>        
        <?php
    }
}else{
    ?>
    <tr>
            YOU HAVE NO PENDING APPOINTMENTS
    </tr>
    <?php
}
?>
</tbody>
</table>
</div>
</div>
<?php include_once("lib/footer.php")?>