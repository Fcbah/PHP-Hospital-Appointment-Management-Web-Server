<?php include_once("lib/header.php");?>
<div class="back">

<div class="div-center">

<div class="content"> 

<form>
<script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
<button type="button" class= "btn btn-success" onClick="payWithRave()">Pay Now</button>
</form>

<script>
const API_publicKey = "FLWPUBK_TEST-800704e037a885fb526d3d3cef9e39e9-X";

function payWithRave() {
    var x = getpaidSetup({
        PBFPubKey: API_publicKey,
        customer_email: "user@example.com",
        amount: 200,
        customer_phone: "234099940409",
        currency: "NGN",
        txref: "rave-123456",
        meta: [{
            metaname: "flightID",
            metavalue: "AP1234"
        }],
        onclose: function() {},
        callback: function(response) {
            var txref = response.data.txRef; // collect txRef returned and pass to a                    server page to complete status check.
            console.log("This is the response returned after a charge", response);
            if (
                response.data.chargeResponseCode == "00" ||
                response.data.chargeResponseCode == "0"            
            ) {
                window.location.href ="processBill.php?failure=false";
            } else {
                //In case the reason for failure is due to pending validations. So I delay redirect for 2 seconds.
                setTimeout(function(){
                    window.location.href = "processBill.php?failure=true&ResponseCode="+response.data.chargeResponseCode;
                },2000)
                               
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