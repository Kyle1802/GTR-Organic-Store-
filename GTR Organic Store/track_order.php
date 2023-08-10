<?php
// Retrieve order number from the request
$orderNumber = $_POST['order_number'];

// Connect to the database
$servername = "localhost";
$username = "id20823038_tech";
$password = "Tech-1212";
$dbname = "id20823038_tech";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query the database to fetch the order details
$query = "SELECT * FROM orders WHERE id = '$orderNumber'";
$result = $conn->query($query);

if ($result) {
    if ($result->num_rows > 0) {
        // Order found
        $order = $result->fetch_assoc();
        $element = $order['element'];
        echo "Order Is Being Delivered $orderNumber: $element";
    } else {
        // No order found for the provided order number
        echo "No order found for the provided order number.";
    }
} else {
    // Error in executing the query
    echo "Error: " . $conn->error;
}

$conn->close();
?>
