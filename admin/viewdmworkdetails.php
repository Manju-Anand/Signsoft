<?php
// Include your database connection file or establish a connection here
// Include tde necessary database connection details
include "includes/connection.php";

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
$options = "";
// Get tde selected order ID from tde AJAX request
$selectedworkId = $_POST['selectedOrderId'];
$selectedOrderId ="";
$post_empname="";
$post_completed_date ="";
$query = "SELECT * FROM staff_dm_allocation WHERE orderid = '$selectedworkId' and work_status='Active'";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $selectedOrderId = $row['orderid'];
    $custname= "";
    $branname="" ;

// Query tde database based on tde selected order ID
$queryee = "SELECT * FROM order_customers WHERE id = '$selectedOrderId'";
$resultee = mysqli_query($connection, $queryee);
while ($rowee = mysqli_fetch_assoc($resultee)) {
    $custname= $rowee['custName'];
    $branname=$rowee['brandName'] ;
   
}
    $work_assigned =$row['postings'];

    $staffname =$row['staffname'];
    $startdate =$row['startdate'];
    $originalDate = new DateTime($startdate);
    $formattedStartDate = $originalDate->format('d-m-Y');
    $enddate =$row['enddate'];
    $originalDate = new DateTime($enddate);
    $formattedEndDate = $originalDate->format('d-m-Y');
    $promoamt =$row['promoamt'];
    $frequency =$row['frequency'];
    $assigndate =$row['assigndate'];
    $originalDate = new DateTime($assigndate);
    $formattedAssignDate = $originalDate->format('d-m-Y');




$options = "";


$options .= '<h4>Posting Details</h4><hr><table class="table table-bordered mg-b-0" >

<tbody>
<tr><td style="width:150px">Customer Name</td><td>'.  $custname  .'</td></tr>
<tr><td>Brand Name</td><td>'.  $branname  .'</td></tr>
<tr><td>Work Details</td><td>'.  $work_assigned  .'</td></tr>
<tr><td>Assigned Date</td><td>'.  $formattedAssignDate .'</td></tr>
<tr><td>Assigned To</td><td>'.  $staffname .'</td></tr>
<tr><td>Start Date</td><td>'.  $formattedStartDate  .'</td></tr>
<tr><td>End Date</td><td>'.  $formattedEndDate  .'</td></tr>
<tr><td>Promotion Amount</td><td>'.  $promoamt  .'</td></tr>
<tr><td>Frequency</td><td>'.  $frequency  .'</td></tr>
</tbody>
</table>';

$options .= '

<input type="hidden" value="' . $selectedworkId . '" id="allotid" name="allotid">
<input type="hidden" value="' . $selectedOrderId . '"  id="orderid" name="orderid">
';



   

}

// ======================================================

// Close tde database connection
mysqli_close($connection);

// Return tde options as HTML
echo $options;
?>


<script src="../assets/plugins/select2/js/select2.full.min.js"></script>
<script src="../assets/js/select2.js"></script>