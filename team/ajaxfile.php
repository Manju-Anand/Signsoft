<?php 
session_start();
include "includes/connection.php";

$request = "";

// Read $_GET value
if(isset($_POST['request'])){
	$request = $_POST['request'];
}

// Add New event 
if($request == 'addEvent'){

	// POST data
	$title = ""; 
	$description = ""; 
	$start_date = "";
	 $end_date = "";
	 $orderid = "";
	if(isset($_POST['title'])){
		$title = $_POST['title'];
	}
	if(isset($_POST['description'])){
		$description = $_POST['description'];
	}
	if(isset($_POST['start_date'])){
		$start_date = $_POST['start_date'];
	}
	if(isset($_POST['start_date'])){
		$end_date = $_POST['end_date'];
	}
	if(isset($_POST['orderid'])){
		$orderid  = $_POST['orderid'];
	}
	if(isset($_POST['dmallotid'])){
		$dmallotid  = $_POST['dmallotid'];
	}
	if(isset($_POST['paidornot'])){
		$paidornot  = $_POST['paidornot'];
	}
	$response = array();
	$status = 0;
	if(!empty($title) && !empty($description) && !empty($start_date) && !empty($end_date) ){

		// Insert record
		$sql = "INSERT INTO dmevents(title,description,start_date,end_date,orderid,empid,dm_allotid,paidpromo) VALUES(
			'".$title."','".$description."','".$start_date."','".$end_date."','".$orderid."','" . $_SESSION['empid'] . "','" . $dmallotid . "','" . $paidornot . "')";
			
		if(mysqli_query($connection,$sql)){
			$eventid = mysqli_insert_id($connection);

			$status = 1;

			$response['eventid'] = $eventid;
			$response['status'] = 1;
			$response['message'] = 'Work created successfully.';
		}
	}	

	if($status == 0){
		$response['status'] = 0;
		$response['message'] = 'Work not created.';
	}
	
	echo json_encode($response);
	exit;
}

// Move event
if($request == 'moveEvent'){

	// POST data
	$eventid = 0; 
	$start_date = ""; $end_date = "";

	if(isset($_POST['eventid']) && is_numeric($_POST['eventid'])){
		$eventid = $_POST['eventid'];
	}
	if(isset($_POST['start_date'])){
		$start_date = $_POST['start_date'];
	}
	if(isset($_POST['end_date'])){
		$end_date = $_POST['end_date'];
	}
	
	$response = array();
	$status = 0;

	if($eventid > 0 && !empty($start_date) && !empty($end_date) ){

		// Check event id
		$sql = "SELECT id FROM dmevents WHERE id=".$eventid;
		$result = mysqli_query($connection,$sql);
		if(mysqli_num_rows($result)){
			// Update record
			$sql = "UPDATE dmevents SET start_date='".$start_date."',end_date='".$end_date."' WHERE id=".$eventid;
			if(mysqli_query($connection,$sql)){
				$status = 1;

				$response['status'] = 1;
				$response['message'] = 'Event date updated successfully.';
			}
		}
		
	}

	if($status == 0){
		$response['status'] = 0;
		$response['message'] = 'Work date not updated.';
	}	

	echo json_encode($response);
	exit;
}

// Update event
if($request == 'editEvent'){

	// POST data
	$eventid = 0;
	if(isset($_POST['eventid']) && is_numeric($_POST['eventid'])){
		$eventid = $_POST['eventid'];
	}
	if(isset($_POST['title'])){
		$title = $_POST['title'];
	}
	if(isset($_POST['description'])){
		$description = $_POST['description'];
	}
	if(isset($_POST['beforeinfo'])){
		$beforeinfo = $_POST['beforeinfo'];
	}
	if(isset($_POST['executed'])){
		$executed = $_POST['executed'];
	}
	if(isset($_POST['afterinfo'])){
		$afterinfo = $_POST['afterinfo'];
	}

	$response = array();

	if($eventid > 0 && !empty($title) && !empty($description)){

		// Check event id
		$sql = "SELECT id FROM dmevents WHERE id=".$eventid;
		$result = mysqli_query($connection,$sql);
		if(mysqli_num_rows($result)){

			// Update record
			$sql = "UPDATE dmevents SET title='".$title."', description='".$description."',afterinfo='".$afterinfo."',
			beforeinfo='".$beforeinfo."', executed='".$executed."' WHERE id=".$eventid;
			if(mysqli_query($connection,$sql)){

				$status = 1; 

				$response['status'] = 1;
				$response['message'] = 'Work updated successfully.';
			}
		}
		
	}

	if($status == 0){
		$response['status'] = 0;
		$response['message'] = 'Work not updated.';
	}

	echo json_encode($response);
	exit;
}

// Delete Event
if($request == 'deleteEvent'){

	// POST data
	$eventid = 0;
	if(isset($_POST['eventid']) && is_numeric($_POST['eventid'])){
		$eventid = $_POST['eventid'];
	}

	$response = array();
	$status = 0;

	if($eventid > 0){

		// Check event id
		$sql = "SELECT id FROM dmevents WHERE id=".$eventid;
		$result = mysqli_query($connection,$sql);
		if(mysqli_num_rows($result)){

			// Delete record
			$sql = "DELETE FROM dmevents WHERE id=".$eventid;
			if(mysqli_query($connection,$sql)){
				$status = 1;

				$response['status'] = 1;
				$response['message'] = 'Work deleted successfully.';
			}
		}
		
	}
	
	if($status == 0){
		$response['status'] = 0;
		$response['message'] = 'Work not deleted.';
	}

	echo json_encode($response);
	exit;
}