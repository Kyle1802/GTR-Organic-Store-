<?php
// Database connection details
$servername = "localhost";
$username = "id20823038_tech";
$password = "Tech-1212";
$dbname = "id20823038_tech";

// Retrieve data from the form
$orderNumber = $_POST['order_number'];
$totalPrice = $_POST['total_price'];

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the cart_items table if it doesn't exist
$createTableSql = "CREATE TABLE IF NOT EXISTS cart_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_number INT,
  total_price DECIMAL(10,2)
)";
if ($conn->query($createTableSql) === TRUE) {
    echo "Table 'cart_items' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Prepare and execute the SQL query to save the cart items
$sql = "INSERT INTO cart_items (order_number, total_price) VALUES ('$orderNumber', '$totalPrice')";
if ($conn->query($sql) === TRUE) {
    echo "Cart items saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>