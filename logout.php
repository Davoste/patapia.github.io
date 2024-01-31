<!-- logout.php -->
<?php


// Destroy the session (log out the user)
session_destroy();

// Redirect the user back to the login page (or any other page after logout)
header("Location: login.php");
exit;
?>
