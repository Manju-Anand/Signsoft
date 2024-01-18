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
$query = "SELECT * FROM staff_allocation WHERE orderid = '$selectedOrderId'";
$result = mysqli_query($connection, $query);
$r=0;

while ($row = mysqli_fetch_assoc($result)) {
    $r = $r + 1;
    $rowid = "row_" . time();
    ?>
   <tr data-rowid="<?php echo $rowid;?>">
    <td><?php echo $r;?></td>
    <td><?php echo $row['entryname'];?></td>
    <td><?php echo $row['empname'];?></td>
    <td><?php echo $row['work_assigned'];?></td>
    <td><?php echo $row['deadline'];?></td>
    <td><?php echo $row['per_of_work'];?></td>
    <td><?php echo $row['created'];?></td>
 

   
    

</tr>
<?php
}
// Close the database connection
mysqli_close($connection);

// Return the options as HTML
// echo $options;
?>
