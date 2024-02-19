<?php
session_start();
include "includes/connection.php";

// Fetch values from the database (replace 'your_table' and 'your_column' with actual table and column names)
$sql = "SELECT * FROM staff_dm_allocation where staffid='" . $_SESSION['empid'] . "' and work_status='Active' order by id desc";
$result = $connection->query($sql);

$response = array();

if ($result->num_rows > 0) {
    
    // Fetching values
    while ($row = $result->fetch_assoc()) {
        $queryorder = "select brandName,id from order_customers where id='" .  $row['orderid'] ."'";
        $select_postsorder = mysqli_query($connection, $queryorder);
        while ($roworder = mysqli_fetch_assoc($select_postsorder)) {
            // Create an associative array with multiple fields
            $orderData = array(
                'brandName' => $roworder['brandName'] . '  -  ' . $row['postings'],
                'id' => $row['id'],
                'orderid' => $row['orderid'],
            );
        }
// Append the associative array to the $response['values'] array
$response['values'][] = $orderData;
    }

    $response['status'] = 1;
} else {
    $response['status'] = 0;
}

// Close the database connection
$connection->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
