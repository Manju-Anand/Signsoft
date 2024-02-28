<?php
// Get the data sent from the client-side
$data = json_decode($_POST['data'], true);

// Assuming you have a database connection
include "includes/connection.php";

// Insert data into the database (adjust SQL query based on your table structure)
foreach ($data as $rowData) {
    $column1 = $rowData[0];
    $selectOption = $rowData[1];
    $column3 = $rowData[2];
    $column4 = $rowData[3];

    $sql = "INSERT INTO dm_contents (col1, col2, col3, col4) VALUES ('$column1', '$selectOption', '$column3', '$column4')";

    if ($connection->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error inserting data: " . $connection->error;
    }
}

$connection->close();
?>
