<?php 
require_once("lib/header.php");
require_once("functions/appointment.php");
require_once("functions/user.php");
require_once("functions/redirect.php");

//check if get variable is set
if(!is_get("appointment")){
    redirect_to("medical.php");
}
$email = $_GET["appointment"];
$department =$_SESSION["department"];

get_appointObject($department,$appointment);

?>
<div>
    <h2>Patient Details Page</h2>
    <table>
        <tr>
            <td>Info:</td>
            <td>Details</td>
        </tr>
        <?php
        ?>
    </table>    
</div>
<div>
    <a href="medical.php">Return back to Dashboard</a>
</div>

<?php require_once("lib/footer.php")?>