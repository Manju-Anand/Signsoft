<?php
session_start();

if (!isset($_SESSION['empname'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: signin.php');
}

if (isset($_GET['logout'])) {
	unset($_SESSION['empname']);
	session_destroy();
	header("location: signin.php");
}

include "includes/connection.php";
$totalwork = "0";
$activeworks = "0";
trafficlight();
function trafficlight()
{
	// 	echo "<script>alert('fgh');</script>";
	global $connection;
	$currentMonthCode = date('m') - 1;

	$sql = "DELETE FROM traffic_light WHERE monthcode='" . $currentMonthCode . "'";

	if ($connection->query($sql) === TRUE) {
		//   echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . $connection->error;
	}


	$query = "select * from employee where status='Active' order by id desc";
	$select_posts = mysqli_query($connection, $query);
	$i = 0;
	while ($row = mysqli_fetch_assoc($select_posts)) {
		$id = $row['id'];
		$post_title = $row['empname'];
		$post_desigid = $row['desig_id'];

		$querydesig = "SELECT * FROM designation where id ='" . $post_desigid . "'";
		$select_postdesig = mysqli_query($connection, $querydesig);
		while ($rowdesig = mysqli_fetch_assoc($select_postdesig)) {
			$post_desig = $rowdesig['designation'];
		}


		// ====================== Calculation starts ================
		$bs = (float)$row['basic_salary'];
		$ce = (float)$row['company_expense'];
		$staff_cost = $bs + $ce;
		$per_hour_cost = ($staff_cost / 200) * 2; // 200 hours in minutes- 12000

		// echo $per_hour_cost . " - per /hour cost of " . $post_title . "<br>";
		// =================================================================================
		$post_timetaken = 0;
		$orderid = "";
		$per_of_work = "";
		$project_quote = 0;
		$green_completion = 0;
		$orderamt = 0;
		$involvementpercentage = 0;
		$involvementpercentagetotal = 0;
		$orderamt1 = 0;
		$orderamt2 = 0;
		$pts = 0;
		$pts1 = 0;
		$catid = "";
		$order_expense = 0;
		// ===================== staff allocation =============================================
		$query1 = "select * from staff_allocation where empid='" . $id . "' AND MONTH(assignedDate) = MONTH(CURRENT_DATE)-1 and work_status='Active'";
		$select_posts1 = mysqli_query($connection, $query1);
		while ($row1 = mysqli_fetch_assoc($select_posts1)) {
			$post_timetaken = 0;
			$orderid = $row1['orderid'];
			// echo $orderid . " - orderid " .  "<br>";
			$per_of_work = $row1['per_of_work'];
			$catid = $row1['entryid'];
			// echo "Percentage : " . $per_of_work . "<br>";
			$query2 = "select * from order_customers where id='" . $orderid . "'";
			$select_posts2 = mysqli_query($connection, $query2);
			while ($row2 = mysqli_fetch_assoc($select_posts2)) {
				$order_expense = $row2['order_expense'];
				$orderamt2 = $row2['quotedAmt'];
			}

			$querycategory = "select * from order_category where order_id='" .  $orderid . "'";
			$select_postscategory = mysqli_query($connection, $querycategory);
			if ($select_postscategory) {
				// Check the number of records
				$num_records = mysqli_num_rows($select_postscategory);
				while ($rowcategory = mysqli_fetch_assoc($select_postscategory)) {
					$querysplitup = "select * from quote_splitup where orderid='" . $orderid . "' and itemid='" . $catid . "'";
					$select_postssplitup = mysqli_query($connection, $querysplitup);
					while ($rowsplitup = mysqli_fetch_assoc($select_postssplitup)) {
						$orderamt1 = $rowsplitup['price'];
						$order_expense = (!empty($rowsplitup['order_expense']) || $rowsplitup['order_expense'] === '0') ? $rowsplitup['order_expense'] : '0';
						// $order_expense = $rowsplitup['order_expense'];
					}
				}
				if ($orderamt1 == 0) {
					$orderamt = $orderamt2;
				} else {
					$orderamt = $orderamt1;
				}
			} else {
				echo "Error: " . mysqli_error($connection);
			}

			$project_quote = $orderamt - $order_expense;
			$involvementpercentage = $project_quote *  $per_of_work / 100;
			$involvementpercentagetotal = $involvementpercentagetotal + $involvementpercentage;
			$post_timetaken = '200';
			$green_completion = round($involvementpercentage / $per_hour_cost, 2);
			$pts1 = round($green_completion / $post_timetaken * 100, 2);
			$pts  += $pts1;
		}
		//    ============================== staff allocation =======================
		// ================================= staff DM allocation ===============================
		$query1 = "select * from staff_dm_allocation where staffid='" . $id . "' AND MONTH(assigndate) = MONTH(CURRENT_DATE)-1 and work_status='Active'";
		$select_posts1 = mysqli_query($connection, $query1);
		while ($row1 = mysqli_fetch_assoc($select_posts1)) {
			$post_timetaken = 0;
			$orderid = $row1['orderid'];
			$per_of_work = $row1['workpercentage'];
			$order_expense = $row1['promoamt'];
			$orderamt = $row1['payment'];

			$project_quote = $orderamt - $order_expense;
			$involvementpercentage = $project_quote *  $per_of_work / 100;
			$involvementpercentagetotal = $involvementpercentagetotal + $involvementpercentage;

			$post_timetaken = "200";  // 200 hours - full hours work for digital marketers

			$green_completion = round($involvementpercentage / $per_hour_cost, 2);
			$pts1 = round($green_completion / $post_timetaken * 100, 2);
			$pts  += $pts1;
		}
		// ================================= staff DM allocation ===============================
		// ================================= staff GD allocation ===============================
		$postercount = 0;
		$videocount = 0;
		$gifcount = 0;


		$query21 = "select * from graphics_masters";
		$select_posts21 = mysqli_query($connection, $query21);
		while ($row21 = mysqli_fetch_assoc($select_posts21)) {
			$postervalue = intval($row21['poster']);
			$videovalue = intval($row21['video']);
			$gifvalue = intval($row21['gif']);
		}


		$query1 = "SELECT * 
                FROM staff_dm_graphics_allocation 
                WHERE staffid = '" . $id . "' 
                AND MONTH(STR_TO_DATE(assigndate, '%d-%m-%Y')) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) 
                AND YEAR(STR_TO_DATE(assigndate, '%d-%m-%Y')) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) 
                AND work_status = 'Active' and postings = 'Poster'";
		$select_posts1 = mysqli_query($connection, $query1);
		if ($select_posts1->num_rows > 0) {
			$postercount = 0;

			while ($rowposter = mysqli_fetch_assoc($select_posts1)) {
				$query21 = "select * from gd_work_approval where workid='" . $rowposter['id'] . "'";
				$select_posts21 = mysqli_query($connection, $query21);
				while ($row21 = mysqli_fetch_assoc($select_posts21)) {
					$postercount += 1;
				}
			}
		} else {
		}
		$query1 = "SELECT * 
                FROM staff_dm_graphics_allocation 
                WHERE staffid = '" . $id . "' 
                AND MONTH(STR_TO_DATE(assigndate, '%d-%m-%Y')) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) 
                AND YEAR(STR_TO_DATE(assigndate, '%d-%m-%Y')) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) 
                AND work_status = 'Active' and postings = 'GIF'";
		$select_posts1 = mysqli_query($connection, $query1);
		if ($select_posts1->num_rows > 0) {

			$gifcount = 0;
			while ($rowposter = mysqli_fetch_assoc($select_posts1)) {
				$query21 = "select * from gd_work_approval where workid='" . $rowposter['id'] . "'";
				$select_posts21 = mysqli_query($connection, $query21);
				while ($row21 = mysqli_fetch_assoc($select_posts21)) {
					$gifcount += 1;
				}
			}
		}
		$query1 = "SELECT * 
                FROM staff_dm_graphics_allocation 
                WHERE staffid = '" . $id . "' 
                AND MONTH(STR_TO_DATE(assigndate, '%d-%m-%Y')) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) 
                AND YEAR(STR_TO_DATE(assigndate, '%d-%m-%Y')) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) 
                AND work_status = 'Active' and postings = 'Video'";
		$select_posts1 = mysqli_query($connection, $query1);
		if ($select_posts1->num_rows > 0) {

			$videocount = 0;
			while ($rowposter = mysqli_fetch_assoc($select_posts1)) {
				$query21 = "select * from gd_work_approval where workid='" . $rowposter['id'] . "'";
				$select_posts21 = mysqli_query($connection, $query21);
				while ($row21 = mysqli_fetch_assoc($select_posts21)) {
					$videocount += 1;
				}
			}
		}


		$post_timetaken = '200';
		$order_expense = 0;


		if ($post_timetaken > 0) {

			$videoamt = $videocount * $videovalue;
			$gifamt = $gifcount * $gifvalue;
			$posteramt = $postercount * $postervalue;

			$involvementpercentage = $videoamt + $gifamt + $posteramt;
			$involvementpercentagetotal = $involvementpercentagetotal + $involvementpercentage;

			$project_quote = ($involvementpercentage - $order_expense) / 2;
			$green_completion = round($project_quote / $per_hour_cost, 2);
			$pts1 = round(($green_completion / $post_timetaken) * 100, 2);
			$pts  += $pts1;
		}


		// ================================= staff GD allocation ===============================

		$colorcode = "Grey";
		// ==============new calculation ============
		// echo $involvementpercentagetotal;
		$test1 = 0;
		$test1 = ($bs + $ce) * 2; // Green points - acquire score more than (salary + company expense) * 2
		$test2 = ($bs + $ce); // amber points - acquire score salary + company expense


		if ($involvementpercentagetotal >= $test1) {
			$colorcode = "Green";
		} elseif ($involvementpercentagetotal >= $test2) {
			$colorcode = "Amber";
		} elseif ($involvementpercentagetotal >= $bs) {
			$colorcode = "Red";
		} else {
			$colorcode = "Grey";
		}
		// ============== end new calculation ============
		// 			if ($pts  == 100 && $pts > 100){
		// 				$colorcode ="Green";
		// 			}elseif ($pts  >= 50 && $pts <= 99 ){
		// 				$colorcode ="Amber";
		// 			}elseif ($pts  >= 1 && $pts <= 49 ){
		// 				$colorcode ="Red";
		// 			}

		$orgpts = round($pts, 2);
		$insertRowStmt = $connection->prepare("INSERT INTO traffic_light (empid, empname, empdesig, points, colorcode, monthcode,color_score) VALUES (?, ?, ?, ?, ?, ?,?)");

		$insertRowStmt->bind_param("sssdsss", $id, $post_title, $post_desig, $orgpts, $colorcode, $currentMonthCode, $involvementpercentagetotal);
		$insertRowStmt->execute();

		//    ===================================================
	}
}



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
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

	<style>
			.tag-amber {
		     width: 100px;
			background-color: rgb(255, 191, 0);
		}

		.tag-green {
		    width: 120px;
			background-color: rgb(0, 100, 0);
		}

		.tag-red {
		     width: 80px;
			background-color: rgb(255, 0, 0);
		}

		.tag-grey {
		     width: 60px;
			background-color: rgb(128, 128, 128);
		}
	</style>
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


							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Crew Dashboard</li>
							</ol>
						</div>
						<div class="d-flex">
							<div class="me-2">
								<a class="btn ripple btn-primary dropdown-toggle mb-0" href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<!-- <i class="fe fe-external-link"></i> Export <i class="fa fa-caret-down ms-1"></i> -->
								</a>

							</div>
							<div>
								<a href="javascript:void(0);" class="btn ripple btn-secondary navresponsive-toggler mb-0" data-bs-toggle="" data-bs-target="" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
									<!-- <i class="fe fe-filter me-1"></i> Filter <i class="fa fa-caret-down ms-1"></i> -->
								</a>
							</div>
						</div>
					</div>
					<!-- End Page Header -->

					<!--Navbar-->

					<!--End Navbar -->

					<!-- Row -->
					<?php
					$query = "select * from staff_allocation where empid='" . $_SESSION['empid'] . "'";
					$result = mysqli_query($connection, $query);
					if ($result->num_rows > 0) {
						$totalwork = $result->num_rows;
					}
					$query = "select * from staff_allocation where empid='" . $_SESSION['empid'] . "' and work_status='Active'";
					$result = mysqli_query($connection, $query);
					if ($result->num_rows > 0) {
						$activeworks = $result->num_rows;
					}

					if ($_SESSION['modulename'] == "Digital") {
						$query = "select * from staff_dm_allocation where staffid='" . $_SESSION['empid'] . "'";
						$result = mysqli_query($connection, $query);
						if ($result->num_rows > 0) {
							$totalwork += $result->num_rows;
						}
						$query = "select * from staff_dm_allocation where staffid='" . $_SESSION['empid'] . "' and work_status='Active'";
						$result = mysqli_query($connection, $query);
						if ($result->num_rows > 0) {
							$activeworks += $result->num_rows;
						}
					}
					if ($_SESSION['modulename'] == "Graphics") {
						$query = "select * from staff_dm_graphics_allocation where staffid='" . $_SESSION['empid'] . "'";
						$result = mysqli_query($connection, $query);
						if ($result->num_rows > 0) {
							$totalwork += $result->num_rows;
						}
						$query = "select * from staff_dm_graphics_allocation where staffid='" . $_SESSION['empid'] . "' and work_status='Active'";
						$result = mysqli_query($connection, $query);
						if ($result->num_rows > 0) {
							$activeworks += $result->num_rows;
						}
					}
					


					

					?>
					<div class="row row-sm">
						<div class="col-sm-12 col-xl-6 col-lg-6">
							<div class="card custom-card">
								<div class="card-body dash1">
									<div class="d-flex">
										<p class="mb-1 tx-inverse">Number Of Total Works</p>
										<div class="ms-auto">
											<i class="fa fa-line-chart fs-20 text-primary"></i>
										</div>
									</div>
									<div>
										<h3 class="dash-25"><?php echo $totalwork; ?></h3>
									</div>
									<div class="progress mb-1">
										<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar progress-bar-xs wd-70p" role="progressbar"></div>
									</div>
									<div class="expansion-label d-flex">
										<span class="text-muted">******</span>
										<span class="ms-auto"><i class="fa fa-caret-up me-1 text-success"></i>***%</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-xl-6 col-lg-6">
							<div class="card custom-card">
								<div class="card-body dash1">
									<div class="d-flex">
										<p class="mb-1 tx-inverse">Number of Active Works</p>
										<div class="ms-auto">
											<i class="fa fa-money fs-20 text-secondary"></i>
										</div>
									</div>
									<div>
										<h3 class="dash-25"><?php echo $activeworks; ?></h3>
									</div>
									<div class="progress mb-1">
										<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar progress-bar-xs wd-60p bg-secondary" role="progressbar">
										</div>
									</div>
									<div class="expansion-label d-flex">
										<span class="text-muted">*****</span>
										<span class="ms-auto"><i class="fa fa-caret-down me-1 text-danger"></i>*****%</span>
									</div>
								</div>
							</div>
						</div>

					</div>
					<!--End  Row -->

					<!-- Row -->
					<div class="row row-sm">
						<div class="col-sm-12 col-xl-8 col-lg-8">
							<div class="card custom-card overflow-hidden">
								<div class="card-body">

									<?php if ($_SESSION['modulename'] == "Digital") { ?>

										<?php
										$currentData = date('Y-m-d');
										?>

										<!-- Calendar Container -->
										<div id='calendar-container'>
											<div id='dmcalendar'></div>
										</div>

									<?php } else { ?>
										<?php
										$currentData = date('Y-m-d');
										?>
										<h6> TO DO LIST </h6>
										<!-- Calendar Container -->
										<div id='calendar-container'>
											<div id='othercalendar'></div>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-4 col-xl-4">
							<div class="card custom-card pb-2">
								<div class="card-body">
									<div class='row'>
									    <div class="col-md-6">
									        	<h6 class="card-title mb-1">Monthly Productivity</h6>
										        <p class="text-muted mb-0 card-sub-title">Your productivity Score.</p>
									    </div>
									    <div class="col-md-6">
									        	
									        	<?php 
									        		$currentMonthCode1 = date('m') - 1; 
            	                                    $query = "select * from traffic_light where monthcode='". $currentMonthCode1  ."' and empid='" . $empid ."'";
            										$select_posts = mysqli_query($connection, $query);
            										while ($row = mysqli_fetch_assoc($select_posts)) {
									        	?>
									        	<h6 class="card-title mb-1">Your Score - <?php echo $row['points']; ?></h6>
										        <!--<p class="text-muted mb-0 card-sub-title"></p>-->
										        <?php } ?>
									    </div>
									
									</div>
									 
								</div>
								<div class="user-manager scroll-widget border-top">
									<div>
										<?php
								// 		$query = "select * from employee where status='Active' order by  RAND()";
								// 		$select_posts = mysqli_query($connection, $query);
								// 		while ($row = mysqli_fetch_assoc($select_posts)) {

								// 			$id = $row['id'];
								// 			$post_title = $row['empname'];
								// 			$post_deptid = $row['department_id'];
								// 			$post_desigid = $row['desig_id'];
								// 			$post_deptname = "";
								// 			$post_designame = "";
								// 			$querydept = "select * from department where id='" .   $post_deptid   . "'";
								// 			$select_postsdept = mysqli_query($connection, $querydept);
								// 			while ($rowdept = mysqli_fetch_assoc($select_postsdept)) {
								// 				$post_deptname = $rowdept['department'];
								// 			}
								// 			$querydesig = "select * from designation where id='" .   $post_desigid   . "'";
								// 			$select_postsdesig = mysqli_query($connection, $querydesig);
								// 			while ($rowdesig = mysqli_fetch_assoc($select_postsdesig)) {
								// 				$post_designame = $rowdesig['designation'];
								// 			}
								
							        	$currentMonthCode1 = date('m') - 1; 
	                                    $query = "select * from traffic_light where monthcode='". $currentMonthCode1  ."' order by points desc";
										$select_posts = mysqli_query($connection, $query);
										while ($row = mysqli_fetch_assoc($select_posts)) {
                                            $post_title = $row['empname'];
                                            $post_designame = $row['empdesig'];
                                            $post_points = $row['points'];
                                            $post_colorcode = $row['colorcode'];
                                            $post_colorscore = $row['color_score'];

										?>
											<div class="d-flex pt-2 pb-2 border-bottom">
												<div class="d-flex ms-3">
													<span class="main-img-user">
													
														<?php

															$colors = array('bg-pink', 'bg-blue', 'bg-green', 'bg-purple', 'bg-orange', 'bg-primary', 'bg-cyan', 'bg-success');
															$randomColor = $colors[array_rand($colors)];
														?>
															<div class="avatar avatar-sm <?php echo $randomColor; ?> tx-fixed-white">
																<?php echo strtoupper(substr($post_title, 0, 1)); ?>
															</div>
													
													</span>
													<div class="ms-3">
														<h6 class="mg-b-0"><?php echo $post_title;  ?></h6><small class="tx-11 tx-gray-500"><?php echo $post_designame;  ?></small>
													</div>
												</div>
												<div class="ms-auto me-3">
												    <?php if ($post_colorcode == "Green"){ ?>
												    <div class="tags">
														<span class="tag tag-radius tag-round tag-pill tag-green"> Green</span>
													</div>
													<?php } elseif ($post_colorcode == "Amber"){?>
													<div class="tags">
														<span class="tag tag-radius tag-round tag-pill tag-amber"> Amber</span>
													</div>
													<?php } elseif ($post_colorcode == "Red"){?>
													<div class="tags">
														<span class="tag tag-radius tag-round tag-pill tag-red"> Red</span>
													</div>
													<?php } elseif ($post_colorcode == "Grey"){?>
													<div class="tags">
														<span class="tag tag-radius tag-round tag-pill tag-grey"> Grey</span>
													</div>
													
													<?php } ?>
													<!--<h6 class="mg-b-0 font-weight-bold"><?php echo $post_colorscore;?></h6><small class="tx-11 tx-gray-500">Productivity Score</small>-->
													<!--<h6 class="mg-b-0 font-weight-bold"><?php echo $post_points;?></h6><small class="tx-11 tx-gray-500">Productivity points</small>-->
												</div>
											</div>
										<?php } ?>
									
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Row -->


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
	<script src="notification.js"></script>
	<!-- Fullcalendar  -->
	<script type="text/javascript" src="fullcalendar/dist/index.global.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		// ************ dm calendar ****************
		document.addEventListener('DOMContentLoaded', function() {
			// Function to generate a random color in hexadecimal format
			function getRandomColor() {
				return '#' + Math.floor(Math.random() * 16777215).toString(16);
			}

			// Set random colors to CSS variables
			document.documentElement.style.setProperty('--random-event-bg-color', getRandomColor());
			document.documentElement.style.setProperty('--random-event-border-color', getRandomColor());

			var calendarEl = document.getElementById('dmcalendar');

			var calendar = new FullCalendar.Calendar(calendarEl, {
				initialDate: '<?= $currentData ?>',
				height: '600px',
				selectable: true,
				editable: true,
				dayMaxEvents: true, // allow "more" link when too many events
				events: 'fetchevents.php', // Fetch all events
				select: function(arg) { // Create Event

					// Fetch values from the database using AJAX
					$.ajax({
						url: 'getValues.php',
						type: 'get',
						dataType: 'json',
						success: function(response) {
							if (response.status == 1) {
								calendar.addEvent({
									eventid: response.eventid,
									title: title,
									description: description,
									start: arg.start,
									end: arg.end,
									allDay: arg.allDay
								})



							} else {
								// Handle error fetching values from the database
								// Swal.fire('Error fetching values from the database', '', 'error');
							}
						},
						error: function() {
							// Handle AJAX error
							Swal.fire('Error fetching values from the database', '', 'error');
						}
					});




					calendar.unselect()
				},
				eventDrop: function(event, delta) { // Move event

					// Event details
					var eventid = event.event.extendedProps.eventid;
					var newStart_date = event.event.startStr;
					var newEnd_date = event.event.endStr;

					// AJAX request
					$.ajax({
						url: 'ajaxfile.php',
						type: 'post',
						data: {
							request: 'moveEvent',
							eventid: eventid,
							start_date: newStart_date,
							end_date: newEnd_date
						},
						dataType: 'json',
						async: false,
						success: function(response) {

							console.log(response);

						}
					});

				},
				eventClick: function(arg) { // Edit/Delete event

					// Event details
					var eventid = arg.event._def.extendedProps.eventid;
					var description = arg.event._def.extendedProps.description;
					var title = arg.event._def.title;

					// Alert box to edit and delete event
					Swal.fire({
						title: 'View Event',
						showCancelButton: true,
						html: '<div class="row">' +
							'<div class="col-md-4">' +
							'<label for="eventtitle" class="form-label" style="font-size:15px;text-align:left;padding-bottom:20px;">Work Name:</label></div><div class="col-md-8">' +
							'<input id="eventtitle" class="form-control" placeholder="Enter Event name" value="' + title + '"  readonly>' +
							'</div>' +
							'</div>' +
							'<div class="row ">' +
							'<div class="col-md-4">' +
							'<label for="eventdescription" class="form-label" style="font-size:15px;text-align:left;padding-bottom:20px;">Work Description:</label></div><div class="col-md-8">' +
							'<textarea id="eventdescription" class="form-control" placeholder="Enter Work description" rows="2"  readonly>' + description + '</textarea>' +
							'</div>' +
							'</div><br>',
						// html: '<input id="eventtitle" class="swal2-input" placeholder="Event name" style="width: 84%;" value="' + title + '" readonly>' +
						// 	'<textarea id="eventdescription" class="swal2-input" placeholder="Event description" style="width: 84%; height: 100px;font-size:15px;">' + description + '</textarea>',
						focusConfirm: false,
						preConfirm: () => {
							return [
								document.getElementById('eventtitle').value,
								document.getElementById('eventdescription').value
							]
						}
					}).then((result) => {


					})

				}

			});

			calendar.render();
		});

		// ********** others calendar ********************

		document.addEventListener('DOMContentLoaded', function() {
			var calendarEl = document.getElementById('othercalendar');

			var calendar = new FullCalendar.Calendar(calendarEl, {
				initialDate: '<?= $currentData ?>',
				height: '600px',
				selectable: true,
				editable: true,
				dayMaxEvents: true, // allow "more" link when too many events
				events: 'fetcheventsnormal.php', // Fetch all events
				select: function(arg) { // Create Event

					// Alert box to add event
					Swal.fire({
						title: 'Add New Work',
						showCancelButton: true,
						confirmButtonText: 'Create',

						html: '<div class="row"><div class="col-md-4">' +
							'<label for="eventtitle" class="form-label" style="font-size:15px;text-align:left;padding-bottom:20px;">Work Name:</label></div><div class="col-md-8">' +
							'<input id="eventtitle" class="form-control" placeholder="Name" style="width: 84%;"  ></div></div>' +
							'<div class="row "><div class="col-md-4"><label for="eventdescription" class="form-label" style="font-size:15px;text-align:left;padding-bottom:20px;">Work Description:</label>' +
							'</div><div class="col-md-8"><textarea id="eventdescription" class="form-control" placeholder="Description" style="width: 84%; height: 100px;"></textarea></div></div>',
						focusConfirm: false,
						preConfirm: () => {
							return [
								document.getElementById('eventtitle').value,
								document.getElementById('eventdescription').value
							]
						}
					}).then((result) => {

						if (result.isConfirmed) {

							var title = result.value[0].trim();
							var description = result.value[1].trim();
							var start_date = arg.startStr;
							var end_date = arg.endStr;

							if (title != '' && description != '') {

								// AJAX - Add event
								$.ajax({
									url: 'ajaxfilenormal.php',
									type: 'post',
									data: {
										request: 'addEvent',
										title: title,
										description: description,
										start_date: start_date,
										end_date: end_date
									},
									dataType: 'json',
									success: function(response) {

										if (response.status == 1) {

											// Add event
											calendar.addEvent({
												eventid: response.eventid,
												title: title,
												description: description,
												start: arg.start,
												end: arg.end,
												allDay: arg.allDay
											})

											// Alert message
											Swal.fire(response.message, '', 'success');

										} else {
											// Alert message
											Swal.fire(response.message, '', 'error');
										}

									}
								});
							} else {
								alert("Enter Title & Description");
							}

						}
					})

					calendar.unselect()
				},
				eventDrop: function(event, delta) { // Move event

					// Event details
					var eventid = event.event.extendedProps.eventid;
					var newStart_date = event.event.startStr;
					var newEnd_date = event.event.endStr;

					// AJAX request
					$.ajax({
						url: 'ajaxfilenormal.php',
						type: 'post',
						data: {
							request: 'moveEvent',
							eventid: eventid,
							start_date: newStart_date,
							end_date: newEnd_date
						},
						dataType: 'json',
						async: false,
						success: function(response) {
							onsole.log(response);

						}
					});

				},
				eventClick: function(arg) { // Edit/Delete event

					// Event details
					var eventid = arg.event._def.extendedProps.eventid;
					var description = arg.event._def.extendedProps.description;
					var title = arg.event._def.title;

					// Alert box to edit and delete event
					Swal.fire({
						title: 'Edit Work',
						showDenyButton: true,
						showCancelButton: true,
						confirmButtonText: 'Update',
						denyButtonText: 'Delete',

						html: '<div class="row"><div class="col-md-4">' +
							'<label for="eventtitle" class="form-label" style="font-size:15px;text-align:left;padding-bottom:20px;">Work Name:</label></div><div class="col-md-8">' +
							'<input id="eventtitle" class="form-control" placeholder="Event name" style="width: 84%;"  value="' + title + '" ></div></div>' +
							'<div class="row "><div class="col-md-4"><label for="eventdescription" class="form-label" style="font-size:15px;text-align:left;padding-bottom:20px;">Work Description:</label>' +
							'</div><div class="col-md-8"><textarea id="eventdescription" class="form-control" placeholder="Event description" style="width: 84%; height: 100px;">' + description + '</textarea></div></div>',

						// html:
						// '<input id="eventtitle" class="swal2-input" placeholder="Event name" style="width: 84%;" value="'+ title +'" >' +
						// '<textarea id="eventdescription" class="swal2-input" placeholder="Event description" style="width: 84%; height: 100px;">' + description + '</textarea>',
						focusConfirm: false,
						preConfirm: () => {
							return [
								document.getElementById('eventtitle').value,
								document.getElementById('eventdescription').value
							]
						}
					}).then((result) => {

						if (result.isConfirmed) { // Update

							var newTitle = result.value[0].trim();
							var newDescription = result.value[1].trim();

							if (newTitle != '' && newDescription != '') {

								// AJAX - Edit event
								$.ajax({
									url: 'ajaxfilenormal.php',
									type: 'post',
									data: {
										request: 'editEvent',
										eventid: eventid,
										title: newTitle,
										description: newDescription
									},
									dataType: 'json',
									async: false,
									success: function(response) {

										if (response.status == 1) {

											// Refetch all events
											calendar.refetchEvents();

											// Alert message
											Swal.fire(response.message, '', 'success');
										} else {

											// Alert message
											Swal.fire(response.message, '', 'error');
										}

									}
								});
							}

						} else if (result.isDenied) { // Delete

							// AJAX - Delete Event
							$.ajax({
								url: 'ajaxfilenormal.php',
								type: 'post',
								data: {
									request: 'deleteEvent',
									eventid: eventid
								},
								dataType: 'json',
								async: false,
								success: function(response) {

									if (response.status == 1) {

										// Remove event from Calendar
										arg.event.remove();

										// Alert message
										Swal.fire(response.message, '', 'success');
									} else {

										// Alert message
										Swal.fire(response.message, '', 'error');
									}

								}
							});
						}
					})

				}
			});

			calendar.render();
		});
	</script>
</body>

</html>