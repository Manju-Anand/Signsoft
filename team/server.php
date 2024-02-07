<?php
session_start();

// variable declaration
$username = "";
$email    = "";
$errors = array();
$_SESSION['success'] = "";

// connect to database
include "includes/connection.php";


// LOGIN USER
if (isset($_POST['login_user'])) {
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$deptid = mysqli_real_escape_string($db, $_POST['dept']);
	$desigid = mysqli_real_escape_string($db, $_POST['desig']);

	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	if (count($errors) == 0) {
		$password = md5($password);

// *********************** checking whether the employee belongs to sales department *************************
		// $sqldept = "SELECT * FROM department WHERE dname='Sales'";
		// $resultdept = $db->query($sqldept);
		// if ($resultdept->num_rows > 0) {
		// 	while ($rowuserdept = $resultdept->fetch_assoc()) {
		// 		$modulename=$rowuserdept['dname'];
		// 		$deptid = $rowuserdept['id'];
		// 		$_SESSION['deptid'] = $deptid;
		// 		$_SESSION['modulename'] = $modulename;
		// 		$sql = "SELECT * FROM employee_user WHERE email='$email' AND password='$password' and department='$deptid' ";
		// 		$result = $db->query($sql);

		// 		if ($result->num_rows > 0) {
		// 			$userid = "";
		// 			$uname = "";
		// 			while ($rowuser = $result->fetch_assoc()) {
		// 				$userid = $rowuser['id'];
		// 				$uname = $rowuser['username'];

		// 				$_SESSION['empname'] = $uname;
		// 				$_SESSION['empemail'] = $email;
		// 				$_SESSION['empempid'] = $rowuser['empid'];
		// 				$_SESSION['empid'] = $rowuser['id'];

		// 				header('location: index.php');
		// 			}
		// 		} else {
		// 			array_push($errors, "Wrong username/password combination");
		// 		}
		// 	}
		// }
// ===========================================================
$sqldept = "SELECT * FROM department WHERE id='". $deptid ."'";
$resultdept = $db->query($sqldept);
if ($resultdept->num_rows > 0) {
	while ($rowuserdept = $resultdept->fetch_assoc()) {
		echo "dept";
		$modulename=$rowuserdept['dname'];
		$deptid = $rowuserdept['id'];
		$_SESSION['deptid'] = $deptid;
		$_SESSION['modulename'] = $modulename;
		$sql = "SELECT * FROM employee_user WHERE email='$email' AND password='$password' and department='$deptid' ";
		$result = $db->query($sql);

		if ($result->num_rows > 0) {
			$userid = "";
			$uname = "";
			while ($rowuser = $result->fetch_assoc()) {
				echo "emp";
				$userid = $rowuser['id'];
				$uname = $rowuser['username'];

				$_SESSION['empname'] = $uname;
				$_SESSION['empemail'] = $email;
				$_SESSION['empid'] = $rowuser['empid'];
		

				header('location: index.php');
			}
		} else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}


	}
}
