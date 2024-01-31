
<!DOCTYPE html>
<html>
<head>
 <title>Placing Bet...</title>
</head>
<body>
 
 <style>
    .notifications-container {
  width: 320px;
  height: auto;
  font-size: 0.875rem;
  line-height: 1.25rem;
  display: flex;
  flex-direction: column;
  gap: 1rem;
  margin-left: auto;
  margin-right: auto;
}

.flex {
  display: flex;
}

.flex-shrink-0 {
  flex-shrink: 0;
}
.failed{
    padding: 1rem;
  border-radius: 0.375rem;
  background-color: #ff99ac;
}
.failed-svg{
    color: red;
  width: 1.25rem;
  height: 1.25rem;   
}
.failed-prompt-heading {
  font-weight: bold;
  color: white;
}

.failed-prompt-prompt {
  margin-top: 0.5rem;
  color: white;
}
.success {
  padding: 1rem;
  border-radius: 0.375rem;
  background-color: rgb(240 253 244);
}

.succes-svg {
  color: rgb(74 222 128);
  width: 1.25rem;
  height: 1.25rem;
}


.success-prompt-wrap {
  margin-left: 0.75rem;
}

.success-prompt-heading {
  font-weight: bold;
  color: rgb(22 101 52);
}

.success-prompt-prompt {
  margin-top: 0.5rem;
  color: rgb(21 128 61);
}

.success-button-container {
  display: flex;
  margin-top: 0.875rem;
  margin-bottom: -0.375rem;
  margin-left: -0.5rem;
  margin-right: -0.5rem;
}

.success-button-main {
  padding-top: 0.375rem;
  padding-bottom: 0.375rem;
  padding-left: 0.5rem;
  padding-right: 0.5rem;
  background-color: #ECFDF5;
  color: rgb(22 101 52);
  font-size: 0.875rem;
  line-height: 1.25rem;
  font-weight: bold;
  border-radius: 0.375rem;
  border: none
}

.success-button-main:hover {
  background-color: #D1FAE5;
}

.success-button-secondary {
  padding-top: 0.375rem;
  padding-bottom: 0.375rem;
  padding-left: 0.5rem;
  padding-right: 0.5rem;
  margin-left: 0.75rem;
  background-color: #ECFDF5;
  color: #065F46;
  font-size: 0.875rem;
  line-height: 1.25rem;
  border-radius: 0.375rem;
  border: none;
}

 </style>
 <?php
