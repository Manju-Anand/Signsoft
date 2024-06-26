<?php
include "includes/connection.php";

if (isset($_POST['order_id'])) {
    $orderId = $_POST['order_id'];

    $sql = "SELECT subcategory_id FROM order_subcategory WHERE order_id='$orderId'";
    $result = $connection->query($sql);

    $selectedSubcategories = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $selectedSubcategories[] = $row['subcategory_id'];
        }
    }

    echo json_encode($selectedSubcategories);
}
?>
