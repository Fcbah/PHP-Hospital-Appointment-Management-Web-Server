<?php session_start();?>
<?php include_once('lib/header.php');?>
    Login form Here
    <p>
        <?php
            if(isset($_SESSION["message"]) && !empty($_SESSION["message"])){
                echo "<span style='color:green'>". $_SESSION['message']."</span>";
                //session_unset();
                session_destroy();
            }
        ?>
    </p>
<?php include_once('lib/footer.php');?>