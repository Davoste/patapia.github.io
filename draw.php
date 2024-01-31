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

    // Find all participants who chose the winning option
    $participants = array();
    $sql = "SELECT name, stake FROM user_bets WHERE choice = $winningChoice";
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
    mysqli_close($db);

   // Function to distribute the winnings equally among the winners based on their stake amount
    function distributeWinnings($participants, $distributionAmount) {
        $totalStake = array_sum(array_column($participants, 'stake'));
        $totalWinners = count($participants);

        // Calculate the average share based on the total stakes and the number of winners
        $averageShare = ($totalWinners > 0) ? $distributionAmount / $totalStake : 0;

        $winnings = array();
        foreach ($participants as $participant) {
            // Calculate the winnings for each participant based on their stake amount
            $amount = $averageShare * $participant['stake'];

            // Ensure that the winnings do not exceed the available distribution amount
            $amount = min($amount, $distributionAmount);
            $distributionAmount -= $amount;
            $winnings[$participant['name']] = $amount;
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
?>
<!DOCTYPE html>
<html>
<head>
 <title>Processing Bet...</title>
</head>
<body>
 <h1>Processing Bet...</h1>
 <script>
     // Automatically redirect back to the index page after 5 seconds
     setTimeout(function() {
         window.location.href = "index.php";
     }, 5000); // 5 seconds
 </script>
</body>
</html>