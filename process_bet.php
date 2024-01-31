
    <!-- process_bet.php -->
    <?php
    session_start();
    // Assuming that the choices are represented by integers 1, 2, and 3.
    $validChoices = [1, 2, 3];
    $name = $_SESSION['user_name'];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Gather user input
        
        $choice = (int)$_POST["choice"];
        $stake = (int)$_POST["stake"];
    
        // Check if the choice is valid
        if (!in_array($choice, $validChoices)) {
            die("Invalid choice. Please select either 1, 2, or 3.");
        }
    
        // Connect to the MySQL database
        $dbHost = "localhost"; // e.g., "localhost"
        $dbUser = "root";
        $dbPassword = "";
        $dbName = "bet";
    
         $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);   
    // Check the database connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    $userBalance = floatval($_SESSION['user_balance']);

    // Get form data
    $stake = floatval($_POST["stake"]);

    // Validate the stake amount against the user's balance
    if ($stake > $userBalance) {
        die("Insufficient balance. Please enter a lower stake.");
    }


    // Deduct the stake amount from the user's account balance
    $updatedBalance = $userBalance - $stake;
    $sql = "UPDATE users SET balance = $updatedBalance WHERE name = '$name'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error updating user balance: " . mysqli_error($conn));
    }


    // Prepare and execute the SQL query to insert the user's bet
    $sql = "INSERT INTO user_bets (name, choice, stake) VALUES ('$name', $choice, $stake)";

    if (mysqli_query($conn, $sql)) {
        echo "Your Bet has been added to the database successfully.<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Get all user bets from the database
    $sql = "SELECT choice, SUM(stake) AS total_stake FROM user_bets WHERE time(time)>=NOW()-INTERVAL 10 MINUTE  GROUP BY choice";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error fetching data: " . mysqli_error($conn));
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
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $participants[] = $row;
    }

    // Calculate the total amount available for distribution (80% of the total stakes)
    $totalStakes = array_sum($aggregatedStakes);
    $distributionAmount = 0.8 * $totalStakes;

    // Calculate the amount to keep with the house (20% of the total stakes)
    $houseAmount = 0.2 * $totalStakes;

    // Close the database connection
    mysqli_close($conn);
    // Function to get the user's balance from the database
    function getUserBalanceFromDatabase($conn, $username) {
        $sql = "SELECT balance FROM users WHERE name = '$username'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Error fetching user balance: " . mysqli_error($conn));
        }

        $row = mysqli_fetch_assoc($result);
        return floatval($row['balance']);
    }
    // Function to update the user's balance in the database
    function updateUserBalanceInDatabase($conn, $username, $newBalance) {
        $sql = "UPDATE users SET balance = $newBalance WHERE name = '$username'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Error updating user balance: " . mysqli_error($conn));
        }
    }

    function distributeWinnings($participants, $distributionAmount) {
        // Calculate the total stake amount and total number of winners
        $totalStake = array_sum(array_column($participants, 'stake'));
        $totalWinners = count($participants);
    
        // Calculate the average share based on the total stakes and the number of winners
        $averageShare = ($totalWinners > 0) ? $distributionAmount / $totalStake : 0;
    
        // Generate a unique ID for the current draw
        $drawId = uniqid();
    
        $winnings = array();

        // Connect to the MySQL database
        $dbHost = "localhost"; // e.g., "localhost"
        $dbUser = "root";
        $dbPassword = "";
        $dbName = "bet";
    
         $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);   
        foreach ($participants as $participant) {
            // Calculate the winnings for each participant based on their stake amount
            $amount = $averageShare * $participant['stake'];
    
            // Ensure that the winnings do not exceed the available distribution amount
            $amount = min($amount, $distributionAmount);
            $distributionAmount -= $amount;
    
            // Update the user's balance if they win
            if ($amount > 0) {
                $userBalance = getUserBalanceFromDatabase($conn, $participant['name']);
                $newBalance = $userBalance + $amount;
                updateUserBalanceInDatabase($conn, $participant['name'], $newBalance);
            }
    
            $winnings[$participant['name']] = $amount;
        }
    
        // Store draw details in the "draws" table
        $drawWinningOdds = ($totalStake > 0) ? ($distributionAmount / $totalStake) * 100 : 0;
        $sql = "INSERT INTO draws (id, winning_odds) VALUES ('$drawId', $drawWinningOdds)";
        mysqli_query($conn, $sql);
    
        return $winnings;
    }


    // Distribute winnings among the participants
    $winnersWinnings = distributeWinnings($participants, $distributionAmount);

    echo "<br>";
    echo "The aggregated stakes for each choice:<br>";
    foreach ($aggregatedStakes as $choice => $stake) {
        echo "Choice {$choice}: $" . $stake . "<br>";
    }

    echo "<br>";
    echo "The winning choice is: " . $winningChoice . "<br>";
    echo "The winnings for each winner:<br>";
    foreach ($winnersWinnings as $name => $amount) {
        echo "{$name}: $" . $amount . "<br>";
    }
     // Connect to the MySQL database
     $dbHost = "localhost"; // e.g., "localhost"
     $dbUser = "root";
     $dbPassword = "";
     $dbName = "bet";
 
     $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
 
     // Check the database connection
     if (!$conn) {
         die("Connection failed: " . mysqli_connect_error());
     }
 
     // Insert winners and their winnings to a database table
     foreach ($winnersWinnings as $name => $amount) {
         $sql = "INSERT INTO winners (name, winnings) VALUES ('$name', $amount)";
         mysqli_query($conn, $sql);
     }
 
     // Close the database connection
     mysqli_close($conn);
 
}
?>
    

 <script>
     // Automatically redirect back to the index page after 5 seconds
     setTimeout(function() {
         window.location.href = "index.php";
     }, 15000); // 1 seconds
 </script>