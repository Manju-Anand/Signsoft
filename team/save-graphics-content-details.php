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
    echo "2";
    $assigndate = $row['assigndate'];
    $posting = $row['posting'];
    $content = $row['content'];
    $idea = $row['idea'];
    $deadline = $row['deadline'];
    $orderid = $row['orderid'];
    $empid = $row['empid'];
    $editid = $row['editid'];
    echo "edit-" . $editid; 
    $recordstatus = $row['recordstatus'];
    date_default_timezone_set("Asia/Calcutta");
    $postdate = date("M d,Y h:i:s a");

    $sql = "SELECT * FROM department where dname='Graphics'";
    $result = $connection->query($sql);
        if ($result->num_rows > 0) {
      while($rowdept = $result->fetch_assoc()) {
        $sqlemp = "SELECT * FROM employee where department_id='". $rowdept['id']  . "' and hod='Yes'";
    $resultemp = $connection->query($sqlemp);
        if ($resultemp->num_rows > 0) {
      while($rowemp = $resultemp->fetch_assoc()) {
       $staffid = $rowemp['id'];
      }
    }
      }
    } 
 
    // Perform the SQL query to insert data into the database

    if (isset($row['editid']) && $row['editid'] !== "") {
    echo "3";
          $sql = "UPDATE staff_dm_graphics_allocation SET orderid='" . $orderid . "',staffid='" . $staffid . "',postings='" . $posting . "',content='" . $content . "',
      assigndate='" . $assigndate . "',status='Edited',modified='" . $postdate . "',assigned_staffid='" . $empid . "',redirect_status='Self',posteridea='" . $idea . "',
      deadline='" . $deadline . "' WHERE id='" . $editid . "'";
      if ($connection->query($sql) !== TRUE) {

        echo "Error: " . $sql . "<br>" . $connection->error;
      }else {
        echo "Updated";
      }


      
    } else {

      $sql = "INSERT INTO staff_dm_graphics_allocation (orderid,staffid,postings,content, status, assigndate, work_status,created,assigned_staffid,redirect_status,posteridea,
      deadline) VALUES
      ('$orderid','$staffid','$posting','$content', 'New', '$assigndate', 'Active','$postdate','$empid','Self','$idea','$deadline')";
      if ($connection->query($sql) !== TRUE) {
        
        echo "Error: " . $sql . "<br>" . $connection->error;
      }else {
        echo "saved";
        $last_id = $connection->insert_id;
      }



    }

   
  }
}


// Close the database connection
$connection->close();
