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
$query = "SELECT * FROM dm_workdetails WHERE orderid = '$selectedOrderId'";
$result = mysqli_query($connection, $query);
$r=0;

while ($row = mysqli_fetch_assoc($result)) {

    $r = $r + 1;

    ?>
   <tr>
    <td><?php echo $r;?></td>
    <td><?php echo $row['channel'];?></td>
    <td><?php echo $row['upload_content_type'];?></td>
    <td><?php echo $row['upload_date'];?></td>

    <td><?php if ($row['campaign'] == '1' ){ echo "Yes" ;} else { echo "No"; }?></td>
    <td><?php echo $row['campaign_name'];?></td>
    <td><?php echo $row['budget'];?></td>
    <td><?php echo $row['start_date'];?></td>
    <td><?php echo $row['end_date'];?></td>    
    <td><?php echo $row['remarks'];?></td>
    <td><?php echo $row['intrim1_date'];?></td>
    <td><?php echo $row['intrim2_date'];?></td>  
    <td><?php echo $row['result'];?></td>  
   
      

</tr>
<?php
}
// Close the database connection
mysqli_close($connection);

// Return the options as HTML
// echo $options;
?>
