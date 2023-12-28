<?php
// Connect to your database (modify these parameters accordingly)
include "includes/connection.php";

// Check connection

$remarks = 'not-exists';
// Fetch data based on the order ID
if (isset($_POST['recordId'])) {
    $orderId = $_POST['recordId'];
    // echo  $orderId ;

    $sql = "SELECT * FROM quote_splitup WHERE orderid = $orderId";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        $remarks = 'exists';
    }



echo $remarks ;
}
?>

