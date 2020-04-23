<?php include_once('lib/header.php');?>
<?php
if (!isset($_SESSION["loggedIn"]) || empty($_SESSION["loggedIn"])){
    header("Location: login.php");
    die();
}
if(!isset($_SESSION["role"]) || $_SESSION["role"] != "Patients"){
    $_SESSION["error"] = "You are not authorized to view that page";
        header("Location: login.php");
        die();
}
?>
    <p><strong>Welcome, Please Register</strong></p>
    <p>All Fields are required </p>
    <form method="POST" action="processAppointment.php">
    <p>
        <?php
            if(isset($_SESSION["error"]) && !empty($_SESSION["error"])){
                echo "<span style='color:red'>". $_SESSION['error']."</span>";
                //session_unset();
                session_destroy();
            }
        ?>
    </p>
        <p>
            <label for="">Date of Appointment</label><br/>
            <input 
            <?php
                if(isset($_SESSION["date_appoint"]) && !empty($_SESSION["date_appoint"])){
                    echo "value=".$_SESSION['date_appoint'];
                }
            ?>
            type="date" name= "date_appoint" required/>
        </p>
        <p>
            <label for="">Time of Appointment</label><br/>
            <input 
            <?php
                if(isset($_SESSION["time_appoint"]) && !empty($_SESSION["time_appoint"])){
                    echo "value=".$_SESSION['time_appoint'];
                }
            ?>
            type="time" name= "time_appoint" required/>
        </p>
        <p>
            <label for="">Nature of Appointment</label><br/>
            <input
            <?php
                if(isset($_SESSION["nature_appoint"]) && !empty($_SESSION["nature_appoint"])){
                    echo "value=".$_SESSION['email'];
                }
            ?> type="text" name= "nature_appoint" required/>
        </p>      
        <p>
            <label for="">Initial Complaint</label><br/>
            <textarea
            <?php
                if(isset($_SESSION["initial_complaint"]) && !empty($_SESSION["initial_complaint"])){
                    echo "value=".$_SESSION['initial_complaint'];
                }
            ?>
            name= "initial_complaint" placeholder="Your Initial Complaint Here" required>
            </textarea>
        </p>
        <p>
            <button type="submit">Submit Appointment</button>
        </p>
    </form>
<?php include_once('lib/footer.php');?>