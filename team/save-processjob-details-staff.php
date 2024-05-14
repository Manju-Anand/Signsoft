<?php
// Example connection parameters; replace with your actual database credentials
include "includes/connection.php";

// Get the data sent from the client
$data = json_decode(file_get_contents("php://input"), true);

// ====================== delete already entered datas =============
// Iterate through the data and insert into the database

if (isset($data['staffallocationdataToSave'])) {
  // echo "1";
  foreach ($data['staffallocationdataToSave'] as $row) {
    $workdate = $row['workdate'];
    // echo "2";
    $worktime = $row['worktime'];
    $workdesc = $row['workdesc'];
    $workstatus = $row['workstatus'];
    $allotid = $row['allotid'];
    // $orderid = $row['orderid'];
    $empid = $row['empid'];
    $editid = $row['editid'];
    $recordstatus = $row['recordstatus'];
    date_default_timezone_set("Asia/Calcutta");
    $postdate = date("M d,Y h:i:s a");
 
 
    // Perform the SQL query to insert data into the database
    // if ($recordstatus == "Edited") {
      if (isset($row['editid']) && $row['editid'] !== "") {

      $sql = "UPDATE staff_pjob_allocation_details SET empid='" . $empid . "',staff_allocation_id='" . $allotid . "',timetaken='" . $worktime . "',
      work_status='" . $workstatus . "',job_description='" . $workdesc . "',workdate='" . $workdate . "',record_status='" . $recordstatus . "',modified='" . $postdate . "' WHERE id='" . $editid . "'";
      if ($connection->query($sql) !== TRUE) {

        echo "Error: " . $sql . "<br>" . $connection->error;
      }else {
        echo "<script>console.log('staff_allocation_details updated')</script>";
      }

    } else {
      
    // } elseif ($recordstatus == "New") {

      $sql = "INSERT INTO staff_pjob_allocation_details (empid,staff_allocation_id,timetaken, work_status, workdate, record_status,created,job_description) VALUES
      ('$empid','$allotid','$worktime', '$workstatus', '$workdate', '$recordstatus','$postdate','$workdesc')";
      if ($connection->query($sql) !== TRUE) {
        
        echo "Error: " . $sql . "<br>" . $connection->error;
      }else {
        echo "<script>console.log('staff_allocation_details saved')</script>";
        $last_id = $connection->insert_id;
      }



    } 

   
  }
}


// Close the database connection
$connection->close();
