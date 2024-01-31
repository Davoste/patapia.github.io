<?php 
session_start();
 if ($_SERVER["REQUEST_METHOD"] === "POST") { 
    $itemPrice = $_SESSION["itemPrice"] = (int)$_POST["amount"];
   
    
    $currency = "USD"; 

    $itemNumber = "DP12345"; 
    $itemName = "BucksHour Deposit"; 
   
 }
 $itemPrice =$itemPrice;
/* PayPal REST API configuration 
 * You can generate API credentials from the PayPal developer panel. 
 * See your keys here: https://developer.paypal.com/dashboard/ 
 */ 
define('PAYPAL_SANDBOX', TRUE); //TRUE=Sandbox | FALSE=Production 
define('PAYPAL_SANDBOX_CLIENT_ID', 'AfqXBS1lfmCY6PLWBLt2LYRjW1bpkjJSW12xWOdhOh1QcQiUBT-9IbXm06-81x9UlBcaxkDHNayhoIVJ'); 
define('PAYPAL_SANDBOX_CLIENT_SECRET', 'EO3NRENyhK360D8PT8pIVXJlEDdr5pC9VundFRRTGg1pZeoV__wqNB8Ev1PuW1a9l8cPLJlqR5K-IqnA'); 
define('PAYPAL_PROD_CLIENT_ID', 'Aah9z5WSXIJr6QUYm9YJGMA2jnhDP-ZtyYZh1UTQQ60M4PEFT7-gL6ZGjgYqX28gnETgoLfUh2R5fUUJ'); 
define('PAYPAL_PROD_CLIENT_SECRET', 'ELx4Fks4McsG23YGYANbLCNglHDmdYL56ZW8mKMeZN9owm1DLiBJUYyjnDrIWvHOMF8GMS7yYvIbaUuD'); 
  
// Database configuration  
define('DB_HOST', 'localhost');  
define('DB_USERNAME', 'root');  
define('DB_PASSWORD', '');  
define('DB_NAME', 'bet'); 
 
?>
 <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BucksHour</title>
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link href="" rel="stylesheet" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">

<script src="https://www.paypal.com/sdk/js?client-id=<?php echo PAYPAL_SANDBOX?PAYPAL_SANDBOX_CLIENT_ID:PAYPAL_PROD_CLIENT_ID; ?>&currency=<?php echo $currency; ?>"></script>
<div class="panel">
    <div class="overlay hidden"><div class="overlay-content"><img src="css/loading.gif" alt="BucksHour"/></div></div>

    <div class="panel-heading">
        <h3 class="panel-title">Charge <?php echo '$'.$itemPrice; ?> with PayPal</h3>
        
        <!-- Product Info -->
        <p><b><?php echo $itemName; ?></b> </p>
        <p><b>Amount:</b> <?php echo '$'.$itemPrice.' '.$currency; ?></p>
    </div>
    <div class="panel-body">
        <!-- Display status message -->
        <div id="paymentResponse" class="hidden"></div>
        
        <!-- Set up a container element for the button -->
        <div id="paypal-button-container"></div>
    </div>
</div>
<script>
paypal.Buttons({
    // Sets up the transaction when a payment button is clicked
    createOrder: (data, actions) => {
        return actions.order.create({
            "purchase_units": [{
                "custom_id": "<?php echo $itemNumber; ?>",
                "description": "<?php echo $itemName; ?>",
                "amount": {
                    "currency_code": "<?php echo $currency; ?>",
                    "value": <?php echo $itemPrice; ?>,
                    "breakdown": {
                        "item_total": {
                            "currency_code": "<?php echo $currency; ?>",
                            "value": <?php echo $itemPrice; ?>
                        }
                    }
                },
                "items": [
                    {
                        "name": "<?php echo $itemName; ?>",
                        "description": "<?php echo $itemName; ?>",
                        "unit_amount": {
                            "currency_code": "<?php echo $currency; ?>",
                            "value": <?php echo $itemPrice; ?>
                        },
                        "quantity": "1",
                        "category": "DIGITAL_GOODS"
                    },
                ]
            }]
        });
    },
    // Finalize the transaction after payer approval
    onApprove: (data, actions) => {
        return actions.order.capture().then(function(orderData) {
            setProcessing(true);

            var postData = {paypal_order_check: 1, order_id: orderData.id};
            fetch('paypal_checkout_validate.php', {
                method: 'POST',
                headers: {'Accept': 'application/json'},
                body: encodeFormData(postData)
            })
            .then((response) => response.json())
            .then((result) => {
                if(result.status == 1){
                    window.location.href = "payment-status.php?checkout_ref_id="+result.ref_id;
                }else{
                    const messageContainer = document.querySelector("#paymentResponse");
                    messageContainer.classList.remove("hidden");
                    messageContainer.textContent = result.msg;
                    
                    setTimeout(function () {
                        messageContainer.classList.add("hidden");
                        messageText.textContent = "";
                    }, 5000);
                }
                setProcessing(false);
            })
            .catch(error => console.log(error));
        });
    }
}).render('#paypal-button-container');

const encodeFormData = (data) => {
  var form_data = new FormData();

  for ( var key in data ) {
    form_data.append(key, data[key]);
  }
  return form_data;   
}

// Show a loader on payment form processing
const setProcessing = (isProcessing) => {
    if (isProcessing) {
        document.querySelector(".overlay").classList.remove("hidden");
    } else {
        document.querySelector(".overlay").classList.add("hidden");
    }
}    
</script>