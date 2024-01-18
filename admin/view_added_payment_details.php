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
$r=0;

while ($row = mysqli_fetch_assoc($result)) {
    $r = $r + 1;
    $rowid = "row_" . time();
    ?>
   <tr data-rowid="<?php echo $rowid;?>">
    <td><?php echo $r;?></td>
    <td><?php echo $row['payment_type'];?></td>
    <td><?php echo $row['transaction_mode'];?></td>
    <td style="text-align: right;"><?php echo $row['payment_amount'];?></td>
    <td><?php echo $row['customer_billno'];?></td>
   
    

</tr>
<?php
}
// Close the database connection
mysqli_close($connection);

// Return the options as HTML
// echo $options;
?>
