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
<?php include_once("lib/footer.php")?>