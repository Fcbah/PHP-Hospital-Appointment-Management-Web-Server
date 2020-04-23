<?php include_once('lib/header.php');
include_once('functions/user.php');
include_once('functions/alert.php');
include_once('functions/redirect.php');
?>
<?php
if (!is_loggedIn()){
    redirect_to("login.php");
}
if(!is_patient()){
    set_alert("You are not authorized to view that page");
    redirect_to("dashboard.php");
}
?>
    <p><strong>Welcome, Please fill this form to book an appointment with the medical team</strong></p>
    <p>All Fields are required </p>
    <form method="POST" action="processAppointment.php">
    <p>
        <?php
            display_alert();
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
                    echo "value=".$_SESSION['nature_appoint'];
                }
            ?> type="text" name= "nature_appoint" placeholder="Nature of appointment" required/>
        </p>
        <p>
            <label for="">Department to book Appointment</label><br/>
            <input
            <?php
                if(isset($_SESSION["department"]) && !empty($_SESSION["department"])){
                    echo "value=".$_SESSION['department'];
                }
            ?> type="text" name= "department" placeholder="Department" required/>
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