<?php include_once('lib/header.php');
if (isset($_SESSION["loggedIn"]) && !empty($_SESSION["loggedIn"])){
    header("Location: dashboard.php");
}?>
    Welcome to SNH Hospital for the ignorant
    <br/> <hr/> 
    <p>This is a specialist hospital to cure ignorance</p>
    <p> Come as you are it is completely free!</p>
<?php include_once('lib/footer.php');?>

    