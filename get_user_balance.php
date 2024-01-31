<!-- get_user_balance.php -->
<?php
// Start the session (if not already started)
session_start();

if (isset($_SESSION['user_name'])) {
    $userName = $_SESSION['user_name'];
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

    // Fetch user's account balance from the database (assuming user's name is "John" for this example)
   
    $sql = "SELECT balance FROM users WHERE name = '$userName'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error fetching user balance: " . mysqli_error($conn));
    }

    // Get the user's account balance
    $userData = mysqli_fetch_assoc($result);
    $userBalance = $userData['balance'];

    // Close the database connection
    mysqli_close($conn);

    // Send user's account balance as JSON response
    header('Content-Type: application/json');
    echo json_encode(array('balance' => $userBalance));
    // ... (existing code for fetching user balance and sending JSON response)
} else {
    // If the user's name is not found in the session, return an error
    header('HTTP/1.1 401 Unauthorized');
    die("User not logged in.");
}

?>
