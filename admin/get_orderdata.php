<?php
// Database connection
include "includes/connection.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data based on ID
$id = $_GET['id']; // Get the ID from the URL parameter

$sql = "SELECT * FROM order_customers WHERE id = $id"; // Replace 'your_table' with your actual table name
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data as JSON
    $row = $result->fetch_assoc();
    $data = array(
        'brandName' => $row['brandName'],
        'quotedAmount' => $row['quotedAmt'],
        'customerName' => $row['custName']
    );
    echo json_encode($data);
} else {
    echo "No data found";
}

$conn->close();
?>
