<?php
session_start();

if (!isset($_SESSION['adminname'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: signin.php');
}

if (isset($_GET['logout'])) {

	unset($_SESSION['adminname']);
	session_destroy();
	header("location: signin.php");
}

include "includes/connection.php";
$adminname = isset($_SESSION['adminname']) ? $_SESSION['adminname'] : '';
$totemployees = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="">

	<!-- Favicon -->
	<link rel="icon" href="../assets/img/favicon.png" type="image/x-icon">

	<!-- Title -->
	<title>Signsoft - Empowering Efficiency, Unleashing Possibilities</title>

	<!--- bootstrap css -->
	<link id="style" href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!--- FONT-ICONS CSS -->
	<link href="../assets/css/icons.css" rel="stylesheet">

	<!--- Style css -->
	<link href="../assets/css/style.css" rel="stylesheet">

	<!--- Plugins css -->
	<link href="../assets/css/plugins.css" rel="stylesheet">

	<!-- Switcher css -->
	<link href="../assets/switcher/css/switcher.css" rel="stylesheet">
	<link href="../assets/switcher/demo.css" rel="stylesheet">

</head>

<body class="app sidebar-mini">


	<!-- Loader -->
	<div id="global-loader">
		<img src="../assets/img/loader.svg" class="loader-img" alt="Loader">
	</div>
	<!-- End Loader -->

	<!-- Page -->
	<div class="page">
		<div>
			<?php include 'includes/header.php'; ?>
		</div>
		<!-- Main Content-->
		<div class="main-content side-content pt-0">
			<div class="side-app">
				<div class="main-container container-fluid">
					<!-- Page Header -->
					<div class="page-header">
						<div>
							<h2 class="main-content-title tx-24 mg-b-5">Welcome To Dashboard</h2>

							<?php
							//  echo "id : " . $_SESSION['adminid'] . ' , ' . $_SESSION['adminname'];
							?>

							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
							</ol>
						</div>
						<div class="d-flex">
							<div class="me-2">
								<a class="btn ripple btn-primary dropdown-toggle mb-0" href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<i class="fe fe-external-link"></i> Export <i class="fa fa-caret-down ms-1"></i>
								</a>
								<!-- <div class="dropdown-menu tx-13">
									<a class="dropdown-item" href="javascript:void(0);"><i
											class="fa fa-file-pdf-o me-2"></i>Export as
										Pdf</a>
									<a class="dropdown-item" href="javascript:void(0);"><i
											class="fa fa-image me-2"></i>Export as
										Image</a>
									<a class="dropdown-item" href="javascript:void(0);"><i
											class="fa fa-file-excel-o me-2"></i>Export as
										Excel</a>
								</div> -->
							</div>
							<div>
								<!-- <a href="javascript:void(0);"
									class="btn ripple btn-secondary navresponsive-toggler mb-0"
									data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
									aria-controls="navbarSupportedContent" aria-expanded="false"
									aria-label="Toggle navigation">
									<i class="fe fe-filter me-1"></i> Filter <i class="fa fa-caret-down ms-1"></i>
								</a> -->
							</div>
						</div>
					</div>
					<!-- End Page Header -->
					 <?php
					// if ($adminname  == 'Signefo') {
					// 	} else if ($adminname  == 'SignefoMedia') {
					// 	} else {
						if (in_array($adminname, ['Signefo', 'SignefoMedia'])) {
							// Your code here for both 'Signefo' and 'SignefoMedia'
						} else {					
				?>

					<!-- Row -->
					<div class="row row-sm">
						<div class="col-sm-6 col-xl-3 col-lg-6">
							<div class="card custom-card">
								<div class="card-body dash1">
									<div class="d-flex">
										<p class="mb-1 tx-inverse">Number Of Sales</p>
										<div class="ms-auto">
											<i class="fa fa-line-chart fs-20 text-primary"></i>
										</div>
									</div>
									<div>
										<h3 class="dash-25">$568</h3>
									</div>
									<div class="progress mb-1">
										<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar progress-bar-xs wd-70p" role="progressbar"></div>
									</div>
									<div class="expansion-label d-flex">
										<span class="text-muted">Last Month</span>
										<span class="ms-auto"><i class="fa fa-caret-up me-1 text-success"></i>0.7%</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-xl-3 col-lg-6">
							<div class="card custom-card">
								<div class="card-body dash1">
									<div class="d-flex">
										<p class="mb-1 tx-inverse">New Revenue</p>
										<div class="ms-auto">
											<i class="fa fa-money fs-20 text-secondary"></i>
										</div>
									</div>
									<div>
										<h3 class="dash-25">$12,897</h3>
									</div>
									<div class="progress mb-1">
										<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar progress-bar-xs wd-60p bg-secondary" role="progressbar">
										</div>
									</div>
									<div class="expansion-label d-flex">
										<span class="text-muted">Last Month</span>
										<span class="ms-auto"><i class="fa fa-caret-down me-1 text-danger"></i>0.43%</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-xl-3 col-lg-6">
							<div class="card custom-card">
								<div class="card-body dash1">
									<div class="d-flex">
										<p class="mb-1 tx-inverse">Total Cost</p>
										<div class="ms-auto">
											<i class="fa fa-usd fs-20 text-success"></i>
										</div>
									</div>
									<div>
										<h3 class="dash-25">$11,234</h3>
									</div>
									<div class="progress mb-1">
										<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar progress-bar-xs wd-50p bg-success" role="progressbar">
										</div>
									</div>
									<div class="expansion-label d-flex text-muted">
										<span class="text-muted">Last Month</span>
										<span class="ms-auto"><i class="fa fa-caret-down me-1 text-danger"></i>1.44%</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-xl-3 col-lg-6">
							<?php
							$sql = "SELECT * FROM employee";
							$result = $connection->query($sql);

							if ($result->num_rows > 0) {
								$totemployees = $result->num_rows;
							}
							?>
							<div class="card custom-card">
								<div class="card-body dash1">
									<div class="d-flex">
										<p class="mb-1 tx-inverse">Total Employees</p>
										<div class="ms-auto">
											<i class="fa fa-signal fs-20 text-info"></i>
										</div>
									</div>
									<div>
										<h3 class="dash-25"><?php echo $totemployees; ?> </h3>
									</div>
									<div class="progress mb-1">
										<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar progress-bar-xs wd-40p bg-info" role="progressbar">
										</div>
									</div>
									<div class="expansion-label d-flex text-muted">
										<a href="employeelist.php"><span class="text-muted">Employees List</span></a>
										<!-- <span class="ms-auto"><i
												class="fa fa-caret-up me-1 text-success"></i>0.9%</span> -->
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--End  Row -->

					
					<div class="card custom-card" id="solid-alert">
						<div class="card-body">
							<div>
								<h6 class="card-title">GST Alerts</h6>

							</div>
							<div class="text-wrap">
								<div class="example">
									<?php
									// Function to check if a date is between 1 to 10 of any month
									function isDateBetween1To10($date)
									{
										// Convert the date string to a DateTime object
										$dateTime = new DateTime($date);

										// Extract the day of the month
										$dayOfMonth = (int)$dateTime->format('d');

										// Check if the day of the month is between 1 to 10
										return ($dayOfMonth >= 1 && $dayOfMonth <= 10);
									}
									// Function to check if a date is between 1 to 10 of any month
									function isDateBetween11To17($date)
									{
										// Convert the date string to a DateTime object
										$dateTime = new DateTime($date);

										// Extract the day of the month
										$dayOfMonth = (int)$dateTime->format('d');

										// Check if the day of the month is between 1 to 10
										return ($dayOfMonth >= 11 && $dayOfMonth <= 17);
									}

									// Get the current date
									$currentDate = date('Y-m-d');
									if (isDateBetween1To10($currentDate)) {
										// echo "$currentDate is between 1 to 10 of the month.";

									?>
										<div class="alert alert-solid-warning" role="alert">
											<button aria-label="Close" class="btn-close float-end" data-bs-dismiss="alert" type="button">
												<span aria-hidden="true">&times;</span></button>
											<strong>Warning!</strong> Month Beginning! Check Gst Amount to be paid.
										</div>
										<?php }

									if (isDateBetween11To17($currentDate)) {
										$currentMonth = date('m', strtotime($currentDate)); // Month in numeric format (01-12)
										$currentYear = date('Y', strtotime($currentDate)); // Year in four-digit format

										$query = "SELECT * FROM gstamt WHERE MONTH(paiddate) = '$currentMonth' AND YEAR(paiddate) = '$currentYear'";
										$result = mysqli_query($connection, $query);
										if (mysqli_num_rows($result) > 0) {
										?>
											<div class="alert alert-solid-danger mg-b-0" role="alert">
												<button aria-label="Close" class="btn-close float-end" data-bs-dismiss="alert" type="button">
													<span aria-hidden="true">&times;</span></button>
												<strong>Oh snap!</strong> Pay The GST amount for this month!.....
											</div>
									<?php }
									} ?>
								</div>
							</div>
						</div>
					</div>
					<!-- Row -->
					<div class="row row-sm">
						
						<div class="col-sm-12 col-lg-12  col-xl-4">


							<div class="card custom-card pb-2">
								<div class="card-body">
									<div>
										<h6 class="card-title mb-1">Renewal Customers List</h6>
										<p class="text-muted mb-0 card-sub-title">Please renew these DM Clients.</p>
									</div>
								</div>
								<div class="user-manager scroll-widget border-top">
									<div>
										<?php
										
										$enddate = "";
										$brandname = "";
										$custname  ="";
										$monthlyreport="";
										$reportmonth="";
										$reportyear="";
										$sname="";
										$totalclients = 0;
										$reportvariable ="Monthly Report Not Submitted";
										
										
										$queryorder = "select * from order_customers where order_status='Active' order by id desc";
										$select_postsorder = mysqli_query($connection, $queryorder);
										while ($roworder = mysqli_fetch_assoc($select_postsorder)) {

											$mainorderid = $roworder['id'];
											$dmorder = "false";
											$brandname = $roworder['brandName'];
											$custname = $roworder['custName'];

											$querydigital = "select * from category where dept_id=(select id from department where dname='Digital')";
											$select_postsdigital = mysqli_query($connection, $querydigital);
											while ($rowdigital = mysqli_fetch_assoc($select_postsdigital)) {
												$catId = $rowdigital['id'];



												$queryordercat = "select * from order_category where order_id='" . $roworder['id'] . "' and category_id='" . $catId . "'";
												$select_postsordercat = mysqli_query($connection, $queryordercat);
												while ($rowordercat = mysqli_fetch_assoc($select_postsordercat)) {
													$categoryId = $rowordercat['category_id'];
													$querydmallot = "select * from staff_dm_allocation where orderid='" . $roworder['id'] . "'";
													$select_postsdmallot = mysqli_query($connection, $querydmallot);
													while ($rowdmallot = mysqli_fetch_assoc($select_postsdmallot)) {
														$dmorder = "true";
													}
												}
											}

											if ($dmorder == "true") {
												$totalclients++;
												$querydmallocation = "select * from staff_dm_allocation where orderid='" . $mainorderid  . "' order by id DESC limit 1";
												$select_postsdmallocation = mysqli_query($connection, $querydmallocation);
												while ($rowdmallocation = mysqli_fetch_assoc($select_postsdmallocation)) {
													$enddate = $rowdmallocation['enddate'];
													$sname=$rowdmallocation['staffname'];

												}
												$querydmmonth = "select * from dm_monthlyreport where orderid='" . $mainorderid  . "' order by id DESC limit 1";
												$select_postsdmmonth = mysqli_query($connection, $querydmmonth);
												while ($rowdmmonth = mysqli_fetch_assoc($select_postsdmmonth)) {
													$reportmonth=$rowdmmonth['reportmonth'];
													$reportyear=$rowdmmonth['reportyear'];

												}

												$currentMonth = date('m'); // Get the current month (01-12)
												$currentYear = date('Y'); // Get the current year (e.g., 2024)
												
												if ($reportmonth == $currentMonth && $reportyear == $currentYear) {
													$reportvariable = "Monthly Report Submitted"; // Set your variable here
													// Additional code if the condition is true
												}
												$enddateTimestamp = strtotime($enddate); // Convert end date to timestamp
												$tomorrowTimestamp = strtotime('+1 day', $enddateTimestamp); // Add one day to end date
												$tomorrowDate = date('Y-m-d', $tomorrowTimestamp); // Format the new date
												
												if ($tomorrowDate == date('Y-m-d') || $tomorrowDate < date('Y-m-d')) {

										?>


										
											<div class="d-flex pt-2 pb-2 border-bottom">
												<div class="d-flex ms-3">
													<span class="main-img-user">
														
														<?php

															$colors = array('bg-pink', 'bg-blue', 'bg-green', 'bg-purple', 'bg-orange', 'bg-primary', 'bg-cyan', 'bg-success');
															$randomColor = $colors[array_rand($colors)];
														?>
															<div class="avatar avatar-sm <?php echo $randomColor; ?> tx-fixed-white">
																<?php echo strtoupper(substr($brandname, 0, 1)); ?>
															</div>
														
													</span>
													<div class="ms-3">
														<h6 class="mg-b-0"><?php echo $brandname;  ?></h6><small class="tx-11 tx-gray-500"><?php echo $custname;  ?></small>
													</div>
												</div>
												<div class="ms-auto me-3">
												<!-- font-weight-bold -->
													<h6 class="mg-b-0"><?php echo $sname?></h6><small class="tx-11 tx-gray-500"><?php echo  $reportvariable ?></small>
												</div>
											</div>
										<?php } }} ?>
										
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-12 col-xl-4">
						<div class="card custom-card">
								<div class="card-body">
									<div>
										<h6 class="card-title mb-1">Pending Workstatus</h6>
										<p class="text-muted mb-0 card-sub-title">Yesterdays Work Status Pending Employee's List.</p>
									</div>
								</div>
								<div class="card-body">
									<div class="activity-block">

										<ul class="task-list">
											<?php
											$currentDate = strtotime(date("d-m-Y"));
											$yesterdayDate = strtotime('-1 day', $currentDate);
											// Check if yesterday is a Sunday
											if (date('w', $yesterdayDate) == 0) {
												// If yesterday is a Sunday, set it to the previous Saturday
												$yesterdayDate = strtotime('-1 day', $yesterdayDate);
											}
											echo "<p>Pending Date :" . date('d-m-Y', $yesterdayDate) . " </p>";
											$sql = "SELECT * FROM employee where status='Active'";
											$result = $connection->query($sql);
											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													$sqlwsdate1 = "SELECT * FROM dailyworkstatus where work_date ='" . date('d-m-Y', $yesterdayDate)  . "' and emp_id = '" . $row['id'] . "'";
													$resultwsdate1 = $connection->query($sqlwsdate1);
													if ($resultwsdate1->num_rows > 0) {
													} else {

											?>
														<li>
															<i class="task-icon bg-danger"></i>
															<h6><?php echo $row['empname']; ?></h6>

														</li>
											<?php    }
												}
											}     ?>




										</ul>
									</div>
								</div>
							</div>


							<div class="card custom-card pb-2">
								<div class="card-body">
									<div>
										<h6 class="card-title mb-1">Pending Process Job's</h6>
										<p class="text-muted mb-0 card-sub-title">Pending Process Job's - Employee List.</p>
									</div>
								</div>
								<div class="user-manager scroll-widget border-top">
									<div>
										<?php
										$query = "select * from staff_pjob_allocation ";
										$select_posts = mysqli_query($connection, $query);
										while ($row = mysqli_fetch_assoc($select_posts)) {

											$id = $row['id'];
											$post_title = $row['empname'];

											$post_jobname = "";
											$sqljob = "SELECT * FROM process_jobs where id='" . $row['jobid'] . "'";
											$resultjob = $connection->query($sqljob);
											if ($resultjob->num_rows > 0) {
												while ($rowjob = $resultjob->fetch_assoc()) {
													$post_jobname = $rowjob['jobname'];
												}
											}
											$post_description = "";
											$post_workstatus = "";
											$sql1 = "SELECT * FROM staff_pjob_allocation_details where staff_allocation_id ='" . $id . "' order by id desc limit 1";
											$result1 = $connection->query($sql1);
											if ($result1->num_rows > 0) {
												while ($row2 = $result1->fetch_assoc()) {
													$post_description = $row2['job_description'];
													$post_workstatus = $row2['work_status'];
												}
											}
											if ($post_workstatus !== 'Closed') {
										?>
												<div class="d-flex pt-2 pb-2 border-bottom">
													<div class="d-flex ms-3">
														<span class="main-img-user">
															<!-- <img alt="avatar"
														src="../assets/img/users/2.jpg"> -->
															<?php
															$colors = array('bg-pink', 'bg-blue', 'bg-green', 'bg-purple', 'bg-orange', 'bg-primary', 'bg-cyan', 'bg-success');
															$randomColor = $colors[array_rand($colors)];
															?>
															<div class="avatar avatar-sm <?php echo $randomColor; ?> tx-fixed-white">
																<?php echo strtoupper(substr($post_title, 0, 1)); ?>
															</div>



														</span>
														<div class="ms-3">
															<h6 class="mg-b-0"><?php echo $post_title; ?></h6><small class="tx-11 tx-gray-500"><?php echo $post_jobname; ?></small>
														</div>
													</div>
													<div class="ms-auto me-3">
														<h6 class="mg-b-0 font-weight-bold"><?php
																							if ($post_workstatus == "") {
																								echo "No data Found";
																							} else {
																								echo 	$post_workstatus;
																							} ?></h6>
														<!-- <small class="tx-11 tx-gray-500">Conversion Rate</small> -->
													</div>
												</div>
										<?php }
										} ?>

									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-4 col-xl-4">
							<div class="card custom-card pb-2">
								<div class="card-body">
									<div>
										<h6 class="card-title mb-1">Monthly Productivity</h6>
										<p class="text-muted mb-0 card-sub-title">Your productivity Score.</p>
									</div>
								</div>
								<div class="user-manager scroll-widget border-top">
									<div>
										<?php
										$query = "select * from employee where status='Active' order by  RAND()";
										$select_posts = mysqli_query($connection, $query);
										while ($row = mysqli_fetch_assoc($select_posts)) {

											$id = $row['id'];
											$post_title = $row['empname'];
											$post_deptid = $row['department_id'];
											$post_desigid = $row['desig_id'];
											$post_deptname = "";
											$post_designame = "";
											$querydept = "select * from department where id='" .   $post_deptid   . "'";
											$select_postsdept = mysqli_query($connection, $querydept);
											while ($rowdept = mysqli_fetch_assoc($select_postsdept)) {
												$post_deptname = $rowdept['department'];
											}
											$querydesig = "select * from designation where id='" .   $post_desigid   . "'";
											$select_postsdesig = mysqli_query($connection, $querydesig);
											while ($rowdesig = mysqli_fetch_assoc($select_postsdesig)) {
												$post_designame = $rowdesig['designation'];
											}



										?>
											<div class="d-flex pt-2 pb-2 border-bottom">
												<div class="d-flex ms-3">
													<span class="main-img-user">
														<?php if (isset($row['emppic']) && $row['emppic'] !== "") { ?>
															<img alt="avatar" src="../assets/img/users/2.jpg">
														<?php	} else {

															$colors = array('bg-pink', 'bg-blue', 'bg-green', 'bg-purple', 'bg-orange', 'bg-primary', 'bg-cyan', 'bg-success');
															$randomColor = $colors[array_rand($colors)];
														?>
															<div class="avatar avatar-sm <?php echo $randomColor; ?> tx-fixed-white">
																<?php echo strtoupper(substr($post_title, 0, 1)); ?>
															</div>
														<?php } ?>
													</span>
													<div class="ms-3">
														<h6 class="mg-b-0"><?php echo $post_title;  ?></h6><small class="tx-11 tx-gray-500"><?php echo $post_designame;  ?></small>
													</div>
												</div>
												<div class="ms-auto me-3">
													<h6 class="mg-b-0 font-weight-bold">*****</h6><small class="tx-11 tx-gray-500">Productivity Score</small>
												</div>
											</div>
										<?php } ?>
										<!-- <div class="d-flex pt-2 pb-2">
											<div class="d-flex ms-3">
												<span class="main-img-user"><img alt="avatar" src="../assets/img/users/4.jpg"></span>
												<div class="ms-3">
													<h6 class="mg-b-0">Owen Bongcaras</h6><small class="tx-11 tx-gray-500">Sales Manager3</small>
												</div>
											</div>
											<div class="ms-auto me-3">
												<h6 class="mg-b-0 font-weight-bold">18%</h6><small class="tx-11 tx-gray-500">Conversion Rate</small>
											</div>
										</div> -->
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-4 col-xl-4">
							
						</div>
					</div>
					<!-- End Row -->
				<?php } ?>
				
				</div>
			</div>
		</div>
		<!-- End Main Content-->

		<?php include 'includes/footer.php'; ?>


	</div>
	<!-- End Page -->

	<!-- Back-to-top -->
	<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

	<!-- Jquery js-->
	<script src="../assets/plugins/jquery/jquery.min.js"></script>

	<!-- Bootstrap js-->
	<script src="../assets/plugins/bootstrap/popper.min.js"></script>
	<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

	<!-- Flot js-->
	<script src="../assets/plugins/jquery.flot/jquery.flot.js"></script>
	<script src="../assets/plugins/jquery.flot/jquery.flot.resize.js"></script>
	<script src="../assets/js/chart.flot.sampledata.js"></script>

	<!-- Chart.Bundle js-->
	<script src="../assets/plugins/chart.js/Chart.bundle.min.js"></script>

	<!-- Peity js-->
	<script src="../assets/plugins/peity/jquery.peity.min.js"></script>

	<!-- Jquery-Ui js-->
	<script src="../assets/plugins/jquery-ui/ui/widgets/datepicker.js"></script>

	<!-- Select2 js-->
	<script src="../assets/plugins/select2/js/select2.min.js"></script>

	<!--MutipleSelect js-->
	<script src="../assets/plugins/multipleselect/multiple-select.js"></script>
	<script src="../assets/plugins/multipleselect/multi-select.js"></script>

	<!-- Perfect-scrollbar js-->
	<script src="../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="../assets/plugins/perfect-scrollbar/p-scroll-1.js"></script>

	<!-- Sidemenu js-->
	<script src="../assets/plugins/sidemenu/sidemenu.js"></script>

	<!-- Sidebar js-->
	<script src="../assets/plugins/sidebar/sidebar.js"></script>

	<!-- Sticky js-->
	<script src="../assets/js/sticky.js"></script>

	<!-- Dashboard js-->
	<script src="../assets/js/index.js"></script>

	<!-- Custom-Switcher js -->
	<script src="../assets/js/custom-switcher.js"></script>

	<!-- Custom js-->
	<script src="../assets/js/custom.js"></script>

	<!-- Switcher js -->
	<script src="../assets/switcher/js/switcher.js"></script>

</body>

</html>