include './include/config.php';
session_start();
// Assuming that the choices are represented by integers 1, 2, and 3.
$validChoices = [1, 2, 3, 4, 5,6, 7, 8, 9,10,11,12,13,14,15,16,17,18,19,20,21,22,22,23,24,25,26,27,28,29,30,31,32,33,34 ,35];
$name = $_SESSION['user_name'];
if ($_SERVER["REQUEST_METHOD"] === "POST") { 
    // Gather user input
    
    $choice = (int)$_POST["choice"];
    $stake = (int)$_POST["stake"];
   
    $Draw =$_POST["Draw"];

    // Check if the choice is valid
    if (!in_array($choice, $validChoices)) {
        die("Invalid choice. Please select either 1, 2, 3");
    }

   // echo "The Draw id is: " .$Draw ;

    //get user balance
   
$sql = "SELECT * FROM users WHERE name='$name' ";
$result = mysqli_query($db, $sql);

if (!$result) {
    die("Error fetching data: " . mysqli_error($db));
}
$row = mysqli_fetch_assoc($result);


$userBalance =$row["balance"];

// Get form data
$stake = floatval($_POST["stake"]);

// Validate the stake amount against the user's balance
if ($stake > $userBalance) {
    
     ?>
     <!--if insufficient -->
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
        <p class="failed-prompt-heading">Insufficient balance
        </p><div class="failed-prompt-prompt">
          <p>Insufficient balance. Kindly enter a lower stake or topup and try again..</p>
        </div>
          <div class="success-button-container">
            <button type="button" class="success-button-main"><a href="acc.php">Deposit</a></button>
            <button type="button" class="success-button-secondary"><a href="howlow.php">Dismiss</a></button>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- end if isuu html-->
<?php
    die("");
}

    // Calculate the amount to store and accumulate (80% of the stake)
    $storeAmount = $stake * 0.8;


// Deduct the stake amount from the user's account balance
$updatedBalance = $userBalance - $stake;
$sql = "UPDATE users SET balance = $updatedBalance WHERE name = '$name'";
$result = mysqli_query($db, $sql);

if (!$result) {
    die("Error updating user balance: " . mysqli_error($db));
}
//update possible win
$sql="SELECT * FROM low WHERE id='$Draw'";
$result = mysqli_query($db, $sql);
if ($result && $result->num_rows > 0) {
    // Row is null, insert specific data
    $insertData = $Draw;
    $updateSql = "UPDATE posswin SET id = '$insertData' WHERE id IS NULL";

    if ($db->query($updateSql) === TRUE) {
      //  echo "Specific data inserted successfully.";
    } else {
        echo "Error updating row: " . $db->error;
    }
} else {
    $row = mysqli_fetch_assoc($result); 
    $updatedstake= (int)$row["posswin"];

    $sql="UPDATE low SET posswin= $updatedstake WHERE id='$Draw";
}
    // Check if there is an existing record in the 'accumulation' table with the same 'DrawID'
    $checkSql = "SELECT * FROM accum WHERE draw_id = '$Draw'";
    $checkResult = mysqli_query($db, $checkSql);

    if ($checkResult->num_rows > 0) {
        // If a record exists with the same 'DrawID', update the amount
        $row = mysqli_fetch_assoc($checkResult);
        $existingAmount = floatval($row["amount"]);
        $updatedAmount = $existingAmount + $storeAmount;

        $updateSql = "UPDATE accum SET amount = $updatedAmount WHERE draw_id = '$Draw'";
        if (mysqli_query($db, $updateSql)) {
          //  echo "Your Bet has been placed successfully, and the accumulated amount has been updated.<br>";
        } else {
            echo "Error updating accumulated amount: " . mysqli_error($db);
        }
    } else {
        // If no record exists with the same 'DrawID', insert a new record
        $insertSql = "INSERT INTO accum (user_name, draw_id, amount) VALUES ('$name', '$Draw', $storeAmount)";
        if (mysqli_query($db, $insertSql)) {
          //  echo "Your Bet has been placed successfully, and 80% of your stake has been accumulated.<br>";
        } else {
            echo "Error inserting accumulated amount: " . mysqli_error($db);
        }
    }
// Prepare and execute the SQL query to insert the user's bet
$sql = "INSERT INTO low (name, choice, stake, id) VALUES ('$name', '$choice', '$stake','$Draw')";

if (mysqli_query($db, $sql)) {
  //  echo "Your Bet has been placed successfully.<br>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
}
}
?>
 <div class="notifications-container">
  <div class="success">
    <div class="flex">
      <div class="flex-shrink-0">
        
        
        <svg  class="succes-svg"  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        </svg>
      </div>
      <div class="success-prompt-wrap">
        <p class="success-prompt-heading">Bet Placed
        </p><div class="success-prompt-prompt">
          <p>Cross Your fingers. The darw is up soon and you might just be our lucky winner this hour..</p>
        </div>
          <div class="success-button-container">
            <button type="button" class="success-button-main"><?php echo"Draw ID". $Draw ?></button>
            <button type="button" class="success-button-secondary"><a href="howlow.php">Dismiss</a></button>
          </div>
      </div>
    </div>
  </div>
</div>
 <script>
     // Automatically redirect back to the index page after 5 seconds
     setTimeout(function() {
         window.location.href = "howlow.php";
     }, 2000); // 2 seconds
 </script>
</body>
</html>