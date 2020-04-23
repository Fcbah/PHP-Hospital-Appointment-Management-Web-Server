<?php session_start();
require_once("functions/redirect.php");
session_unset();
session_destroy();

redirect_to("login.php");
?>