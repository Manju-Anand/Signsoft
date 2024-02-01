
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
$query = "SELECT * FROM payment_supplier WHERE orderid = '$selectedOrderId'";
$result = mysqli_query($connection, $query);
$r=0;

while ($row = mysqli_fetch_assoc($result)) {
    $r = $r + 1;
    $rowid = "row_" . mt_rand(20000, 200000) . "_" . time();
    ?>
   <tr data-rowid="<?php echo $rowid;?>">
    <td><?php echo $r;?></td>
    <td><?php echo $row['categoryName'];?></td>
    <td class="hidden-cell"><?php echo $row['category_id'];?></td>
    <td><?php echo $row['supplierName'];?></td>
    <td class="hidden-cell"><?php echo $row['supplier_id'];?></td>
    <td><?php echo $row['work_description'];?></td>
    <td><?php echo $row['supplier_billno'];?></td>
    <td style="text-align: right;"><?php echo $row['payment_amount'];?></td>
    <td><?php echo $row['transaction_mode'];?></td>
    <td><?php echo $row['customer_billno'];?></td>
    <td><?php echo $row['payDate'];?></td>
    <td><a class='btn btn-sm btn-primary  edit-btn'  data-bs-target='#suppliermodal' data-bs-toggle='modal' title='Edit' style='color:white'>
        <span class='fe fe-edit'> </span></a>&nbsp;&nbsp;
        <a class='btn btn-sm btn-danger delete-btn'  id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'> 
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
