<!--Menu-->
<p>
        <a href="index.php">Home</a> |
        <?php 
        if (!isset($_SESSION["loggedIn"]) || empty($_SESSION["loggedIn"])){?>
            <a href="login.php">Login</a> |
            <a href="register.php">Register</a>|
        <?php }else{?>
                    
            <a href="logout.php">Logout</a> |
            <?php if($_SESSION["role"]  =="Super Admin"){?>
            <a href="register.php">Register</a>|
        <?php }}?>
        <?php
        ?>
            <a href="forgot.php">Forgot Password</a> |
    </p>    
</body>
</html> 