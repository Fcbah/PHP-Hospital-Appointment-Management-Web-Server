<nav class = "navbar navbar-expand-sm bg-dark fixed-top" role="navigation">
    <ul class="navbar-nav">
        <li class="nav-item active"><a class="nav-link" href="index.php">Home</a> </li>
        <?php 
        if (!isset($_SESSION["loggedIn"]) || empty($_SESSION["loggedIn"])){?>
            <li class="nav-item"><a class="nav-link" href="login.php">Login</a> </li>
            <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
            <li class="nav-item"><a class="nav-link" href="forgot.php">Forgot Password</a></li>
        <?php }else{?>
                    
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            <li class="nav-item"><a class="nav-link" href="reset.php">Password Reset</a></li>
            <li class="nav-item"><?php
            //Ensures that Super Admin can add users
            if($_SESSION["role"]  =="Super Admin"){?>
            <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
        <?php }
        if($_SESSION["role"]  =="Patients"){
    ?>
    <li class="nav-item"><a class="nav-link" href="payBills.php">Pay Bill</a></li>
    <li class="nav-item"><a class="nav-link" href="bookAppointment.php">Book Appointment</a></li>
        <?php
        }}
        ?>
    </ul>
</nav> 