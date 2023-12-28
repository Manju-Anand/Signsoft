<?php
// Connect to your database (modify these parameters accordingly)
include "includes/connection.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data based on the order ID
if (isset($_POST['order_id'])) {
    $orderId = $_POST['order_id'];
    $u=0;
    $sql = "SELECT * FROM quote_splitup WHERE orderid = $orderId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $u=$u+1;
          
                    echo "<tr>";
                    echo "<td>" . $u . "</td>";
                    echo "<td>" . $row['itemid'] . "</td>";
                    echo "<td>" . $row['itemname'] . "</td>";
                    echo "<td >" . $row['price'] . "</td>";
                    echo "</tr>";
                }
            } else {
        echo "<tr><td colspan='2'>No data found</td></tr>";
    }

    $conn->close();
}
?>

