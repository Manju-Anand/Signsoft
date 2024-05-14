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
$query = "SELECT * FROM staff_pjob_allocation WHERE id = '$selectedworkId' and status='Active'";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $selectedjobId = $row['jobid'];
  

    $assignedDate =$row['assigndate'];
    $originalDate = new DateTime($assignedDate);
    $assignedDatenew = $originalDate->format('d-m-Y');

    $deadlineDate =$row['deadline'];
    $dDate = new DateTime($deadlineDate);
    $assigneddeadline = $dDate->format('d-m-Y');
}
$options = "";
// Query the database based on the selected order ID
$query = "SELECT * FROM process_jobs WHERE id = '$selectedjobId'";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $jobname =$row['jobname'];
   
}
$options .= '<div class="col-md-4">
<label class="form-label" ><strong>Job Name : </strong>' . $jobname  . '</label>
<label class="form-label" ><strong>Assigned Date : </strong>' . $assignedDatenew . '</label>
<label class="form-label" ><strong>Deadline : </strong>' . $assigneddeadline . '</label>
<input type="hidden" value="' . $selectedworkId . '" id="allotid" name="allotid">
</div></div>';
   



// ======================================================

// Close the database connection
mysqli_close($connection);

// Return the options as HTML
echo $options;
?>


<script src="../assets/plugins/select2/js/select2.full.min.js"></script>
<script src="../assets/js/select2.js"></script>