<?php 
require_once("lib/header.php");
require_once("functions/user.php");
require_once("functions/redirect.php");


if(!is_super_admin()){
    redirect_to("index.php");
}

$allStaffs = get_all_staff();

?>
<h1>View All Staff</h1>

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
</table>
<div>
<a href="superAdmin.php">Return to Dashboard</a>
</div>

<?php require_once("lib/footer.php")?>