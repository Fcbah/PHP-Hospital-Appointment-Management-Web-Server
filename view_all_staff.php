<?php 
require_once("lib/header.php");
require_once("functions/user.php");
require_once("functions/redirect.php");


if(!is_super_admin()){
    redirect_to("index.php");
}

$allStaffs = get_all_staff();

?>
<div class="container">
<h1>View All Staff</h1>

<table class="table table-bordered table-hover ">
    <thead class="thead-dark">
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
    foreach($allStaffs as $staff){
        ?>
        <tr>
            <td><?php echo $staff->first_name?></td>
            <td><?php echo $staff->last_name?></td>
            <td><?php echo $staff->email?></td>
            <td><?php echo $staff->designation?></td>
            <td><?php echo $staff->department?></td>
            <td><?php echo implode("-",$staff->reg_date_time)?></td>
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
<?php require_once("lib/footer.php")?>