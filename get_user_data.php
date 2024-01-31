<!-- get_user_data.php -->
<?php
// Start the session (if not already started)
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_name']) || !isset($_SESSION['user_balance'])) {
    header('HTTP/1.1 401 Unauthorized');
    die("User not logged in.");
}

// Get the user's name and balance from the session
$userName = $_SESSION['user_name'];
$userBalance = floatval($_SESSION['user_balance']);

// Send user's data as JSON response
header('Content-Type: application/json');
echo json_encode(array('userName' => $userName, 'userBalance' => $userBalance));
?>
