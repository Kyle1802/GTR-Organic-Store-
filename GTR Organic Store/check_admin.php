<?php
$servername = "localhost";
$username = "id20823038_tech";
$password = "Tech-1212";
$dbname = "id20823038_tech";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists in the database
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, redirect to the edit page
        header("Location: edit_page.html");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}

// Handle sign-up
if (isset($_POST['new_username']) && isset($_POST['new_password'])) {
    $newUsername = $_POST['new_username'];
    $newPassword = $_POST['new_password'];

    // Insert the new user into the database
    $sql = "INSERT INTO users (username, password) VALUES ('$newUsername', '$newPassword')";
    if ($conn->query($sql) === TRUE) {
        echo "Sign-up successful. Please log in.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
