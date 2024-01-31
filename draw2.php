<!DOCTYPE html>
<html>
<head>
 <title>Processing Bet...</title>
 <link rel="stylesheet" href="./assets/css/notif.css">
</head>
<body>

 <?php
    include './include/config.php';
  
    // Get all user bets from the database
    $sql = "SELECT *, SUM(stake) AS total_stake FROM low GROUP BY choice";
    $result = mysqli_query($db, $sql);

    if (!$result) {
        die("Error fetching data: " . mysqli_error($db));
    }

    // Store the aggregated stake data in an associative array
    $aggregatedStakes = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $aggregatedStakes[$row["choice"]] = $row["total_stake"];
    }

    // Determine the winning choice with the least aggregated stake
    $winningChoice = array_search(min($aggregatedStakes), $aggregatedStakes);
    //curren draw
    $sqlz="SELECT MAX(id) AS draw FROM low";
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

    // Find all participants who chose the winning option
    $participants = array();
    $sql = "SELECT name, stake FROM low WHERE choice = $winningChoice AND id='$Draw'";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $participants[] = $row;
    }

    // Calculate the total amount available for distribution (80% of the total stakes)
    $totalStakes = array_sum($aggregatedStakes);
    $distributionAmount = 0.8 * $totalStakes;

    // Calculate the amount to keep with the house (20% of the total stakes)
    $houseAmount = 0.2 * $totalStakes;

    // Close the database dbection
   

   // Function to distribute the winnings equally among the winners based on their stake amount
    function distributeWinnings($participants, $distributionAmount) {
        $totalStake = array_sum(array_column($participants, 'stake'));
        $totalWinners = count($participants);

        // Calculate the average share based on the total stakes and the number of winners
        $averageShare = ($totalWinners > 0) ? $distributionAmount / $totalStake : 0;

        $winnings = array();
        $conn = new mysqli("localhost", "root", "", "bet"); // Replace with your database credentials

        foreach ($participants as $participant) {
            // Calculate the winnings for each participant based on their stake amount
            $amount = $averageShare * $participant['stake'];

            // Ensure that the winnings do not exceed the available distribution amount
            $amount = min($amount, $distributionAmount);
            $distributionAmount -= $amount;
            $winnings[$participant['name']] = $amount;
            //
            foreach ($participants as $participant) {
              // Calculate the winnings for each participant based on their stake amount
              $amount = $averageShare * $participant['stake'];
      
              // Ensure that the winnings do not exceed the available distribution amount
              $amount = min($amount, $distributionAmount);
              $distributionAmount -= $amount;
              $winnings[$participant['name']] = $amount;
      
              // Update the database table with the winnings for each participant
              $sql = "UPDATE balance SET winnings = winnings + $amount WHERE name = '{$participant['name']}'";
      
              if ($conn->query($sql) !== TRUE) {
                  echo "Error updating record: " . $conn->error;
              }
          }
      
        }
        return $winnings;
    }


   // Distribute winnings among the participants
   $winnersWinnings = distributeWinnings($participants, $distributionAmount);

   // Prepare the output to display winners and their respective winnings
   $winnersOutput = "<br><h3>Winners and Their Winnings:</h3>";
   foreach ($winnersWinnings as $name => $amount) {
       $winnersOutput .= "{$name}: $" . $amount . "<br>";
   }
   $sql = "SELECT now FROM timer WHERE now = (SELECT MAX(now) From timer)";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $timestampFromDatabase = strtotime($row["now"]);
    // Add one hour to the timestamp
    $oneHourLater = date("Y-m-d H:i:s", strtotime('+2 hour', $timestampFromDatabase));
    $sql ="INSERT INTO timer (end) values ('$oneHourLater')";
    $result = $db->query($sql);
   // Get unique number
   
// SQL query to retrieve the lowest unique number
$sql = "WITH CountChoices AS (
    SELECT name, choice, COUNT(choice) AS count_selected
    FROM low
    GROUP BY choice
),
UniqueChoices AS (
    SELECT choice
    FROM CountChoices
    WHERE count_selected = 1
)
SELECT MIN(choice) AS lowest_unique_number
FROM UniqueChoices";

$result = $db->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lowest_unique_number = $row["lowest_unique_number"];
    //echo "Lowest Unique Number: " . $lowest_unique_number;
    ?><!--if insufficient -->
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
          <p class="success-prompt-heading">Draw Complete
          </p><div class="success-prompt-prompt">
            <p>The lowest unique number from that draw was <?php $lowest_unique_number ?></p>
          </div>
            <div class="success-button-container">
              <button type="button" class="success-button-main"><a href="login.php">Back</a></button>
              <button type="button" class="success-button-secondary"><a href="index.php">Dismiss</a></button>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end if isuu html--><?php

    // Now, you can use $lowest_unique_number in your PHP code as needed.
} else {
    echo "RollOver!! No unique numbers found.";
}
//insert the number
$sql="INSERT INTO win (numb, user ) Values ('$lowest_unique_number','')";
// Close the database connection
$db->close();
?>
 <script>
     // Automatically redirect back to the index page after 5 seconds
     setTimeout(function() {
         window.location.href = "howlow.php";
     }, 5000); // 5 seconds
 </script>
</body>
</html>


