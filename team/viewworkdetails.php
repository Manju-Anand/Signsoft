<?php
// Include your database connection file or establish a connection here
// Include the necessary database connection details
include "includes/connection.php";

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the selected order ID from the AJAX request
$selectedworkId = $_POST['selectedOrderId'];
$selectedOrderId ="";
$query = "SELECT * FROM staff_allocation WHERE id = '$selectedworkId' and work_status='Active'";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $selectedOrderId = $row['orderid'];
    $work_assigned =$row['work_assigned'];

    $deadline =$row['deadline'];
    $originalDate = new DateTime($deadline);
    $formattedDate = $originalDate->format('d-m-Y');

    $assignedDate =$row['assignedDate'];
    $originalDate = new DateTime($assignedDate);
    $assignedDatenew = $originalDate->format('d-m-Y');
}
$options = "";
// Query the database based on the selected order ID
$query = "SELECT * FROM order_customers WHERE id = '$selectedOrderId'";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $options .= '<div class="row"><div class="col-md-4">
    <label class="form-label" ><strong>Customer Name : </strong>' . $row['custName']  . '</label>

    <label class="form-label" ><strong>Brand Name : </strong>' . $row['brandName']  . '</label>
    <input type="hidden" value="' . $selectedworkId . '" id="allotid" name="allotid">
    <input type="hidden" value="' . $selectedOrderId . '"  id="orderid" name="orderid"></div>';
}
$options .= '<div class="col-md-4">
<label class="form-label" ><strong>Work Details : </strong>' . $work_assigned  . '</label>
<label class="form-label" ><strong>Assigned Date : </strong>' . $assignedDatenew . '</label>

</div><div class="col-md-4">
<label class="form-label" style="color:brown;font-size:20px;"><strong>Deadline : </strong>' . $formattedDate  . '</label>
</div> </div>';
   



// ======================================================

// Close the database connection
mysqli_close($connection);

// Return the options as HTML
echo $options;
?>


<script src="../assets/plugins/select2/js/select2.full.min.js"></script>
<script src="../assets/js/select2.js"></script>