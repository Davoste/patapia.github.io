<!-- register_handler.php -->
<?php
include './include/config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm=$_POST['conf-password'];
    $email = $_POST["mail"];
    $phone = $_POST["number"];
  
     // Simple password matching check
     if ($password !== $confirm) {
        echo "Passwords do not match. Please try again.";
    } else {
  
    // Check if the username already exists
    $checkUsernameQuery = "SELECT id FROM users WHERE username = '$username'";
    $result = mysqli_query($db, $checkUsernameQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "Username already exists. Please choose a different username.";
        die( "Username already exists. Please choose a different username.");
    }
    else {
        // Insert user data into the database (Note: You should hash the password before storing it)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO users (name, email, password, phone) VALUES ('$username', '$email', '$hashed_password', '$phone')";

        $result = mysqli_query($db, $insert_query);

        if ($result) {
            echo "Registration successful!";
            header("Location: login.php");
        } else {
            echo "Registration failed. Please try again.";
            header("Location: register.php");
        }

        // Close the database connection
        mysqli_close($db);
    }
}
}


?>
