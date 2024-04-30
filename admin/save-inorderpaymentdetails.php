<?php
// Example connection parameters; replace with your actual database credentials
include "includes/connection.php";

// Get the data sent from the client
$data = json_decode(file_get_contents("php://input"), true);
// ====================== delete already entered datas =============
$corderid =$data['correctorderid'];


$sql = "DELETE FROM staff_allocation WHERE orderid='". $corderid ."'";

if ($connection->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $connection->error;
}



// ====================== delete already entered datas =============




if (isset($data['staffallocationdataToSave'])) {
  foreach ($data['staffallocationdataToSave'] as $row) {
    $orderid = $row['orderid'];
    $entry = $row['entry'];
    $entryid = $row['entryid'];
    $staffName = $row['staffName'];
    $staffid = $row['staffid'];
    $workAssigned = $row['workAssigned'];
    $deadline = $row['deadline'];
    $percentOfWork = $row['percentOfWork'];
    $assignDate = $row['assignDate'];
    $payStatus = $row['payStatus'];
    $postdate = date("M d,Y h:i:s a");
    // if ($payStatus !== "Saved") {
    // Perform the SQL query to insert data into the database
    $sql = "INSERT INTO staff_allocation (orderid,entryid,entryname,empid, empname, work_assigned, deadline, per_of_work,assignedDate,created) VALUES
     ('$orderid','$entryid','$entry','$staffid', '$staffName', '$workAssigned', '$deadline', '$percentOfWork', '$assignDate','$postdate')";
    
    if ($connection->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
  // }
}
}




// Close the database connection
$connection->close();
?>
