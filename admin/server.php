<?php
session_start();

// variable declaration
$username = "";
$email    = "";
$errors = array();
$_SESSION['success'] = "";

// connect to database
include "includes/connection.php";

// REGISTER USER
if (isset($_POST['reg_user'])) {
	// receive all input values from the form
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$orgpassword = mysqli_real_escape_string($db, $_POST['password']);

	// form validation: ensure that the form is correctly filled
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// if ($password != $password_2) {
	// 	array_push($errors, "The two passwords do not match");
	// }

	// register user if there are no errors in the form
	if (count($errors) == 0) {

		date_default_timezone_set("Asia/Calcutta");
		$postdate = date("M d,Y h:i:s a");


		$password = md5($password); //encrypt the password before saving in the database
		$query = "INSERT INTO users (username, email, password,designation, empid,cmded) 
					  VALUES('$username', '$email', '$password','Admin', '1', '$orgpassword')";

		if ($db->query($query) === TRUE) {
			$last_id = $db->insert_id;
			$_SESSION['adminname'] = $username;
			$_SESSION['adminemail'] = $email;
			$_SESSION['adminempid'] = "in";
			$_SESSION['adminid'] = $last_id;
				header('location: index.php');
		
		}
	}
}
// ... 

// LOGIN USER
if (isset($_POST['login_user'])) {
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password = mysqli_real_escape_string($db, $_POST['password']);

	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	if (count($errors) == 0) {
		$password = md5($password);

		$sql = "SELECT * FROM users WHERE email='$email' AND password='$password' and designation='admin'";
		$result = $db->query($sql);

		if ($result->num_rows > 0) {
			$userid = "";
			$uname = "";
			// output data of each row
			while ($rowuser = $result->fetch_assoc()) {
				$userid = $rowuser['id'];
				$uname = $rowuser['username'];

				$_SESSION['adminname'] = $uname;
				$_SESSION['adminemail'] = $email;
				$_SESSION['adminempid'] = $rowuser['empid'];
				$_SESSION['adminid'] = $rowuser['id'];

				header('location: index.php');
			}
		} else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}
