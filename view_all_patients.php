<?php 
require_once("lib/header.php");
require_once("functions/user.php");
require_once("functions/redirect.php");


if(!is_super_admin()){
    redirect_to("index.php");
}

$allPatients = get_all_patients();

?>
<h1>View All Patients</h1>

<table>
    <tr>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Email</td>
        <td>Role</td>
        <td>Department</td>
        <td>Registration Date</td>
    </tr>
    <?php
    foreach($allPatients as $patient){
        ?>
        <tr>
            <td><?php echo $patient->first_name?></td>
            <td><?php echo $patient->last_name?></td>
            <td><?php echo $patient->email?></td>
            <td><?php echo $patient->designation?></td>
            <td><?php echo $patient->department?></td>
            <td><?php echo implode("-",$patient->reg_date_time)?></td>
        </tr>  
        <?php
    }
    ?>
</table>
<div>
<a href="superAdmin.php">Return to Dashboard</a>
</div>
<?php require_once("lib/footer.php")?>