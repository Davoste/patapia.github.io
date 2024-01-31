<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="./assets/css/notif.css">
</head>
<body>
    

<?php 
// Include the configuration file  
require_once 'config.php'; 
 
// Include the database connection file  
require_once 'dbConnect.php'; 
 
$payment_ref_id = $statusMsg = ''; 
$status = 'error'; 
 
// Check whether the payment ID is not empty 
if(!empty($_GET['checkout_ref_id'])){ 
    $payment_txn_id  = base64_decode($_GET['checkout_ref_id']); 
     
    // Fetch transaction data from the database 
    $sqlQ = "SELECT id,payer_id,payer_name,payer_email,payer_country,order_id,transaction_id,paid_amount,paid_amount_currency,payment_source,payment_status,created FROM transactions WHERE transaction_id = ?"; 
    $stmt = $db->prepare($sqlQ);  
    $stmt->bind_param("s", $payment_txn_id); 
    $stmt->execute(); 
    $stmt->store_result(); 
 
    if($stmt->num_rows > 0){ 
        // Get transaction details 
        $stmt->bind_result($payment_ref_id, $payer_id, $payer_name, $payer_email, $payer_country, $order_id, $transaction_id, $paid_amount, $paid_amount_currency, $payment_source, $payment_status, $created); 
        $stmt->fetch(); 
         
        $status = 'success'; 
        $statusMsg = 'Your Payment has been Successful!'; 
        //check user balance
        $sqlz="SELECT * from users WHERE email='$payer_email'";
        $result = $db->query($sqlz);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // You can now access the data in the $data variable        
            $bala = $row['balance'];
            //update balance
            $newb=$bala+$paid_amount;
            // update user balance
            $sqlv="UPDATE users SET balance=$newb WHERE email ='$payer_email'";

            if ($db->query($sqlv) === TRUE) {
                $balstat= "Balance updated successfully";
            } else {
                $balstat= "Error updating balance: " . $db->error;
            }
            
        } else {
            $balstat= "No results found.";
        }

         
      
    }else{ 
        $statusMsg = "Transaction has been failed!"; 
    } 
}else{ 
    header("Location: index.php"); 
    exit; 
} 
?>

<?php if(!empty($payment_ref_id)){ ?>
    <div class="notifications-container">
      <div class="success">
        <div class="flex">
          <div class="flex-shrink-0">
            
          <svg class="success-svg" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
          </div>
          <div class="success-prompt-wrap">
            <p class="success-prompt-heading"><?php echo $statusMsg; ?>
            </p><div class="success-prompt-prompt">
              <p><?php echo $balstat; ?></p>
              <h4>Payment Information</h4>
                <p><b>Reference Number:</b> <?php echo $payment_ref_id; ?></p>
                <p><b>Order ID:</b> <?php echo $order_id; ?></p>
                <p><b>Transaction ID:</b> <?php echo $transaction_id; ?></p>
                <p><b>Paid Amount:</b> <?php echo $paid_amount.' '.$paid_amount_currency; ?></p>
                <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
                <p><b>Date:</b> <?php echo $created; ?></p>
            </div>
              <div class="success-button-container">
                <button type="button" class="success-button-main"><a href="howlow.php">back</a></button>
                <button type="button" class="success-button-secondary"><a href="index.php">Dismiss</a></button>
              </div>
          </div>
        </div>
      </div>
    </div>
   

<?php }else{ ?>
    <div class="notifications-container">
      <div class="failed">
        <div class="flex">
          <div class="flex-shrink-0">
            
          <svg class="failed-svg" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
          </div>
          <div class="success-prompt-wrap">
            <p class="failed-prompt-heading">Your Payment been failed!
            </p><div class="failed-prompt-prompt">
            <p class="error"><?php echo $statusMsg; ?></p>
            </div>
              <div class="success-button-container">
                <button type="button" class="success-button-main"><a href="login.php">Back</a></button>
                <button type="button" class="success-button-secondary"><a href="index.php">Dismiss</a></button>
              </div>
          </div>
        </div>
      </div>
    </div>

<?php }?>
</body>
</html>