<?php include_once('lib/header.php');
require_once("functions/alert.php");
require_once("functions/user.php");
require_once("functions/redirect.php");
    //dont allow unset token or un
    if(!is_loggedIn() && !is_token_set()){
        set_alert("You are not authorized to view that page","error");
        redirect_to("login.php");
    }?>
    
<div class="back">

<div class="div-center">

<div class="content">

    <h1>Reset Password</h1>
    <p>Reset Password associated with your account</p>
    <form action="processreset.php" method="POST">
        <p>
            <?php
                display_alert();
            ?>
        </p>
        <?php if(!is_loggedIn()){?>
        <div class="form-group">            
            <input class="form-control" type="hidden" 
            value="<?php
            //using ternary operator to simplify things
             echo  is_session_token_set() ? $_SESSION['token']  :$_GET['token']?>" 
             name= "token" required/>
        </div>
        <div class="form-group">
            <label for="">Email</label><br/>
            <input class="form-control" value="
            <?php
            //using ternary operator to simplify things
            echo isset($_SESSION['email']) ? $_SESSION['email'] : ""
            ?>" 
            type="email" name= "email" placeholder="Email" required/>
        </div>
        <?php }?>
        <div class="form-group">
            <label for="">Enter New Password</label><br/>
            <input class="form-control" type="password" name= "password" placeholder="Password" required/>
        </div>
        <p>
            <button class='btn btn-success' type="submit"> Reset Password</button>
        </p>

    </form>
</div>
</div>
</div>
<?php include_once('lib/footer.php');?>