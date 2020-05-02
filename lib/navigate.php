<p>
        <a href="index.php">Home</a> |
        <?php 
        if (!isset($_SESSION["loggedIn"]) || empty($_SESSION["loggedIn"])){?>
            <a href="login.php">Login</a> |
            <a href="register.php">Register</a>|
            <a href="forgot.php">Forgot Password</a>|
        <?php }else{?>
                    
            <a href="logout.php">Logout</a> |
            <a href="reset.php">Password Reset</a> |
            <?php
            //Ensures that Super Admin can add users
            if($_SESSION["role"]  =="Super Admin"){?>
            <a href="register.php">Register</a>|
        <?php }
        if($_SESSION["role"]  =="Patients"){
    ?>
    <a href="payBills.php">Pay Bill</a>|
    <a href="bookAppointment.php">Book Appointment</a>
        <?php
        }}
        ?>            
    </p> 