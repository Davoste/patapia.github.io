<!-- login_handler.php -->

<!DOCTYPE html>
<html>
<head>
 <title>Loging in...</title>
 <link rel="stylesheet" href="./assets/css/notif.css">
</head>
<body>

<?php
// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password (use password_hash() for better security in production)
    $hashedPassword = md5($password);

    // Connect to the database
    $dbHost = "localhost"; // e.g., "localhost"
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "bet";

    $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

    // Check the database connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve user data from the database
    $getUserQuery = "SELECT id, balance FROM users WHERE name = '$username' AND password = '$hashedPassword'";
    $result = mysqli_query($conn, $getUserQuery);

    if (mysqli_num_rows($result) === 1) {
        // User login successful
        $userData = mysqli_fetch_assoc($result);

        // Store user information in the session
        $_SESSION["user_id"] = $userData["id"];
        $_SESSION["user_name"] = $username;
        $_SESSION["user_balance"] = $userData["balance"];

        // Redirect to the index page or any other page after login
        header("Location: howlow.php");
    } else {
        // Login failed   
        ?><!--if insufficient -->
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
            <p class="failed-prompt-heading">Invalid Credentials
            </p><div class="failed-prompt-prompt">
              <p>Invalid username or password. Kindly check your details and try again..</p>
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

    }

    // Close the database connection
    mysqli_close($conn);
}
?>
</body>
</html>