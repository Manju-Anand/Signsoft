<?php
header('Content-Type: application/json');

$workid = $_GET["workid"];

function timeToDecimal($time)
{
    list($hours, $minutes) = explode(':', $time);
    return $hours + ($minutes / 60);
}

$post_timetaken = 0;
$editstatus = "New";
$editid = "";
$internal = "";
$external = "";
$percompletion = "";

include "includes/connection.php";

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$query = "SELECT * FROM staff_dm_graphics_allocation WHERE id = '$workid' and work_status='Active'";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $redirectStat =  $row['redirect_status'];
    
    if ($redirectStat == "Redirected") {
        $querywstatus1 = "select * from staff_dm_graphics_allocation where redirect_recordid='" .  $workid . "'";
        $select_postswstatus1 = mysqli_query($connection, $querywstatus1);
        while ($rowwstatus1 = mysqli_fetch_assoc($select_postswstatus1)) {
            $checkid = $rowwstatus1['id'];
            $orgwokid =  $rowwstatus1['id'];

            $querywstatus = "select * from staff_dm_graphics_allocation_details where staff_dm_allocation_id='" .  $checkid . "' order by id desc";
            $select_postswstatus = mysqli_query($connection, $querywstatus);
            while ($rowwstatus = mysqli_fetch_assoc($select_postswstatus)) {
                $post_timetaken += timeToDecimal($rowwstatus['timetaken']);
            }
        }

        $sql1 = "SELECT * FROM gd_work_approval where workid ='" . $checkid . "'";
        $result1 = $connection->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row2 = $result1->fetch_assoc()) {
                $editstatus = "Edit";
                $editid = $row2['id'];
                $internal = $row2['no_internal_edits']; 
                $external = $row2['no_external_edits']; 
                $percompletion = $row2['percentage_completion']; 
            }
        }
    } else {
        $orgwokid = $workid;
        $querywstatus = "select * from staff_dm_graphics_allocation_details where staff_dm_allocation_id='" .  $workid . "' order by id desc";
        $select_postswstatus = mysqli_query($connection, $querywstatus);
        while ($rowwstatus = mysqli_fetch_assoc($select_postswstatus)) {
            $post_timetaken += timeToDecimal($rowwstatus['timetaken']);
        }

        $sql1 = "SELECT * FROM gd_work_approval where workid ='" . $workid . "'";
        $result1 = $connection->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row2 = $result1->fetch_assoc()) {
                $editstatus = "Edit";
                $editid = $row2['id'];
                $internal = $row2['no_internal_edits']; 
                $external = $row2['no_external_edits']; 
                $percompletion = $row2['percentage_completion']; 
            }
        }
    }
}

$response = [
    'post_timetaken' => $post_timetaken,
    'editstatus' => $editstatus,
    'editid' => $editid,
    'internal' => $internal,
    'external' => $external,
    'percompletion' => $percompletion,
    'orgwokid' => $orgwokid,
];

echo json_encode($response);
$connection->close();
?>
