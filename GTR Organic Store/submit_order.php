<?php
// Retrieve form data
$name = $_POST['name'];
$phone = $_POST['phone'];
$order_option = $_POST['order_option'];
$order_description = $_POST['order_description'];
$elements = $_POST['element'];
$quantities = $_POST['quantity'];
$descriptions = $_POST['description'];

// Connect to the database
// Database credentials
$servername = "localhost";
$username = "id20823038_tech";
$password = "Tech-1212";
$dbname = "id20823038_tech";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the orders table if it doesn't exist
$createTableQuery = "CREATE TABLE IF NOT EXISTS orders (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    order_option VARCHAR(255) NOT NULL,
    order_description TEXT,
    element VARCHAR(255) NOT NULL,
    quantity INT(6) NOT NULL,
    description VARCHAR(255) NOT NULL
)";
$conn->query($createTableQuery);

// Insert the form data into the orders table
$insertQuery = "INSERT INTO orders (name, phone, order_option, order_description, element, quantity, description) VALUES ";
for ($i = 0; $i < count($elements); $i++) {
    $element = $conn->real_escape_string($elements[$i]);
    $quantity = $conn->real_escape_string($quantities[$i]);
    $description = $conn->real_escape_string($descriptions[$i]);

    $insertQuery .= "('$name', '$phone', '$order_option', '$order_description', '$element', '$quantity', '$description')";
    if ($i != count($elements) - 1) {
        $insertQuery .= ",";
    }
}

if ($conn->query($insertQuery) === TRUE) {
    echo "Order submitted successfully.";
} else {
    echo "Error: " . $insertQuery . "<br>" . $conn->error;
}

$conn->close();
?>