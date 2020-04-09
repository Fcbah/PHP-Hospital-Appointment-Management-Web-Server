<?php session_start(); include_once("lib/header.php")?>
LoggedIn User ID: <?php echo $_SESSION['loggedIn'];?>
<?php include_once("lib/footer.php")?>