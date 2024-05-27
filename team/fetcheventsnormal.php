<?php 

session_start();
include "includes/connection.php";
$sql = "SELECT * FROM nomevents where empid='" . $_SESSION['empid'] . "'";
$eventsList = mysqli_query($connection,$sql);
	
$responsenormal = array();
while($row = mysqli_fetch_assoc($eventsList)){
	$responsenormal[] = array(
		"eventid" => $row['id'],
		"title" => $row['title'],
		"description" => $row['description'],
		"start" => $row['start_date'],
		"end" => $row['end_date'],
	);
}

echo json_encode($responsenormal);
exit;