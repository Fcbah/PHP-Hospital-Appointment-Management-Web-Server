<?php include_once("lib/header.php");
require_once("functions/user.php");
require_once("functions/appointment.php");
require_once("functions/transaction.php");

if (is_loggedIn()){

}

?>
<div class="back">

<div class="div-center" >

<div class="content">

<?php $amount = 2500;
if(is_post("department")){//the two things that determine the transaction-ID 
$department = $_POST['department'];
$email = $_SESSION["email"];
$phone_no = is_session("phone_no") ? $_SESSION['phone_no'] : "2348131391511";
$txcount=increment_transaction();
$txRand = mt_rand(10000,99999);
$txID = "Fcbah-SNGV3-". $txcount."-". $txRand ;?>
<form>
<h1>Pay Bills</h1>
<p>You are about to pay ₦<?php echo $amount?> for your appointment with "<?php echo $department ?>" department.</p>
<script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
<button type="button" class= "btn btn-success" onClick="payWithRave()">Pay Now</button>
</form>

<?php } else {?>

    <form action="payBills.php" method="POST">
        <h1>Pay Bills</h1>
        <p>You are to pay ₦<?php echo $amount?> for each appointment. But before you do that select the appointments you want to pay for</p>
        <hr/>
        <h4>Select the Appointments you want to pay for</h4>
        <div class="form-group">
            <label for="Departments">Department Appointment to pay</label><br/>
            <select class="form-control" name="department" id="Departments" required>
                <option value="">Select One</option>
                <?php $appoint_department = get_all_my_unpaid_department($_SESSION['email']);
                foreach($appoint_department as $department){?>
                <option><?php echo $department?></option>
                <?php }?>                
            </select>            
        </div>
        <div>
            <button class="btn btn-success" type="submit">Proceed to Payment</button>
        </div>
    </form>

    <?php }?>

<script>
const API_publicKey = "FLWPUBK_TEST-800704e037a885fb526d3d3cef9e39e9-X";

function payWithRave() {
    var x = getpaidSetup({
        PBFPubKey: API_publicKey,
        customer_email: "<?php echo $email?>",
        amount: parseInt(<?php echo $amount?>),
        customer_phone: "<?php echo $phone_no?>",
        currency: "NGN",
        txref: "<?php echo $txID?>",
        meta: [{
            metaname: "flightID",
            metavalue: "AP1234"
        }],
        onclose: function() {},
        callback: function(response) {
            var txref = response.tx.txRef; // collect txRef returned and pass to a                    server page to complete status check.
            console.log("This is the response returned after a charge", response);
            if (
                response.tx.chargeResponseCode == "00" ||
                response.tx.chargeResponseCode == "0"            
            ) {
                window.location.href ="processBill.php?success=true&txref="+txref+"&chargeResponseCode="+response.tx.chargeResponseCode+"&chargeResponseMessage="+response.tx.chargeResponseMessage;
            } else {
                //In case the reason for failure is due to pending validations. So I delay redirect for 2 seconds.
                setTimeout(function(){
                window.location.href = "processBill.php?success=false&txref="+txref+"&chargeResponseCode="+response.tx.chargeResponseCode+"&chargeResponseMessage="+response.tx.chargeResponseMessage;
                },1000);                               
            }

            x.close(); // use this to close the modal immediately after payment.
        }
    });
}
</script>
</div>
</div>
</div>
<?php
include_once("lib/footer.php");
?>