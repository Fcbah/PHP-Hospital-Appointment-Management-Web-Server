<!--Menu-->
<p>
        <a href="index.php">Home</a> |
        <?php 
        if (!isset($_SESSION["loggedIn"]) || empty($_SESSION["loggedIn"])){?>
            <a href="login.php">Login</a> |
        <?php }else{?>
        
            <a href="logout.php">Logout</a> |
        <?php }?>
        <?php
        if (!isset($_SESSION["role"]) || empty($_SESSION["Super Admin"])){?>
            <a href="login.php">Register</a> |
        <?php }?>
            <a href="forgot.php">Forgot Password</a> |
    </p>    
</body>
</html> 