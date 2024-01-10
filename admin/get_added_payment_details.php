<?php
// Include your database connection file or establish a connection here
// Include the necessary database connection details
include "includes/connection.php";

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the selected order ID from the AJAX request
$selectedOrderId = $_POST['selectedOrderId'];

// Query the database based on the selected order ID
$query = "SELECT * FROM payment_customer WHERE orderid = '$selectedOrderId'";
$result = mysqli_query($connection, $query);

// Build the options for the second select
$options = '<option value="" disabled selected>Select Option</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $querycat = "select * from category where id ='" . $row['category_id'] . "'";
    $select_postscat  = mysqli_query($connection, $querycat );
    while ($rowcat = mysqli_fetch_assoc($select_postscat)) {
    $options .= '<option value="' . $rowcat['id'] . '">' . $rowcat['category'] . '</option>';
}

}
// Close the database connection
mysqli_close($connection);

// Return the options as HTML
echo $options;
?>
