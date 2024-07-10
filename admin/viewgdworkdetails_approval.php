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
$query = "SELECT * FROM staff_dm_graphics_allocation WHERE id = '$selectedworkId' and work_status='Active'";
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

    $deadline =$row['deadline'];
    $content =$row['content'];
    $originalDate = new DateTime($deadline);
    $formattedDate = $originalDate->format('d-m-Y');
    $redirectStat =  $row['redirect_status'];
    $assignedDate =$row['assigndate'];
    $originalDate = new DateTime($assignedDate);
    $assignedDatenew = $originalDate->format('d-m-Y');

    $post_assignstaffid = $row['assigned_staffid'];
    $post_redirectstaffid = $row['redirect_staffid'];
    $redirectStat =  $row['redirect_status'];

    $redirectstaff = "";
    $sqlemp = "SELECT * FROM employee where id='" . $row['redirect_staffid']  . "' and hod='No'";
    $resultemp = $connection->query($sqlemp);
    if ($resultemp->num_rows > 0) {
        while ($rowemp = $resultemp->fetch_assoc()) {
            $redirectstaff = $rowemp['empname'];
        }
    }

    $queryemp = "select * from employee where id='" .  $post_assignstaffid . "'";
    $select_postsemp = mysqli_query($connection, $queryemp);
    while ($rowemp = mysqli_fetch_assoc($select_postsemp)) {
        $post_empname = $rowemp['empname'];
    }

    if ($redirectStat == "Redirected") {

        
        $querywstatus1 = "select * from staff_dm_graphics_allocation where redirect_recordid='" .  $id . "'";
        $select_postswstatus1 = mysqli_query($connection, $querywstatus1);
        while ($rowwstatus1 = mysqli_fetch_assoc($select_postswstatus1)) {
            $checkid = $rowwstatus1['id'];
            $selectedOrderId = $rowwstatus1['id'];

            $querywstatus = "select * from staff_dm_graphics_allocation_details where staff_dm_allocation_id='" .  $checkid . "' order by id desc limit 1";
            $select_postswstatus = mysqli_query($connection, $querywstatus);
            while ($rowwstatus = mysqli_fetch_assoc($select_postswstatus)) {
                $post_wstatus = $rowwstatus['work_status'];
                $post_completed_date =  $rowwstatus['workdate'];
            }
        }
    } else {
        $selectedOrderId = $row['orderid'];
        $querywstatus = "select * from staff_dm_graphics_allocation_details where staff_dm_allocation_id='" .  $id . "' order by id desc limit 1";
        $select_postswstatus = mysqli_query($connection, $querywstatus);
        while ($rowwstatus = mysqli_fetch_assoc($select_postswstatus)) {
            $post_wstatus = $rowwstatus['work_status'];
            $post_completed_date =  $rowwstatus['workdate'];
        }
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
<tr><td>Brand Name</td><td>'.  $branname  .'</td></tr>
<tr><td>Work Details</td><td>'.  $work_assigned  .'</td></tr>
<tr><td>Assigned Date</td><td>'.  $assignedDatenew .'</td></tr>
<tr><td>Assigned By</td><td>'.  $post_empname .'</td></tr>
<tr><td>Content Given</td><td>'.  $content  .'</td></tr>
<tr><td>Deadline</td><td>'.  $formattedDate  .'</td></tr>
<tr><td>Deadline Status</td><td>'.  $post_deadline_status  .'</td></tr>
<tr><td>Redirected Staff</td><td>'.  $redirectstaff  .'</td></tr>
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