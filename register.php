<?php 
include_once('lib/header.php');
require_once('functions/alert.php');
require_once('functions/user.php');
require_once("functions/redirect.php");

?>
<?php
//This is to allow super Admin to register
//and at the same time dissallow other logged in users from registering.
if (is_loggedIn() && !is_super_admin()){
    redirect_to("dashboard.php");
}
?>
<style>
        body{
            background-color: #e2e2e2;
        }
        .div-center{
            margin-top: 75px;
            margin-bottom: 25px;
        }
    </style>
<div class="back">

<div class="div-center">

<div class="content">
    <p><strong>Welcome, Please Register</strong></p>
    <p>All Fields are required </p>
    <form method="POST" action="processregister.php">
    <p>
        <?php
        display_alert();
        ?>
    </p>
        <div class="form-group">
            <label for="">First Name</label><br/>
            <input class="form-control"
            <?php
                if(isset($_SESSION["first_name"]) && !empty($_SESSION["first_name"])){
                    echo "value=".$_SESSION['first_name'];
                }
            ?>
            type="text" name= "first_name" placeholder="First Name" required/>
        </div>
        <div class="form-group">
            <label for="">Last Name</label><br/>
            <input class="form-control"
            <?php
                if(isset($_SESSION["last_name"]) && !empty($_SESSION["last_name"])){
                    echo "value=".$_SESSION['last_name'];
                }
            ?>
            type="text" name= "last_name" placeholder="Last Name" required/>
        </div>
        <div class="form-group">
            <label for="">Email</label><br/>
            <input class="form-control"
            <?php
                if(isset($_SESSION["email"]) && !empty($_SESSION["email"])){
                    echo "value=".$_SESSION['email'];
                }
            ?> type="email" name= "email" placeholder="Email" required/>
        </div>
        <div class="form-group">
            <label for="">Password</label><br/>
            <input class="form-control" type="password" name= "password" placeholder="Password" required/>
        </div>
        <div class="form-group">
            <label for="gender">Gender</label><br/>
            <select class="form-control" name="gender" id="gender" required>
            <option value="">Select One </option>
                <option
                <?php
                if(isset($_SESSION["gender"]) && $_SESSION["gender"] == "Male"){
                    echo "selected";
                }
                ?>
                >Male</option>
                <option
                <?php
                if(isset($_SESSION["gender"]) && $_SESSION["gender"] == "Female"){
                    echo "selected";
                }
                ?>
                >Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="designation">Designation</label><br/>
            <select class="form-control" name="designation" id="designation" required>
                <option value="">Select One</option>
                <option
                <?php
                if(isset($_SESSION["designation"]) && $_SESSION["designation"] == "Medical Team (MT)"){
                    echo "Selected";
                }
                ?>
                >Medical Team (MT)</option>
                <option
                <?php
                if(isset($_SESSION["designation"]) && $_SESSION["designation"] == "Patients"){
                    echo "Selected";
                }
                ?>
                >Patients</option>
            </select>            
        </div>
        <div class="form-group">
            <label for="">Department</label><br/>
            <input class="form-control"
            <?php
                if(isset($_SESSION["department"]) && !empty($_SESSION["department"])){
                    echo "value=".$_SESSION['department'];
                }
            ?>
            type="text" name= "department" placeholder="Department" required/>
        </div>
        <div>
            <button class="btn btn-success" type="submit">Register</button>
        </div>
    </form>
</div>
</div>
</div>
<?php include_once('lib/footer.php');?>