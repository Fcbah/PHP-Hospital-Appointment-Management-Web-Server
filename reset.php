<?php include_once('lib/header.php');
    //if token is set
    if(!isset($_SESSION["loggedIn"]) && !isset($_GET['token']) && !isset($_SESSION['token'])){
        $_SESSION["error"] = "You are not authorized to view that page";
        header("Location: login.php");
        die();
    }?>
    <h1>Reset Password</h1>
    <p>Reset Password associated with your account :[email] </p>
    <form action="processreset.php" method="POST">
        <p>
            <?php
                if(isset($_SESSION["error"]) && !empty($_SESSION["error"])){
                    echo "<span style='color:red'>". $_SESSION['error']."</span>";
                    //session_unset();
                    session_destroy();
                }
            ?>
        </p>
        <?php if(!isset($_SESSION["loggedIn"])){?>
        <p>            
            <input type="hidden" 
            value="<?php
            //using ternary operator to simplify things
             echo  isset($_SESSION['token']) ? $_SESSION['token']  :$_GET['token']?>" 
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