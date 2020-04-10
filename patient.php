<?php include_once("lib/header.php");
if(!isset($_SESSION["loggedIn"]) || empty($_SESSION["loggedIn"])){
    //redirect to our dashboard
    header("Location: login.php");
}
?>
<h1>Dashboard</h1>
<p>
Welcome, <?php echo $_SESSION["fullName"]?> you are logged in as (<?php echo $_SESSION["role"]?>), and your ID is <?php echo $_SESSION["loggedIn"]; ?>.
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
<?php include_once("lib/footer.php")?>