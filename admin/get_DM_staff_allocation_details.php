<?php
session_start();
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
$query = "SELECT * FROM staff_dm_allocation WHERE orderid = '$selectedOrderId'";
$result = mysqli_query($connection, $query);
$r=0;

while ($row = mysqli_fetch_assoc($result)) {
    $_SESSION['dmsaveddata'] = "SavedData";
    echo  $_SESSION['dmsaveddata'];
    $r = $r + 1;
    $rowid = "row_" . mt_rand(20000, 200000) . "_" . time();
    ?>
   <tr data-rowid="<?php echo $rowid;?>" data-id="<?php echo $row['id'];?>">
    <td><?php echo $r;?></td>
    <td><?php echo $row['payment'];?></td>
    <td><?php echo $row['postings'];?></td>
    <td><?php echo $row['staffname'];?></td>
    <td class="hidden-cell"><?php echo $row['staffid'];?></td>
    <td><?php echo $row['frequency'];?></td>
    <td><?php echo $row['startdate'];?></td>
    <td><?php echo $row['enddate'];?></td>
    <td><?php echo $row['promoamt'];?></td>
    <td><?php echo $row['assigndate'];?></td>
    <td><a class='btn btn-sm btn-primary  edit-staff-btn'  data-bs-target='#staffmodal' data-bs-toggle='modal' title='Edit' style='color:white'>
        <span class='fe fe-edit'> </span></a>&nbsp;&nbsp;
        <a class='btn btn-sm btn-danger delete-staff-btn'  id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'> 
        <span class='fe fe-trash-2'> </span></a></td>
        <!-- class="hidden-cell" -->
        <td class="hidden-cell">Saved</td>
        <td class="hidden-cell"><?php echo $row['id'];?></td>

</tr>
<?php
}
// Close the database connection
mysqli_close($connection);

// Return the options as HTML
// echo $options;
?>
