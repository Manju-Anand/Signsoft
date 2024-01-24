<?php
include "includes/connection.php"; // Include your database connection file
$orderId = $_GET['order_id'];
$subcategoryId = $_GET['subcategory_id'];




echo isSubcategorySelected($orderId, $subcategoryId);



function isSubcategorySelected($orderId, $subcategoryId) {
    global $connection;

    $query = "SELECT * FROM order_subcategory WHERE order_id = '" . $orderId . "' AND subcategory_id = '" . $subcategoryId . "'";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        return json_encode(true);
    } else {
        return json_encode(false);
    }
}

?>
