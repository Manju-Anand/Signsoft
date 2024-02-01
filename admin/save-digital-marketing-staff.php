<?php
// Example connection parameters; replace with your actual database credentials
include "includes/connection.php";

// Get the data sent from the client
$data = json_decode(file_get_contents("php://input"), true);
// ====================== delete already entered datas =============
$corderid =$data['correctorderid'];
echo $corderid ;
$sql = "DELETE FROM staff_dm_allocation WHERE orderid='". $corderid ."'";

if ($connection->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $connection->error;
}


// ====================== delete already entered datas =============
// Iterate through the data and insert into the database



if (isset($data['staffallocationdataToSave'])) {
  foreach ($data['staffallocationdataToSave'] as $row) {
    $orderid = $row['orderid'];
    $Payment = $row['Payment'];
    $Postings = $row['Postings'];
    $staffName = $row['staffName'];
    $staffid = $row['staffid'];
    $Frequency = $row['Frequency'];
    $StartDate = $row['StartDate'];
    $EndDate = $row['EndDate'];
    $promoamt = $row['promoamt'];
    // $payStatus = $row['payStatus'];
    // if ($payStatus !== "Saved") {
    // Perform the SQL query to insert data into the database
    $sql = "INSERT INTO staff_dm_allocation (orderid,payment,postings,staffname, staffid, frequency, startdate, enddate,promoamt) VALUES
     ('$orderid','$Payment','$Postings','$staffName', '$staffid', '$Frequency', '$StartDate', '$EndDate', '$promoamt')";
    
    if ($connection->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
  // }
}
}




// Close the database connection
$connection->close();
?>
