<?php
// Example connection parameters; replace with your actual database credentials
include "includes/connection.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the data sent from the client
$data = json_decode(file_get_contents("php://input"), true);
print_r($data);
// Iterate through the data and insert into the database
foreach ($data as $row) {
    $orderid = $row['orderid'];
    $entry = $row['entry'];
    $entryid = $row['entryid'];
    $staffName = $row['staffName'];
    $staffid = $row['staffid'];
    $workAssigned = $row['workAssigned'];
    $deadline = $row['deadline'];
    $percentOfWork = $row['percentOfWork'];

    // Perform the SQL query to insert data into the database
    $sql = "INSERT INTO staff_allocation (orderid,entryid,entryname,empid, empname, work_assigned, deadline, per_of_work) VALUES
     ('$orderid','$entryid','$entry','$staffid', '$staffName', '$workAssigned', '$deadline', '$percentOfWork')";
    
    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
