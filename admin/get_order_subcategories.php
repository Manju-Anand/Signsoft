<?php
include "includes/connection.php";
// Assuming you have a function to fetch order subcategories from the database
function getOrderSubcategories($orderId) {
    // Implement your logic to fetch subcategories from the database based on the order ID
    // Example using mysqli:

    global $connection;
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $orderId = $connection->real_escape_string($orderId);
    
    $query = "SELECT * FROM order_subcategory WHERE order_id = '$orderId'";
    $result = $connection->query($query);

    $subcategories = array();

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $subcategories[] = array(
                'category_id' => $row['category_id'],
                'subcategory_id' => $row['subcategory_id']
            );
        }
        $result->free();
    }

    $connection->close();

    return $subcategories;
}

// Get the order ID from the query parameter
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;

if ($order_id !== null) {
    // Fetch the subcategories for the specified order
    $orderSubcategories = getOrderSubcategories($order_id);

    // Return the JSON-encoded result
    header('Content-Type: application/json');
    echo json_encode($orderSubcategories);
} else {
    // Handle the case where no order ID is provided
    echo "No order ID provided.";
}
?>
