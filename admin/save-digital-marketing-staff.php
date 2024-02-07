<?php
// Example connection parameters; replace with your actual database credentials
include "includes/connection.php";

// Get the data sent from the client
$data = json_decode(file_get_contents("php://input"), true);
// ====================== delete already entered datas =============
$recordstatus="New";
$corderid =$data['correctorderid'];
$datastatus =$data['datastatus'];
if($datastatus == "SavedData"){
  $recordstatus="Edited";
}
echo $corderid ;
// $sql = "DELETE FROM staff_dm_allocation WHERE orderid='". $corderid ."'";

// if ($connection->query($sql) === TRUE) {
//   echo "Record deleted successfully";
// } else {
//   echo "Error deleting record: " . $connection->error;
// }


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
    $postdate = date("M d,Y h:i:s a");
    $assigndate = date("d-m-Y");
    $editid= $row['editid'];
    // Perform the SQL query to insert data into the database
   if ($recordstatus="Edited"){
      $sql = "UPDATE staff_dm_allocation SET payment='" . $Payment . "',postings='" . $Postings . "',staffname='" . $staffName . "',staffid='" . $staffid . "',frequency='" . $Frequency . "',
      startdate='" . $StartDate . "',enddate='" . $EndDate . "',promoamt='". $promoamt ."',modified='". $postdate ."',orderid='" . $orderid . "',status='". $recordstatus ."',
      assigndate='". $assigndate . "' WHERE id='". $editid . "'";
   } else {
      $sql = "INSERT INTO staff_dm_allocation (orderid,payment,postings,staffname, staffid, frequency, startdate, enddate,promoamt,status,assigndate) VALUES
      ('$orderid','$Payment','$Postings','$staffName', '$staffid', '$Frequency', '$StartDate', '$EndDate', '$promoamt','$recordstatus','$assigndate')";

   }
    
    if ($connection->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

}
}




// Close the database connection
$connection->close();
?>
