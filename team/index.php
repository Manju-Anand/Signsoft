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
									<i class="fe fe-external-link"></i> Export <i class="fa fa-caret-down ms-1"></i>
								</a>
								<div class="dropdown-menu tx-13">
									<a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-file-pdf-o me-2"></i>Export as
										Pdf</a>
									<a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-image me-2"></i>Export as
										Image</a>
									<a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-file-excel-o me-2"></i>Export as
										Excel</a>
								</div>
							</div>
							<div>
								<a href="javascript:void(0);" class="btn ripple btn-secondary navresponsive-toggler mb-0" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
									<i class="fe fe-filter me-1"></i> Filter <i class="fa fa-caret-down ms-1"></i>
								</a>
							</div>
						</div>
					</div>
					<!-- End Page Header -->

					<!--Navbar-->
					<div class="responsive-background">
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
					</div>
					<!--End Navbar -->

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
						</div>
					</div>
					<!--End  Row -->

					<!-- Row -->
					<div class="row row-sm">
						<div class="col-sm-12 col-xl-12 col-lg-12">
							<div class="card custom-card overflow-hidden">
								<div class="card-body">
									<!-- <div class="container"> -->
									<?php
									$currentData = date('Y-m-d');
									?>

									<!-- Calendar Container -->
									<div id='calendar-container'>
										<div id='calendar'></div>
									</div>
									<!-- </div> -->
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-xl-8 col-lg-8">
							<div class="card custom-card overflow-hidden">
								<div class="card-body">
									<div class="card-option d-flex">
										<div>
											<h6 class="card-title mb-1">Overview of Sales Win/Lost</h6>
											<p class="text-muted mb-0 card-sub-title">Compared to last month sales.</p>
										</div>
										<div class="card-option-title ms-auto">
											<div class="btn-group p-0">
												<button class="btn btn-light btn-sm" type="button">Month</button>
												<button class="btn btn-outline-light btn-sm" type="button">Year</button>
											</div>
										</div>
									</div>
									<div>
										<canvas id="sales"></canvas>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-4 col-xl-4">
							<div class="card custom-card">
								<div class="card-body">
									<div>
										<h6 class="card-title mb-1">Cost BreakDown</h6>
										<p class="text-muted card-sub-title">Excepteur sint occaecat cupidatat non
											proident.
										</p>
									</div>
									<div class="row">
										<div class="col-6 col-md-6 text-center">
											<div class="mb-2">
												<span class="peity-donut" data-peity='{ "fill": ["#eb6f33", "#e1e6f1"], "innerRadius": 14, "radius": 20 }'>4/7</span>
											</div>
											<p class="mb-1 tx-inverse">Marketing</p>
											<h4 class="mb-1"><span>$</span>67,927</h4>
											<span class="text-muted fs-12"><i class="fa fa-caret-up me-1 text-success"></i>54% last month</span>
										</div>
										<div class="col-6 col-md-6 text-center">
											<div class="mb-2">
												<span class="peity-donut" data-peity='{ "fill": ["#01b8ff", "#e1e6f1"], "innerRadius": 14, "radius": 20 }'>2/7</span>
											</div>
											<p class="mb-1 tx-inverse">Sales</p>
											<h4 class="mb-1"><span>$</span>24,789</h4>
											<span class="text-muted fs-12"><i class="fa fa-caret-down me-1 text-danger"></i>33% last month</span>
										</div>
									</div>
								</div>
							</div>
							<div class="card custom-card">
								<div class="card-body">
									<div>
										<h6 class="card-title mb-1">Monthly Profits</h6>
										<p class="text-muted mb-2 card-sub-title">Excepteur sint occaecat cupidatat non
											proident.
										</p>
									</div>
									<h3><span>$</span>22,534</h3>
									<div class="clearfix mb-3">
										<div class="clearfix">
											<span class="float-start text-muted">This Month</span>
											<span class="float-end">75%</span>
										</div>
										<div class="progress mt-1">
											<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar progress-bar-xs wd-70p bg-primary" role="progressbar">
											</div>
										</div>
									</div>
									<div class="clearfix">
										<div class="clearfix">
											<span class="float-start text-muted">Last Month</span>
											<span class="float-end">50%</span>
										</div>
										<div class="progress mt-1">
											<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" class="progress-bar progress-bar-xs wd-50p bg-success" role="progressbar">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Row -->

					<!-- Row -->
					<div class="row row-sm">
						<div class="col-sm-12 col-lg-12  col-xl-4">
							<div class="card custom-card">
								<div class="card-body">
									<div>
										<h6 class="card-title mb-1">Activity</h6>
										<p class="text-muted mb-0 card-sub-title">Nemo enim ipsam voluptatem fugit sequi
											nesciunt.</p>
									</div>
								</div>
								<div class="card-body">
									<div class="activity-block">
										<ul class="task-list">
											<li>
												<i class="task-icon bg-success"></i>
												<h6>Successful Purchase<small class="float-end text-muted tx-11">29 Oct
														2019</small></h6>
												<span class="text-muted tx-12">Order ID: #4567</span>
											</li>
											<li>
												<i class="task-icon bg-secondary"></i>
												<h6>New Registered Seller<small class="float-end text-muted tx-11">25
														Oct
														2019</small></h6>
												<span class="text-muted tx-12">User ID: #8976</span>
											</li>
											<li>
												<i class="task-icon bg-primary"></i>
												<h6>Order Verification<small class="float-end text-muted tx-11">14 Oct
														2019</small></h6>
												<span class="text-muted tx-12">Order ID: #6290</span>
											</li>
											<li>
												<i class="task-icon bg-info"></i>
												<h6>New Item Added<small class="float-end text-muted tx-11">02 Oct
														2019</small></h6>
												<span class="text-muted tx-12">Item ID: #0235</span>
											</li>
											<li>
												<i class="task-icon bg-danger"></i>
												<h6>Purchase Cancellation<small class="float-end text-muted tx-11">28
														Sep
														2019</small></h6>
												<span class="text-muted tx-12">Order ID: #1905</span>
											</li>
											<li class="mb-0">
												<i class="task-icon bg-warning"></i>
												<h6>Overdue Shipments<small class="float-end text-muted tx-11">25 Sep
														2019</small></h6>
												<span class="text-muted tx-12">Order ID: #8902</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-12 col-xl-4">
							<div class="card custom-card pb-2">
								<div class="card-body">
									<div>
										<h6 class="card-title mb-1">Top Users Conversion Rate</h6>
										<p class="text-muted mb-0 card-sub-title">Nemo enim ipsam voluptatem fugit sequi
											nesciunt.</p>
									</div>
								</div>
								<div class="user-manager scroll-widget border-top">
									<div>
										<div class="d-flex pt-2 pb-2 border-bottom">
											<div class="d-flex ms-3">
												<span class="main-img-user"><img alt="avatar" src="../assets/img/users/2.jpg"></span>
												<div class="ms-3">
													<h6 class="mg-b-0">Socrates Itumay</h6><small class="tx-11 tx-gray-500">Sales Manager1</small>
												</div>
											</div>
											<div class="ms-auto me-3">
												<h6 class="mg-b-0 font-weight-bold">34%</h6><small class="tx-11 tx-gray-500">Conversion Rate</small>
											</div>
										</div>
										<div class="d-flex pt-2 pb-2 border-bottom">
											<div class="d-flex ms-3">
												<span class="main-img-user"><img alt="avatar" src="../assets/img/users/3.jpg"></span>
												<div class="ms-3">
													<h6 class="mg-b-0">Reynante Labares</h6><small class="tx-11 tx-gray-500">Sales Manager2</small>
												</div>
											</div>
											<div class="ms-auto me-3">
												<h6 class="mg-b-0 font-weight-bold">22%</h6><small class="tx-11 tx-gray-500">Conversion Rate</small>
											</div>
										</div>
										<div class="d-flex pt-2 pb-2 border-bottom">
											<div class="d-flex ms-3">
												<span class="main-img-user"><img alt="avatar" src="../assets/img/users/4.jpg"></span>
												<div class="ms-3">
													<h6 class="mg-b-0">Owen Bongcaras</h6><small class="tx-11 tx-gray-500">Sales Manager3</small>
												</div>
											</div>
											<div class="ms-auto me-3">
												<h6 class="mg-b-0 font-weight-bold">18%</h6><small class="tx-11 tx-gray-500">Conversion Rate</small>
											</div>
										</div>
										<div class="d-flex pt-2 pb-2 border-bottom">
											<div class="d-flex ms-3">
												<span class="main-img-user"><img alt="avatar" src="../assets/img/users/5.jpg"></span>
												<div class="ms-3">
													<h6 class="mg-b-0">Mariane Galeon</h6><small class="tx-11 tx-gray-500">Sales Manager4</small>
												</div>
											</div>
											<div class="ms-auto me-3">
												<h6 class="mg-b-0 font-weight-bold">15%</h6><small class="tx-11 tx-gray-500">Conversion Rate</small>
											</div>
										</div>
										<div class="d-flex pt-2 pb-2 border-bottom">
											<div class="d-flex ms-3">
												<span class="main-img-user"><img alt="avatar" src="../assets/img/users/6.jpg"></span>
												<div class="ms-3">
													<h6 class="mg-b-0">Joyce Chua</h6><small class="tx-11 tx-gray-500">Sales Manager5</small>
												</div>
											</div>
											<div class="ms-auto me-3">
												<h6 class="mg-b-0 font-weight-bold">12%</h6><small class="tx-11 tx-gray-500">Conversion Rate</small>
											</div>
										</div>
										<div class="d-flex pt-2 pb-2 border-bottom">
											<div class="d-flex ms-3">
												<span class="main-img-user"><img alt="avatar" src="../assets/img/users/7.jpg"></span>
												<div class="ms-3">
													<h6 class="mg-b-0">Sonia Fraser</h6><small class="tx-11 tx-gray-500">Sales Manager5</small>
												</div>
											</div>
											<div class="ms-auto me-3">
												<h6 class="mg-b-0 font-weight-bold">11%</h6><small class="tx-11 tx-gray-500">Conversion Rate</small>
											</div>
										</div>
										<div class="d-flex pt-2 pb-2">
											<div class="d-flex ms-3">
												<span class="main-img-user"><img alt="avatar" src="../assets/img/users/4.jpg"></span>
												<div class="ms-3">
													<h6 class="mg-b-0">Owen Bongcaras</h6><small class="tx-11 tx-gray-500">Sales Manager3</small>
												</div>
											</div>
											<div class="ms-auto me-3">
												<h6 class="mg-b-0 font-weight-bold">18%</h6><small class="tx-11 tx-gray-500">Conversion Rate</small>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-12 col-xl-4 ">
							<div class="card custom-card">
								<div class="card-body">
									<div>
										<h6 class="card-title mb-1">Countrywise Sales</h6>
										<p class="text-muted mb-0 card-sub-title">Nemo enim ipsam voluptatem fugit sequi
											nesciunt.</p>
									</div>
								</div>
								<div class="country-sales scroll-widget bd-t">
									<div class="list-group">
										<div class="list-group-item  d-flex border-end-0 border-start-0 border-top-0">
											<i class="flag-icon flag-us flag-icon-squared"></i>
											<p class="ms-3 mb-0">United States</p>
											<span class="ms-auto font-weight-bold">$12,897</span>
										</div>
										<div class="list-group-item d-flex border-end-0 border-start-0">
											<i class="flag-icon flag-nl flag-icon-squared"></i>
											<p class="ms-3 mb-0">Netherlands</p>
											<span class="ms-auto font-weight-bold">$11,789</span>
										</div>
										<div class="list-group-item d-flex border-end-0 border-start-0">
											<i class="flag-icon flag-gb flag-icon-squared"></i>
											<p class="ms-3 mb-0">United Kingdom</p>
											<span class="ms-auto font-weight-bold">$10,234</span>
										</div>
										<div class="list-group-item d-flex border-end-0 border-start-0">
											<i class="flag-icon flag-ca flag-icon-squared"></i>
											<p class="ms-3 mb-0">Canada</p>
											<span class="ms-auto font-weight-bold">$9,104</span>
										</div>
										<div class="list-group-item d-flex border-end-0 border-start-0">
											<i class="flag-icon flag-au flag-icon-squared"></i>
											<p class="ms-3 mb-0">Australia</p>
											<span class="ms-auto font-weight-bold">$16,205</span>
										</div>
										<div class="list-group-item d-flex border-end-0 border-start-0">
											<i class="flag-icon flag-si flag-icon-squared"></i>
											<p class="ms-3 mb-0">Slovenia</p>
											<span class="ms-auto font-weight-bold">$18,165</span>
										</div>
										<div class="list-group-item d-flex border-end-0 border-start-0 rounded-0">
											<i class="flag-icon flag-de flag-icon-squared"></i>
											<p class="ms-3 mb-0">Denmark</p>
											<span class="ms-auto font-weight-bold">$19,765</span>
										</div>
										<div class="list-group-item d-flex border-end-0 border-start-0">
											<i class="flag-icon flag-si flag-icon-squared"></i>
											<p class="ms-3 mb-0">Slovenia</p>
											<span class="ms-auto font-weight-bold">$18,165</span>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Row -->

					<!-- Row-->
					<div class="row">
						<div class="col-sm-12 col-xl-12 col-lg-12">
							<div class="card custom-card">
								<div class="card-body">
									<div>
										<h6 class="card-title mb-1">Product Summary</h6>
										<p class="text-muted card-sub-title mb-2">Nemo enim ipsam voluptatem fugit sequi
											nesciunt.</p>
									</div>
									<div class="table-responsive br-3">
										<table class="table table-bordered text-nowrap mb-0">
											<thead>
												<tr>
													<th>#No</th>
													<th>Client Name</th>
													<th>Product ID</th>
													<th>Product</th>
													<th>Product Cost</th>
													<th>Payment Mode</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>#01</td>
													<td>Sean Black</td>
													<td>PRO12345</td>
													<td>Mi LED Smart TV 4A 80</td>
													<td>$14,500</td>
													<td>Online Payment</td>
													<td><span class="badge bg-success">Delivered</span></td>
												</tr>
												<tr>
													<td>#02</td>
													<td>Evan Rees</td>
													<td>PRO8765</td>
													<td>Thomson R9 122cm (48 inch) Full HD LED TV </td>
													<td>$30,000</td>
													<td>Cash on delivered</td>
													<td><span class="badge bg-primary">Add Cart</span></td>
												</tr>
												<tr>
													<td>#03</td>
													<td>David Wallace</td>
													<td>PRO54321</td>
													<td>Vu 80cm (32 inch) HD Ready LED TV</td>
													<td>$13,200</td>
													<td>Online Payment</td>
													<td><span class="badge bg-secondary">Pending</span></td>
												</tr>
												<tr>
													<td>#04</td>
													<td>Julia Bower</td>
													<td>PRO97654</td>
													<td>Micromax 81cm (32 inch) HD Ready LED TV</td>
													<td>$15,100</td>
													<td>Cash on delivered</td>
													<td><span class="badge bg-info">Delivering</span></td>
												</tr>
												<tr>
													<td>#05</td>
													<td>Kevin James</td>
													<td>PRO4532</td>
													<td>HP 200 Mouse &amp; Wireless Laptop Keyboard </td>
													<td>$5,987</td>
													<td>Online Payment</td>
													<td><span class="badge bg-danger">Shipped</span></td>
												</tr>
												<tr>
													<td>#06</td>
													<td>Theresa Wright</td>
													<td>PRO6789</td>
													<td>Digisol DG-HR3400 Router </td>
													<td>$11,987</td>
													<td>Cash on delivered</td>
													<td><span class="badge bg-secondary">Delivering</span></td>
												</tr>
												<tr>
													<td>#07</td>
													<td>Sebastian Black</td>
													<td>PRO4567</td>
													<td>Dell WM118 Wireless Optical Mouse</td>
													<td>$4,700</td>
													<td>Online Payment</td>
													<td><span class="badge bg-info">Add to Cart</span></td>
												</tr>
												<tr>
													<td>#08</td>
													<td>Kevin Glover</td>
													<td>PRO32156</td>
													<td>Dell 16 inch Laptop Backpack </td>
													<td>$678</td>
													<td>Cash On delivered</td>
													<td><span class="badge bg-success">Delivered</span></td>
												</tr>
											</tbody>
										</table>
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
		document.addEventListener('DOMContentLoaded', function() {
			// Function to generate a random color in hexadecimal format
			function getRandomColor() {
				return '#' + Math.floor(Math.random() * 16777215).toString(16);
			}

			// Set random colors to CSS variables
			document.documentElement.style.setProperty('--random-event-bg-color', getRandomColor());
			document.documentElement.style.setProperty('--random-event-border-color', getRandomColor());

			var calendarEl = document.getElementById('calendar');

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
								Swal.fire('Error fetching values from the database', '', 'error');
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
		
						html: '<input id="eventtitle" class="swal2-input" placeholder="Event name" style="width: 84%;" value="' + title + '" readonly>' +
							'<textarea id="eventdescription" class="swal2-input" placeholder="Event description" style="width: 84%; height: 100px;font-size:15px;">' + description + '</textarea>',
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
	</script>
</body>

</html>