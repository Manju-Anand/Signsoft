<?php
// Include your database connection file
include "includes/connection.php";

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    $recordId = $_POST['recordId'];
    $selectedEmployeeId = $_POST['selectedEmployeeId'];
    $deadline = $_POST['deadline'];
    date_default_timezone_set("Asia/Calcutta");
    $postdate = date("M d,Y h:i:s a");
    $assigndate = date("d-m-Y", strtotime("now"));
    // Validate and sanitize the data (you should customize this based on your requirements)

    // Example validation: Ensure fields are not empty
    if (empty($recordId) || empty($selectedEmployeeId) || empty($deadline)) {
        die('Error: All fields are required.');
    }

    // Example validation: Ensure selectedEmployeeId is a number
    if (!is_numeric($selectedEmployeeId)) {
        die('Error: Invalid employee ID.');
    }
    $orderid="";
    $assignedStaffid="";
    $postings="";
    $content="";
    $status="";
    $work_status="";
    $redirect_status="";
    $posteridea="";
// ***************************** delete if already redirected *********************
$query = "DELETE FROM staff_dm_graphics_allocation WHERE redirect_recordid = '" . $recordId . "'";
$delete_query = mysqli_query($connection, $query);
if (!$delete_query) {
    die('QUERY FAILED' . mysqli_error($connection));
}
// **********************************************
    $query = "select * from staff_dm_graphics_allocation where id='" . $recordId ."'";
    $select_posts = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $orderid=$row['orderid'];
        $assignedStaffid=$row['staffid'];
        $postings=$row['postings'];
        $content=$row['content'];
        $status='New';
        $work_status=$row['work_status'];
        $redirect_status='Self';
        $posteridea=$row['posteridea'];
        
    }
    // Perform database insertion
    $sql = "INSERT INTO staff_dm_graphics_allocation (orderid,staffid,postings,content, status, assigndate, work_status,created,assigned_staffid,redirect_status,posteridea,deadline,redirect_recordid)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param('iissssssissss', $orderid, $selectedEmployeeId,  $postings, $content,  $status, $assigndate, $work_status, $postdate, $assignedStaffid, $redirect_status, $posteridea, $deadline,$recordId);

    // Execute the statement
    if ($stmt->execute()) {

        $sqlupdate = "UPDATE staff_dm_graphics_allocation SET redirect_status='Redirected',redirect_staffid='" . $selectedEmployeeId . "',
        redirect_deadline='" . $deadline ."' WHERE id='" . $recordId ."'";

        if ($connection->query($sqlupdate) === TRUE) {
        echo "Record updated successfully";
        } else {
        echo "Error updating record: " . $connection->error;
        }

        // Insertion successful
        echo 'Data saved successfully';
    } else {
        // Insertion failed
        echo 'Error saving data: ' . $stmt->error;
    }

    // Close the statement
    $stmt->close();
    
    // Close the database connection
    $connection->close();
} else {
    // If the request is not a POST request, return an error
    die('Error: Invalid request method.');
}
?>
