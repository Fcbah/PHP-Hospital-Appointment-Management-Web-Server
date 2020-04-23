<?php include_once('lib/header.php');
require_once("functions/alert.php");
require_once("functions/user.php");
require_once("functions/redirect.php");
    //dont allow unset token or un
    if(!is_loggedIn() && !is_token_set()){
        set_alert("You are not authorized to view that page","error");
        redirect_to("login.php");
    }?>
    <h1>Reset Password</h1>
    <p>Reset Password associated with your account :[email] </p>
    <form action="processreset.php" method="POST">
        <p>
            <?php
                display_alert();
            ?>
        </p>
        <?php if(!is_loggedIn()){?>
        <p>            
            <input type="hidden" 
            value="<?php
            //using ternary operator to simplify things
             echo  is_session_token_set() ? $_SESSION['token']  :$_GET['token']?>" 
             name= "token" required/>
        </p>
        <p>
            <label for="">Email</label><br/>
            <input value="
            <?php
            //using ternary operator to simplify things
            echo isset($_SESSION['email']) ? $_SESSION['email'] : ""
            ?>" 
            type="email" name= "email" placeholder="Email" required/>
        </p>
        <?php }?>
        <p>
            <label for="">Enter New Password</label><br/>
            <input type="password" name= "password" placeholder="Password" required/>
        </p>
        <p>
            <button type="submit"> Reset Password</button>
        </p>

    </form>
<?php include_once('lib/footer.php');?>