<?php include_once('lib/header.php');
require_once("functions/alert.php");

?>
<div class="back">

<div class="div-center">

<div class="content"> 
    <h1>Forgot Password</h1>
    <p>Provide the email address associated with your account </p>
    <form action="processForgot.php" method="POST">
        <p>
            <?php
                display_alert();
            ?>
        </p>
        <div class="form-group">
            <label for="">Email</label><br/>
            <input class="form-control"
            <?php
                if(isset($_SESSION["email"]) && !empty($_SESSION["email"])){
                    echo "value=".$_SESSION['email'];
                }
            ?> type="email" name= "email" placeholder="Email" required/>
        </div>
        <div>
            <button class="btn btn-success" type="submit">Send Reset Code</button>
        </div>

    </form>
</div>
</div>
</div>
<?php include_once('lib/footer.php');?>