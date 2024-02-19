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
	<meta name="description" content="Dashlead - Admin Panel HTML Dashboard Template">
	<meta name="author" content="Spruko Technologies Private Limited">
	<meta name="keywords" content="sales dashboard, admin dashboard, bootstrap 5 admin template, html admin template, admin panel design, admin panel design, bootstrap 5 dashboard, admin panel template, html dashboard template, bootstrap admin panel, sales dashboard design, best sales dashboards, sales performance dashboard, html5 template, dashboard template">

	<!-- Favicon -->
	<link rel="icon" href="../assets/img/brand/favicon.ico" type="image/x-icon">

	<!-- Title -->
	<title>Dashlead - Admin Panel HTML Dashboard Template</title>

	<!---bootstrap css-->
	<link id="style" href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!--- FONT-ICONS CSS -->
	<link href="../assets/css/icons.css" rel="stylesheet">

	<!---Style css-->
	<link href="../assets/css/style.css" rel="stylesheet">

	<!---Plugins css-->
	<link href="../assets/css/plugins.css" rel="stylesheet">

	<!-- Switcher css -->
	<!-- <link href="../assets/switcher/css/switcher.css" rel="stylesheet">
	<link href="../assets/switcher/demo.css" rel="stylesheet"> -->

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
			<!--Main Header -->
			<?php include 'includes/header.php'; ?>
			<!-- End Sidemenu -->
		</div>
		<!-- Main Content-->
		<div class="main-content side-content pt-0">
			<div class="side-app">

				<div class="main-container container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div>
							<h2 class="main-content-title tx-24 mg-b-5">Calendar</h2>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
								<li class="breadcrumb-item active" aria-current="page">Assign Works using Calendar</li>
							</ol>
						</div>
						<div class="btn-list">
							<a class="btn ripple btn-primary" href="javascript:void(0);"><i class="fe fe-external-link"></i> Export</a>
							<a class="btn ripple btn-secondary" href="javascript:void(0);"><i class="fe fe-download"></i> Download</a>
							<a class="btn ripple btn-info" href="javascript:void(0);"><i class="fe fe-help-circle"></i> Help</a>
							<a class="btn ripple btn-danger dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								<i class="fe fe-settings"></i> Settings <i class="fa fa-caret-down ms-1"></i>
							</a>
							<div class="dropdown-menu tx-13">
								<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-eye me-2 float-start"></i>View</a>
								<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-plus-circle me-2 float-start"></i>Add</a>
								<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-mail me-2 float-start"></i>Email</a>
								<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-folder-plus me-2 float-start"></i>Save</a>
								<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-trash-2 me-2 float-start"></i>Remove</a>
								<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-settings me-2 float-start"></i>More</a>
							</div>
						</div>
					</div>
					<!-- End Page Header -->

					<!-- Row -->
					<div class="row sidemenu-height">
						<div class="col-lg-12">
							<div class="card custom-card">
								<div class="card-body">
									<div class="container">
										<?php
										$currentData = date('Y-m-d');
										?>

										<!-- Calendar Container -->
										<div id='calendar-container'>
											<div id='calendar'></div>
										</div>
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

		<!-- Sidebar -->
		<?php include 'includes/footer.php'; ?>
		<!--End Footer-->


	</div>
	<!-- End Page -->

	<!-- Back-to-top -->
	<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

	<!-- Jquery js-->
	<script src="../assets/plugins/jquery/jquery.min.js"></script>

	<!-- Bootstrap js-->
	<script src="../assets/plugins/bootstrap/popper.min.js"></script>
	<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

	<!-- Perfect-scrollbar js-->
	<script src="../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="../assets/plugins/perfect-scrollbar/p-scroll-1.js"></script>

	<!-- Sidemenu js-->
	<script src="../assets/plugins/sidemenu/sidemenu.js"></script>

	<!-- Sidebar js-->
	<script src="../assets/plugins/sidebar/sidebar.js"></script>

	<!-- Sticky js-->
	<script src="../assets/js/sticky.js"></script>

	<!-- Custom-Switcher js -->
	<!-- <script src="../assets/js/custom-switcher.js"></script> -->

	<!-- Custom js-->
	<script src="../assets/js/custom.js"></script>

	<!-- Switcher js -->
	<!-- <script src="../assets/switcher/js/switcher.js"></script> -->
	<script src="notification.js"></script>


	<!-- jQuery -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->

	<!-- Fullcalendar  -->
	<script type="text/javascript" src="fullcalendar/dist/index.global.min.js"></script>

	<!-- Sweetalert -->
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
								// ===================alert box start======================
								// Alert box to add event
								// Create an array of options for the select box
								var selectOptions = response.values.map(function(item) {
									return '<option value="' + item.id + '" data-orderid="' + item.orderid + '">' + item.brandName + '</option>';
								});

								// Create an array of options for the second select box
								var selectOptions2 = '<option value="" disabled selected>Select Paid/Not</option><option value="no">No</option><option value="yes">Yes</option>';

								Swal.fire({
									title: 'Add New Work',
									showCancelButton: true,
									confirmButtonText: 'Create',
									html:

										'<input id="eventtitle" class="swal2-input" placeholder="Posting name" style="width: 84%;font-size:15px"  ><br>' +
										'<textarea id="eventdescription" class="swal2-input" placeholder="description" style="width: 84%; height: 60px;"></textarea>' +
										'<select id="eventSelect" class="swal2-input" style="width: 84%;">' + selectOptions.join('') + '</select>' +
										'<select id="eventSelect2" class="swal2-input" style="width: 84%;">' + selectOptions2 + '</select>',

									focusConfirm: false,
									preConfirm: () => {
										var selectedOption = document.getElementById('eventSelect');
										var orderId = selectedOption.options[selectedOption.selectedIndex].getAttribute('data-orderid');

										return [
											document.getElementById('eventtitle').value,
											document.getElementById('eventdescription').value,
											document.getElementById('eventSelect').value,
											document.getElementById('eventSelect2').value,
											orderId
										]
									}
								}).then((result) => {

									if (result.isConfirmed) {

										var title = result.value[0].trim();
										var description = result.value[1].trim();
										var dmallotid = result.value[2].trim();
										var paidornot = result.value[3].trim();
										var orderid = result.value[4].trim();
										var start_date = arg.startStr;
										var end_date = arg.endStr;


										if (title != '' && description != '') {

											// AJAX - Add event
											$.ajax({
												url: 'ajaxfile.php',
												type: 'post',
												data: {
													request: 'addEvent',
													title: title,
													description: description,
													start_date: start_date,
													end_date: end_date,
													orderid: orderid,
													dmallotid: dmallotid,
													paidornot: paidornot
												},
												dataType: 'json',
												success: function(response) {

													if (response.status == 1) {

														// Add event
														calendar.addEvent({
															eventid: response.eventid,
															title: title,
															description: description,
															orderid: orderid,
															dmallotid: dmallotid,
															paidornot: paidornot,
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
										}

									}
								})
								// ===============alert box end =======================

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


					var eventid = arg.event._def.extendedProps.eventid;
					var description = arg.event._def.extendedProps.description;
					var orderid = arg.event._def.extendedProps.orderid;
					var dmallotid = arg.event._def.extendedProps.dmallotid;
					var beforeinfo = arg.event._def.extendedProps.beforeinfo;
					var executed = arg.event._def.extendedProps.executed;
					var afterinfo = arg.event._def.extendedProps.afterinfo;
					var title = arg.event._def.title;


					Swal.fire({
						title: 'View & Edit Event',
						showDenyButton: true,
						showCancelButton: true,
						confirmButtonText: 'Update',
						denyButtonText: 'Delete',
						html: '<input id="eventtitle" class="swal2-input" placeholder="Event name" style="width: 84%;" value="' + title + '">' +
							'<textarea id="eventdescription" class="swal2-input" placeholder="Event description" style="width: 84%; height: 60px;">' + description + '</textarea>' +
							'<label><input type="checkbox" id="checkbox1" value="Informed-Before" ' + (beforeinfo ? 'checked' : '') + '> Informed Customer Before</label><br>' +
							'<label><input type="checkbox" id="checkbox2" value="Executed" ' + (executed ? 'checked' : '') + '> Executed</label><br>' +
							'<label><input type="checkbox" id="checkbox3" value="Informed-After" ' + (afterinfo ? 'checked' : '') + '> Informed Customer After</label><br>',

						focusConfirm: false,
						preConfirm: () => {
							const eventTitle = document.getElementById('eventtitle').value;
							const eventDescription = document.getElementById('eventdescription').value;

							const checkbox1 = document.getElementById('checkbox1').checked;
							const checkbox2 = document.getElementById('checkbox2').checked;
							const checkbox3 = document.getElementById('checkbox3').checked;

							return [
								eventTitle,
								eventDescription,
								checkbox1 ? 'Informed-Before' : null,
								checkbox2 ? 'Executed' : null,
								checkbox3 ? 'Informed-After' : null
							]

							// return [
							// 	document.getElementById('eventtitle').value,
							// 	document.getElementById('eventdescription').value
							// ]
						}
					}).then((result) => {

						if (result.isConfirmed) {

							var newTitle = result.value[0].trim();
							var newDescription = result.value[1].trim();
							var beforeinfo = result.value[2];
							var executed = result.value[3];
							var afterinfo = result.value[4];

							if (newTitle != '' && newDescription != '') {

								$.ajax({
									url: 'ajaxfile.php',
									type: 'post',
									data: {
										request: 'editEvent',
										eventid: eventid,
										title: newTitle,
										description: newDescription,
										beforeinfo: beforeinfo,
										executed: executed,
										afterinfo: afterinfo
									},
									dataType: 'json',
									async: false,
									success: function(response) {

										if (response.status == 1) {

											calendar.refetchEvents();
											Swal.fire(response.message, '', 'success');
										} else {
											Swal.fire(response.message, '', 'error');
										}

									}
								});
							}

						} else if (result.isDenied) { // Delete

							// AJAX - Delete Event
							$.ajax({
								url: 'ajaxfile.php',
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