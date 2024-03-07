<?php
// Include your database connection file
include "includes/connection.php";

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    $recordId = $_POST['recordId'];
    $editpostercontent = $_POST['editpostercontent'];
    $editposteridea = $_POST['editposteridea'];
    date_default_timezone_set("Asia/Calcutta");
    $postdate = date("M d,Y h:i:s a");
    $assigndate = date("d-m-Y", strtotime("now"));
    // Validate and sanitize the data (you should customize this based on your requirements)

    // Example validation: Ensure fields are not empty
    if (empty($recordId) || empty($editpostercontent) || empty($editposteridea)) {
        die('Error: All fields are required.');
    }

    // Example validation: Ensure selectedEmployeeId is a number
    if (!is_numeric($recordId)) {
        die('Error: Invalid employee ID.');
    }

        $sqlupdate = "UPDATE staff_dm_graphics_allocation SET content='". $editpostercontent . "',posteridea='" . $editposteridea . "'
         WHERE id='" . $recordId ."'";

        if ($connection->query($sqlupdate) === TRUE) {
        echo "Record updated successfully";
        } else {
        echo "Error updating record: " . $connection->error;
        }

      
    
    // Close the database connection
    $connection->close();
} else {
    // If the request is not a POST request, return an error
    die('Error: Invalid request method.');
}
?>
