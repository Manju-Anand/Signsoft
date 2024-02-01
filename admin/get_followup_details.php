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
$query = "SELECT * FROM order_followup WHERE order_id = '$selectedOrderId'";
$result = mysqli_query($connection, $query);
$r=0;

while ($row = mysqli_fetch_assoc($result)) {
    $r = $r + 1;
    $rowid = "row_" . mt_rand(20000, 200000) . "_" . time();
    ?>
   <tr data-rowid="<?php echo $rowid;?>">
    <td><?php echo $r;?></td>
    <td><?php echo $row['orderDate'];?></td>
    <td><?php echo $row['mode_of_contact'];?></td>
    <td><?php echo $row['remarks'];?></td>

    <td><a class='btn btn-sm btn-primary edit-follow-btn'  data-bs-target='#followupmodal' data-bs-toggle='modal' title='Edit' style='color:white'>
        <span class='fe fe-edit'> </span></a>&nbsp;&nbsp;
        <a class='btn btn-sm btn-danger delete-follow-btn'  id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'> 
        <span class='fe fe-trash-2'> </span></a></td>
    
        <td class="hidden-cell">Saved</td>
</tr>
<?php
}
// Close the database connection
mysqli_close($connection);

// Return the options as HTML
// echo $options;
?>
