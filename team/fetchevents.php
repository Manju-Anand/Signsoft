<?php 
session_start();
include "includes/connection.php";
$sql = "SELECT * FROM dmevents where empid='" . $_SESSION['empid'] . "'";
$eventsList = mysqli_query($connection,$sql);
	
$response = array();
while($row = mysqli_fetch_assoc($eventsList)){
	$response[] = array(
		"eventid" => $row['id'],
		"title" => $row['title'],
		"description" => $row['description'],
		"start" => $row['start_date'],
		"end" => $row['end_date'],
		"orderid" => $row['orderid'],
		"empid" => $row['empid'],
	);
}

echo json_encode($response);
exit;