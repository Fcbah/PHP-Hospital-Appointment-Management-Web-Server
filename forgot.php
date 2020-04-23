<?php include_once('lib/header.php');
require_once("functions/alert.php");

?>
    <h1>Forgot Password</h1>
    <p>Provide the email address associated with your account </p>
    <form action="processForgot.php" method="POST">
        <p>
            <?php
                display_alert();
            ?>
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
            <button type="submit">Send Reset Code</button>
        </p>

    </form>
<?php include_once('lib/footer.php');?>