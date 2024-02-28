<?php
// Example connection parameters; replace with your actual database credentials
include "includes/connection.php";

// Get the data sent from the client
$data = json_decode(file_get_contents("php://input"), true);

// ====================== delete already entered datas =============
// Iterate through the data and insert into the database

if (isset($data['staffallocationdataToSave'])) {
  echo "1";
  foreach ($data['staffallocationdataToSave'] as $row) {
    $workdate = $row['workdate'];
    echo "2";
    $worktime = $row['worktime'];
    $workstatus = $row['workstatus'];
    $allotid = $row['allotid'];
    $orderid = $row['orderid'];
    $empid = $row['empid'];
    $editid = $row['editid'];
    $recordstatus = $row['recordstatus'];
    date_default_timezone_set("Asia/Calcutta");
    $postdate = date("M d,Y h:i:s a");
 
 
    // Perform the SQL query to insert data into the database
    if ($recordstatus == "Edited") {

      $sql = "UPDATE staff_allocation_details SET orderid='" . $orderid . "',empid='" . $empid . "',staff_allocation_id='" . $allotid . "',timetaken='" . $worktime . "',
      work_status='" . $workstatus . "',workdate='" . $workdate . "',record_status='" . $recordstatus . "',modified='" . $postdate . "' WHERE id='" . $editid . "'";
      if ($connection->query($sql) !== TRUE) {

        echo "Error: " . $sql . "<br>" . $connection->error;
      }


      
    } elseif ($recordstatus == "New") {

      $sql = "INSERT INTO staff_allocation_details (orderid,empid,staff_allocation_id,timetaken, work_status, workdate, record_status,created) VALUES
      ('$orderid','$empid','$allotid','$worktime', '$workstatus', '$workdate', '$recordstatus','$postdate')";
      if ($connection->query($sql) !== TRUE) {
        
        echo "Error: " . $sql . "<br>" . $connection->error;
      }else {
        $last_id = $connection->insert_id;
      }



    } else { }

   
  }
}


// Close the database connection
$connection->close();
