<?php
ob_start();
session_start();

if (!isset($_SESSION['empname'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: signin.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['empname']);
	header("location: signin.php");
}

include "includes/connection.php";
$totalwork = "0";
$activeworks = "0";
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
								<!-- <div class="dropdown-menu tx-13">
									<a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-file-pdf-o me-2"></i>Export as
										Pdf</a>
									<a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-image me-2"></i>Export as
										Image</a>
									<a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-file-excel-o me-2"></i>Export as
										Excel</a>
								</div> -->
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
					<!-- <div class="responsive-background">
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<div class="advanced-search br-3">
								<div class="row align-items-center">
									<div class="col-md-12 col-xl-4">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group mb-lg-0">
													<label>From :</label>
													<div class="input-group">
														<div class="input-group-text">
															<i class="fe fe-calendar lh--9 op-6"></i>
														</div><input class="form-control fc-datepicker" placeholder="11/01/2019" type="text">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group mb-lg-0">
													<label>To :</label>
													<div class="input-group">
														<div class="input-group-text">
															<i class="fe fe-calendar lh--9 op-6"></i>
														</div><input class="form-control fc-datepicker" placeholder="11/08/2019" type="text">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-xl-3">
										<div class="form-group mb-lg-0">
											<label>Sales By Country :</label>
											<select class="form-control select2-flag-search select2" data-placeholder="Select Contry">
												<option value="AF">Afghanistan</option>
												<option value="AL">Albania</option>
												<option value="AD">Andorra</option>
												<option value="AG">Antigua and Barbuda</option>
												<option value="AU">Australia</option>
												<option value="AM">Armenia</option>
												<option value="AO">Angola</option>
												<option value="AR">Argentina</option>
												<option value="AT">Austria</option>
												<option value="AZ">Azerbaijan</option>
												<option value="BA">Bosnia and Herzegovina</option>
												<option value="BB">Barbados</option>
												<option value="BD">Bangladesh</option>
												<option value="BE">Belgium</option>
												<option value="BF">Burkina Faso</option>
												<option value="BG">Bulgaria</option>
												<option value="BH">Bahrain</option>
												<option value="BJ">Benin</option>
												<option value="BN">Brunei</option>
												<option value="BO">Bolivia</option>
												<option value="BT">Bhutan</option>
												<option value="BY">Belarus</option>
												<option value="CD">Congo</option>
												<option value="CA">Canada</option>
												<option value="CF">Central African Republic</option>
												<option value="CI">Cote d'Ivoire</option>
												<option value="CL">Chile</option>
												<option value="CM">Cameroon</option>
												<option value="CN">China</option>
												<option value="CO">Colombia</option>
												<option value="CU">Cuba</option>
												<option value="CV">Cabo Verde</option>
												<option value="CY">Cyprus</option>
												<option value="DJ">Djibouti</option>
												<option value="DK">Denmark</option>
												<option value="DM">Dominica</option>
												<option value="DO">Dominican Republic</option>
												<option value="EC">Ecuador</option>
												<option value="EE">Estonia</option>
												<option value="ER">Eritrea</option>
												<option value="ET">Ethiopia</option>
												<option value="FI">Finland</option>
												<option value="FJ">Fiji</option>
												<option value="FR">France</option>
												<option value="GA">Gabon</option>
												<option value="GD">Grenada</option>
												<option value="GE">Georgia</option>
												<option value="GH">Ghana</option>
												<option value="GH">Ghana</option>
												<option value="HN">Honduras</option>
												<option value="HT">Haiti</option>
												<option value="HU">Hungary</option>
												<option value="ID">Indonesia</option>
												<option value="IE">Ireland</option>
												<option value="IL">Israel</option>
												<option value="IN">India</option>
												<option value="IQ">Iraq</option>
												<option value="IR">Iran</option>
												<option value="IS">Iceland</option>
												<option value="IT">Italy</option>
												<option value="JM">Jamaica</option>
												<option value="JO">Jordan</option>
												<option value="JP">Japan</option>
												<option value="KE">Kenya</option>
												<option value="KG">Kyrgyzstan</option>
												<option value="KI">Kiribati</option>
												<option value="KW">Kuwait</option>
												<option value="KZ">Kazakhstan</option>
												<option value="LA">Laos</option>
												<option value="LB">Lebanons</option>
												<option value="LI">Liechtenstein</option>
												<option value="LR">Liberia</option>
												<option value="LS">Lesotho</option>
												<option value="LT">Lithuania</option>
												<option value="LU">Luxembourg</option>
												<option value="LV">Latvia</option>
												<option value="LY">Libya</option>
												<option value="MA">Morocco</option>
												<option value="MC">Monaco</option>
												<option value="MD">Moldova</option>
												<option value="ME">Montenegro</option>
												<option value="MG">Madagascar</option>
												<option value="MH">Marshall Islands</option>
												<option value="MK">Macedonia (FYROM)</option>
												<option value="ML">Mali</option>
												<option value="MM">Myanmar (formerly Burma)</option>
												<option value="MN">Mongolia</option>
												<option value="MR">Mauritania</option>
												<option value="MT">Malta</option>
												<option value="MV">Maldives</option>
												<option value="MW">Malawi</option>
												<option value="MX">Mexico</option>
												<option value="MZ">Mozambique</option>
												<option value="NA">Namibia</option>
												<option value="NG">Nigeria</option>
												<option value="NO">Norway</option>
												<option value="NP">Nepal</option>
												<option value="NR">Nauru</option>
												<option value="NZ">New Zealand</option>
												<option value="OM">Oman</option>
												<option value="PA">Panama</option>
												<option value="PF">Paraguay</option>
												<option value="PG">Papua New Guinea</option>
												<option value="PH">Philippines</option>
												<option value="PK">Pakistan</option>
												<option value="PL">Poland</option>
												<option value="QA">Qatar</option>
												<option value="RO">Romania</option>
												<option value="RU">Russia</option>
												<option value="RW">Rwanda</option>
												<option value="SA">Saudi Arabia</option>
												<option value="SB">Solomon Islands</option>
												<option value="SC">Seychelles</option>
												<option value="SD">Sudan</option>
												<option value="SE">Sweden</option>
												<option value="SG">Singapore</option>
												<option value="TG">Togo</option>
												<option value="TH">Thailand</option>
												<option value="TJ">Tajikistan</option>
												<option value="TL">Timor-Leste</option>
												<option value="TM">Turkmenistan</option>
												<option value="TN">Tunisia</option>
												<option value="TO">Tonga</option>
												<option value="TR">Turkey</option>
												<option value="TT">Trinidad and Tobago</option>
												<option value="TW">Taiwan</option>
												<option value="UA">Ukraine</option>
												<option value="UG">Uganda</option>
												<option value="UM">United States of America</option>
												<option value="UY">Uruguay</option>
												<option value="UZ">Uzbekistan</option>
												<option value="VA">Vatican City (Holy See)</option>
												<option value="VE">Venezuela</option>
												<option value="VN">Vietnam</option>
												<option value="VU">Vanuatu</option>
												<option value="YE">Yemen</option>
												<option value="ZM">Zambia</option>
												<option value="ZW">Zimbabwe</option>
											</select>
										</div>
									</div>
									<div class="col-md-6 col-xl-3">
										<div class="form-group mb-lg-0">
											<label>Products :</label>
											<select multiple="multiple" class="group-filter">
												<optgroup label="Mens">
													<option value="1">Foot wear</option>
													<option value="2">Top wear</option>
													<option value="3">Bootom wear</option>
													<option value="4">Men's Groming</option>
													<option value="5">Accessories</option>
												</optgroup>
												<optgroup label="Women">
													<option value="1">Western wear</option>
													<option value="2">Foot wear</option>
													<option value="3">Top wear</option>
													<option value="4">Bootom wear</option>
													<option value="5">Beuty Groming</option>
													<option value="6">Accessories</option>
													<option value="7">Jewellery</option>
												</optgroup>
												<optgroup label="Baby & Kids">
													<option value="1">Boys clothing</option>
													<option value="2">Girls Clothing</option>
													<option value="3">Toys</option>
													<option value="4">Baby Care</option>
													<option value="5">Kids footwear</option>
												</optgroup>
											</select>
										</div>
									</div>
									<div class="col-md-12 col-xl-2">
										<div class="form-group mb-lg-0">
											<label>Sales Type :</label>
											<select multiple="multiple" class="multi-select">
												<option value="1">Online</option>
												<option value="2">Offline</option>
												<option value="3">Reseller</option>
											</select>
										</div>
									</div>
								</div>
								<hr>
								<div class="text-end">
									<a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">Apply</a>
									<a href="javascript:void(0);" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">Reset</a>
								</div>
							</div>
						</div>
					</div> -->
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
						<!-- <div class="col-sm-6 col-xl-3 col-lg-6">
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
							<div class="card custom-card">
								<div class="card-body dash1">
									<div class="d-flex">
										<p class="mb-1 tx-inverse">Profit By Sale</p>
										<div class="ms-auto">
											<i class="fa fa-signal fs-20 text-info"></i>
										</div>
									</div>
									<div>
										<h3 class="dash-25">$789</h3>
									</div>
									<div class="progress mb-1">
										<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar progress-bar-xs wd-40p bg-info" role="progressbar">
										</div>
									</div>
									<div class="expansion-label d-flex text-muted">
										<span class="text-muted">Last Month</span>
										<span class="ms-auto"><i class="fa fa-caret-up me-1 text-success"></i>0.9%</span>
									</div>
								</div>
							</div>
						</div> -->
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
									<div>
										<h6 class="card-title mb-1">Monthly Productivity</h6>
										<p class="text-muted mb-0 card-sub-title">Your productivity Score.</p>
									</div>
								</div>
								<div class="user-manager scroll-widget border-top">
									<div>
										<?php
										$query = "select * from employee order by  RAND()";
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
				
				  	html:'<div class="row"><div class="col-md-4">'+
					  '<label for="eventtitle" class="form-label" style="font-size:15px;text-align:left;padding-bottom:20px;">Work Name:</label></div><div class="col-md-8">'+
					  '<input id="eventtitle" class="form-control" placeholder="Name" style="width: 84%;"  ></div></div>' +
				    '<div class="row "><div class="col-md-4"><label for="eventdescription" class="form-label" style="font-size:15px;text-align:left;padding-bottom:20px;">Work Description:</label>'+
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

				    	if(title != '' && description != ''){

				    		// AJAX - Add event
				    		$.ajax({
						  		url: 'ajaxfilenormal.php',
						  		type: 'post',
						  		data: {request: 'addEvent',title: title,description: description,start_date: start_date,end_date: end_date},
						  		dataType: 'json',
						  		success: function(response){

						  			if(response.status == 1){

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
						  				Swal.fire(response.message,'','success');

						  			}else{
						  				// Alert message
						  				Swal.fire(response.message,'','error');
						  			}
						  			
						  		}
						  	});
				    	}
				    	
				  	}
				})

	        	calendar.unselect()
	      	},
	      	eventDrop: function (event, delta) { // Move event

	      		// Event details
	      		var eventid = event.event.extendedProps.eventid;
	      		var newStart_date = event.event.startStr;
	      		var newEnd_date = event.event.endStr;
	           	
	           	// AJAX request
	           	$.ajax({
					url: 'ajaxfilenormal.php',
					type: 'post',
					data: {request: 'moveEvent',eventid: eventid,start_date: newStart_date, end_date: newEnd_date},
					dataType: 'json',
					async: false,
					success: function(response){

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
				  	title: 'Edit Work',
				  	showDenyButton: true,
					showCancelButton: true,
					confirmButtonText: 'Update',
					denyButtonText: 'Delete',

					html:'<div class="row"><div class="col-md-4">'+
					  '<label for="eventtitle" class="form-label" style="font-size:15px;text-align:left;padding-bottom:20px;">Work Name:</label></div><div class="col-md-8">'+
					  '<input id="eventtitle" class="form-control" placeholder="Event name" style="width: 84%;"  value="'+ title +'" ></div></div>' +
				    '<div class="row "><div class="col-md-4"><label for="eventdescription" class="form-label" style="font-size:15px;text-align:left;padding-bottom:20px;">Work Description:</label>'+
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

				    	if(newTitle != '' && newDescription != ''){

				    		// AJAX - Edit event
				    		$.ajax({
								url: 'ajaxfilenormal.php',
								type: 'post',
								data: {request: 'editEvent',eventid: eventid,title: newTitle, description: newDescription},
								dataType: 'json',
								async: false,
								success: function(response){

									if(response.status == 1){
										
										// Refetch all events
										calendar.refetchEvents();

										// Alert message
										Swal.fire(response.message, '', 'success');
									}else{

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
							data: {request: 'deleteEvent',eventid: eventid},
							dataType: 'json',
							async: false,
							success: function(response){

								if(response.status == 1){

									// Remove event from Calendar
									arg.event.remove();

									// Alert message
									Swal.fire(response.message, '', 'success');
								}else{

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