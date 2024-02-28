<?php
// Replace these values with your actual database connection details
include "includes/connection.php";

$querydept = "SELECT * FROM department where dname='Graphics'";
$resultdept = $connection->query($querydept);
if ($resultdept) {
    while ($rowdept = $resultdept->fetch_assoc()) {
        $deptid = $rowdept['id'];
    }}

// Fetch options from the database
$query = "SELECT * FROM employee where department_id='" . $deptid . "'";
$result = $connection->query($query);
if ($result) {
    $optionsData = array();
    while ($row = $result->fetch_assoc()) {
        $optionsData[] = $row['empname'];
    }

    // Send options as JSON
    header('Content-Type: application/json');
    echo json_encode($optionsData);
} else {
    // Handle the error, e.g., log it or send an error response
    echo "Error: " . $connection->error;
}

// Close the database connection
$connection->close();
?>
