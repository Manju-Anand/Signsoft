<?php
// your_server_script.php

// Retrieve the data from the POST request
$tableData = json_decode($_POST['tableData'], true);
$quoteId = $_POST['quoteId'];
date_default_timezone_set("Asia/Calcutta");
$postdate = date("M d,Y h:i:s a");
// Now you can process the data as needed, for example, save it to the database
// You should adapt the following code based on your actual database and requirements
include "includes/connection.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

foreach ($tableData as $rowData) {
if ($rowData['price'] !== ""){
    $sql = "INSERT INTO quote_splitup (orderid, itemid, itemname, price,created,modified) VALUES ('$quoteId', '{$rowData['itemId']}', '{$rowData['itemName']}', '{$rowData['price']}','$postdate','$postdate')";

    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
}


$conn->close();
?>
