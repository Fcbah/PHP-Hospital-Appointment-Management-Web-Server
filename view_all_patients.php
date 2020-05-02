<?php 
require_once("lib/header.php");
require_once("functions/user.php");
require_once("functions/redirect.php");


if(!is_super_admin()){
    redirect_to("index.php");
}

$allPatients = get_all_patients();

?>
<div class="container text-center">
<h1>View All Patients</h1>

<table class="table table-bordered table-hover table-dark">
    <caption>All Patients</caption>
    <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Department</th>
        <th>Registration Date</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($allPatients as $patient){
        ?>
        <tr>
            <td><?php echo $patient->first_name?></td>
            <td><?php echo $patient->last_name?></td>
            <td><?php echo $patient->email?></td>
            <td><?php echo $patient->designation?></td>
            <td><?php echo $patient->department?></td>
            <td><?php echo implode("-",array_slice($patient->reg_date_time,0,3))."\t ". implode(":",array_slice($patient->reg_date_time,3,2)) .".". $patient->reg_date_time[5]; ?></td>
        </tr>  
        <?php
    }
    ?>
    </tbody>
</table>
<div>
<a class="btn btn-primary" href="superAdmin.php">Return to Dashboard</a>
</div>
</div>
<?php require_once("lib/navigate2.php")?>
<?php require_once("lib/bodyend.php")?>