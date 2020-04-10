<?php include_once("lib/header.php");
if(!isset($_SESSION["Mode"]) || !($_SESSION["Mode"] == "SuperAdmin")){
    session_destroy();
    header("Location: login.php");
    die();
}
?>
<?php
include_once("lib/footer.php");
?>