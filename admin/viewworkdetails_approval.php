<?php
// Include your database connection file or establish a connection here
// Include tde necessary database connection details
include "includes/connection.php";

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get tde selected order ID from tde AJAX request
$selectedworkId = $_POST['selectedOrderId'];
$selectedOrderId ="";
$post_empname="";
$query = "SELECT * FROM staff_allocation WHERE id = '$selectedworkId' and work_status='Active'";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $selectedOrderId = $row['orderid'];
    $custname= "";
    $post_brandName="" ;
// Query tde database based on tde selected order ID
$queryee = "SELECT * FROM order_customers WHERE id = '$selectedOrderId'";
$resultee = mysqli_query($connection, $queryee);
while ($rowee = mysqli_fetch_assoc($resultee)) {
    $custname= $rowee['custName'];
    $post_ordertype = $rowee['ordertype'];
    if ($post_ordertype == "Internal"){
        $post_brandName = $rowee['projectname'];
    } else {
    $post_brandName = $rowee['brandName'];
    }
   
}
    $deadline = $row['deadline'];
    $originalDate = new DateTime($deadline);
    $formattedDate = $originalDate->format('d-m-Y');
    $assignedDate =$row['assignedDate'];
    $originalDate = new DateTime($assignedDate);
    $assignedDatenew = $originalDate->format('d-m-Y');
    $work_assigned = $row['work_assigned'];

 


 
        $selectedOrderId = $row['orderid'];
        $querywstatus = "select * from staff_allocation_details where staff_allocation_id='" .  $id . "' order by id desc limit 1";
        $select_postswstatus = mysqli_query($connection, $querywstatus);
        while ($rowwstatus = mysqli_fetch_assoc($select_postswstatus)) {
            $post_wstatus = $rowwstatus['work_status'];
            $post_completed_date =  $rowwstatus['workdate'];
        }
    
    if ($post_completed_date <= $formattedDate) {
        $post_deadline_status = "On-time";
    } else {
        $post_deadline_status = "Overdue";
    }
}


$options = "";


$options .= '<h4>Posting Details</h4><hr><table class="table table-bordered mg-b-0" >

<tbody>
<tr><td style="width:150px">Customer Name</td><td>'.  $custname  .'</td></tr>
<tr><td>Brand Name</td><td>'.  $post_brandName  .'</td></tr>
<tr><td>Work Details</td><td>'.  $work_assigned  .'</td></tr>
<tr><td>Assigned Date</td><td>'.  $assignedDatenew .'</td></tr>
<tr><td>Deadline</td><td>'.  $formattedDate  .'</td></tr>
<tr><td>Deadline Status</td><td>'.  $post_deadline_status  .'</td></tr>

</tbody>
</table>';

$options .= '

<input type="hidden" value="' . $selectedworkId . '" id="allotid" name="allotid">
<input type="hidden" value="' . $selectedOrderId . '"  id="orderid" name="orderid">
<input type="hidden" value="' . $post_deadline_status . '"  id="deadlinestatus" name="deadlinestatus">';



   



// ======================================================

// Close tde database connection
mysqli_close($connection);

// Return tde options as HTML
echo $options;
?>


<script src="../assets/plugins/select2/js/select2.full.min.js"></script>
<script src="../assets/js/select2.js"></script>