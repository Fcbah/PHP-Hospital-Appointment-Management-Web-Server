<?php include_once("lib/header.php");
if(!isset($_SESSION["Mode"]) || !($_SESSION["Mode"] == "SuperAdmin")){
    session_destroy();
    header("Location: login.php");
}
?>
<?php
session_destroy();
include_once("lib/footer.php");
?>