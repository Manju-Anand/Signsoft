<?php
// Example connection parameters; replace with your actual database credentials
include "includes/connection.php";

// Set the character set to UTF-8
$connection->set_charset("utf8mb4");
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
    $content =  mysqli_real_escape_string($connection, $row['content']);
    // $content = htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8');
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
      while ($rowdept = $result->fetch_assoc()) {
        $sqlemp = "SELECT * FROM employee where department_id='" . $rowdept['id']  . "' and hod='Yes'";
        $resultemp = $connection->query($sqlemp);
        if ($resultemp->num_rows > 0) {
          while ($rowemp = $resultemp->fetch_assoc()) {
            $staffid = $rowemp['id'];
          }
        }
      }
    }

    // Perform the SQL query to insert data into the database

    // if (isset($row['editid']) && $row['editid'] !== "") {
      if ($recordstatus == "Edited") {
      // ========================================
      // Prepare an update statement
      $sql = "UPDATE staff_dm_graphics_allocation SET orderid=?, staffid=?, postings=?, content=?, assigndate=?, status='Edited', modified=?, assigned_staffid=?, redirect_status='Self', posteridea=?, deadline=? WHERE id=?";

      if ($stmt = $connection->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("sssssssssi", $orderid, $staffid, $posting, $content, $assigndate, $postdate, $empid, $idea, $deadline, $editid);

        if ($stmt->execute()) {
          echo "Updated";
        } else {
          echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
      } else {
        echo "Error: " . $connection->error;
      }


      // ==================================================
    // } else {
    } elseif ($recordstatus == "New") {
      // ================================================
      // Prepare an insert statement
      $sql = "INSERT INTO staff_dm_graphics_allocation (orderid, staffid, postings, content, status, assigndate, work_status, created, assigned_staffid, redirect_status, posteridea, deadline) VALUES (?, ?, ?, ?, 'New', ?, 'Active', ?, ?, 'Self', ?, ?)";

      if ($stmt = $connection->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("sssssssss", $orderid, $staffid, $posting, $content, $assigndate, $postdate, $empid, $idea, $deadline);



        if ($stmt->execute()) {
          echo "saved";
          $last_id = $connection->insert_id;
        } else {
          echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
      } else {
        echo "Error: " . $connection->error;
      }



      // =============================================
    }
  }
}


// Close the database connection
$connection->close();
