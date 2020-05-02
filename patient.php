<?php include_once("lib/header.php");
require_once("functions/user.php");
require_once("functions/redirect.php");

//allow only logged in patients
if(!is_loggedIn() || !is_patient() ){
    
    redirect_to("dashboard.php");
}
?>
<div class="container">
 Welcome to SNH Hospital for the ignorant<br/><hr/>
<h1>Dashboard</h1>
<p>
<p>Welcome, <?php echo $_SESSION["fullName"]?> you are logged in</p> 
<p> Your designation and Access Level is <?php echo $_SESSION["role"]?></p>
</p>
<p>
    Your department is <?php echo $_SESSION["department"]; ?>
</p>
<p>
    Your Registration date was <?php $dt =$_SESSION["reg_date_time"]; echo $dt[3].":".$dt[4].":".$dt[5]." ".$dt[6]." on ".$dt[2]."/".$dt[1]."/".$dt[0]?>
</p>
<p>
    Your Last Login Time was <?php $dt =$_SESSION["last_login"]; echo $dt[3].":".$dt[4].":".$dt[5]." ".$dt[6]." on ".$dt[2]."/".$dt[1]."/".$dt[0]?>
</p>
</div>
<?php include_once("lib/footer.php")?>