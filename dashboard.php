<?php include_once("lib/header.php")
if(!isset($_SESSION["loggedIn"]) || empty($_SESSION["loggedIn"])){
    //redirect to our dashboard
    header("Location: login.php")
}
?>
<h1>Dashboard</h1>
LoggedIn User ID: <?php echo $_SESSION['loggedIn'];?>
<?php include_once("lib/footer.php")?>