<?php include_once("lib/header.php");
require_once("functions/user.php");
require_once("functions/redirect.php");

//only a loggedin Super_Admin or non_logged in users can register.
if(is_loggedIn() && !is_super_admin()){

    session_destroy();// I am doing this because it can be a security threat
    redirect_to("dashboard.php");
}
?>

 Welcome to SNH Hospital for the ignorant
    <br/> <hr/> 
    <p>This is a specialist hospital to cure ignorance</p>
    <p> Come as you are it is completely free!</p>
<h1>Dashboard</h1><br/>
<p>
    <?php 
    //This is to ensure the superAdmin can get sucess messages when he registers people
    display_msg()?>
</p>
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
<p>
    <a href="view_all_patients.php">View All Patients</a><br/>
    <a href="view_all_staff.php">View All Staff</a>
</p>
<?php include_once("lib/footer.php")?>