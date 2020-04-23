<?php 
include_once('lib/header.php');
require_once('functions/alert.php');
require_once("functions/user.php");
?>
    <h1>Login</h1>
    <p>
        <?php
        if (is_loggedIn()){
            header("Location: dashboard.php");
            die();
        }

        display_alert();  

        ?>
    </p>
    
    <form method="POST" action="processlogin.php">
    <p>
    </p>
        
        <p>
            <label for="">Email</label><br/>
            <input
            <?php
                if(isset($_SESSION["email"]) && !empty($_SESSION["email"])){
                    echo "value=".$_SESSION['email'];
                }
            ?> type="email" name= "email" placeholder="Email" required/>
        </p>
        <p>
            <label for="">Password</label><br/>
            <input type="password" name= "password" placeholder="Password" required/>
        </p>

        <p>
            <button type="submit">Login</button>
        </p>
    </form>
<?php include_once('lib/footer.php');?>