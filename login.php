<?php 
include_once('lib/header.php');
require_once('functions/alert.php');
?>
    <h1>Login</h1>
    <p>
        <?php
        if (isset($_SESSION["loggedIn"]) && !empty($_SESSION["loggedIn"])){
            header("Location: dashboard.php");
            die();
        }
        
        print_alert()        
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