<?php 
include_once('lib/header.php');
require_once('functions/alert.php');
require_once("functions/user.php");
require_once("functions/redirect.php");
?>
<?php include_once('lib/navigate2.php');?>
<div class="back">

<div class="div-center">

<div class="content">    

    <form method="POST" action="processlogin.php">
        <h1>Login</h1>
        <p>
            <?php
            if (is_loggedIn()){
                redirect_to("dashboard.php");
            }

            display_alert();  

            ?>
        </p>
        <hr/>
        <div class="form-group">
            <label for="">Email</label>
            <input class="form-control"
            <?php
                if(isset($_SESSION["email"]) && !empty($_SESSION["email"])){
                    echo "value=".$_SESSION['email'];
                }
            ?> type="email" name= "email" placeholder="Email" required/>
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input class="form-control" type="password" name= "password" placeholder="Password" required/>
        </div>

        <div class="form-group">
            <button class="btn btn-success" type="submit">Login</button>
        </div>
    </form>
    
    
</div>
</div>
</div> 
<?php include_once('lib/bodyend.php');?>