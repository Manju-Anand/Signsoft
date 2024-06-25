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
$query = "SELECT * FROM staff_dm_graphics_allocation WHERE orderid = '$selectedOrderId' and assigned_staffid='" . $_SESSION['empid'] ."' and work_status='Active' order by id DESC";
$result = mysqli_query($connection, $query);
$r=0;

while ($row = mysqli_fetch_assoc($result)) {
    $_SESSION['dmsaveddata'] = "SavedData";
    echo  $_SESSION['dmsaveddata'];
    $r = $r + 1;
    $rowid = "row_" . mt_rand(20000, 200000) . "_" . time();

    // $input_content = str_replace(array("\r", "\n"), '', $row['content']);

    // For displaying in a non-input field (like a div or p tag), convert newlines to <br> tags
    $display_content = nl2br(htmlspecialchars($row['content']));


    ?>
   <tr data-rowid="<?php echo $rowid;?>">
    <td><?php echo $r;?></td>
    <td  class="wd-10p"><?php echo $row['assigndate'];?></td>
    <td><?php 
    echo $row['postings'];
    ?></td>
    <td><?php 
    echo $display_content;
    ?></td>


    <td><?php echo $row['posteridea'];?></td>
    <td class="wd-10p"><?php echo $row['deadline'];?></td>
    <td class="wd-9p">
      
    <a class='btn btn-sm btn-primary edit-staff-btn'   title='Edit' style='color:white'>
    <span class='fe fe-edit'> </span></a>&nbsp;
    <!-- <a class='btn btn-sm btn-primary  edit-staff-btn'  data-bs-target='#staffmodal' data-bs-toggle='modal' title='Edit' style='color:white'>
        <span class='fe fe-edit'> </span></a>&nbsp; href='edit-Graphics-content.php?edit=<?php echo $row['id'] ?>'-->
        <a class='btn btn-sm btn-danger delete-staff-btn' id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'> 
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

