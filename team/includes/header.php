<?php
// session_start();

// Check if the 'adminname' session variable is set before using it
$empname = isset($_SESSION['empname']) ? $_SESSION['empname'] : '';
$empid = isset($_SESSION['empid']) ? $_SESSION['empid'] : '';
$deptid = isset($_SESSION['deptid']) ? $_SESSION['deptid'] : '';
$modulename = isset($_SESSION['modulename']) ? $_SESSION['modulename'] : '';

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
<!--Main Header -->
<div class="main-header side-header sticky">
	<div class="container-fluid main-container">
		<div class="main-header-left sidemenu">
			<a class="main-header-menu-icon" href="javascript:void(0);" data-bs-toggle="sidebar" id="mainSidebarToggle"><span></span></a>
		</div>
		<div class="main-header-left horizontal">
			<a class="main-logo" href="index.php">
				<img src="../assets/img/SLogoBlue.png" class="desktop-logo desktop-logo-dark" alt="dashleadlogo">
				<img src="../assets/img/SLogoBlue.png" class="desktop-logo theme-logo" alt="dashleadlogo">
			</a>
		</div>
		<div class="main-header-right">
			<button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon fe fe-more-vertical"></span>
			</button>
			<div class="navbar navbar-expand-lg navbar-collapse responsive-navbar p-0">
				<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
					<ul class="nav nav-item header-icons navbar-nav-right ms-auto">

						<!-- Theme-Layout -->
						<li class="dropdown  d-flex">
							<a class="nav-link icon theme-layout nav-link-bg layout-setting" href="javascript:void(0);">
								<span class="dark-layout"><i class="fe fe-moon"></i></span>
								<span class="light-layout"><i class="fe fe-sun"></i></span>
							</a>
						</li>


						<!-- FULL SCREEN -->
						<li class="dropdown">
							<a class="nav-link icon full-screen-link" href="javascript:void(0);">
								<i class="fe fe-maximize fullscreen-button"></i>
							</a>
						</li>
						<!-- FULL SCREEN -->
						<style>
							.notify-click .header-badge {
								position: absolute;
								top: -2px;
								right: 2px;
								display: block !important;
								padding: 3px 5px !important;
								font-size: 10px;
								border-radius: 50px;
								line-height: 1.1;
							}
						</style>
						<li class="dropdown main-header-notification ">

							<a class="nav-link icon notify-click" data-bs-toggle="dropdown">
								<i class="fe fe-bell"></i>
								<span class="badge bg-secondary header-badge count">0</span>
								<!-- <span class="pulse bg-danger"></span> -->
							</a>
							<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifymenu">

							</div>

						</li>
						<li class="dropdown main-profile-menu">
							<?php
							$query = "select * from employee where id = '" . $_SESSION['empid'] . "'";
							$select_posts = mysqli_query($connection, $query);

							while ($row = mysqli_fetch_assoc($select_posts)) {

								if (isset($row['emppic']) && $row['emppic'] !== "") {

							?>
									<a class="main-img-user" href="javascript:void(0);" data-bs-toggle="dropdown"><img alt="avatar" src="../assets/img/staff/<?php echo $row['emppic']; ?>"></a>

								<?php	} else {

									$colors = array('bg-pink', 'bg-blue', 'bg-green', 'bg-purple', 'bg-orange', 'bg-primary', 'bg-cyan', 'bg-success');

									// Choose a random color from the array
									$randomColor = $colors[array_rand($colors)];
								?>
									<!-- <a class="main-img-user" href="javascript:void(0);" data-bs-toggle="dropdown"><img alt="avatar" src="../assets/img/users/avatar.png"></a> -->
									<a class="main-img-user" href="javascript:void(0);" data-bs-toggle="dropdown">
										<div class="avatar avatar-sm <?php echo $randomColor; ?> tx-fixed-white">
											<?php echo strtoupper(substr($empname, 0, 1)); ?>
										</div>
									</a>
							<?php  }
							} ?>
							<div class="dropdown-menu">
								<div class="header-navheading">
									<h6 class="main-notification-title"><?php echo strtoupper($empname); ?></h6>
									<p class="main-notification-text"><?php echo "Emp Id : " . $empid; ?></p>
									<p class="main-notification-text"><?php echo "Dept Id : " . $deptid; ?></p>
									<!-- <p class="main-notification-text"><?php echo "Module name : " . $modulename; ?></p> -->
								</div>
								<!-- <a class="dropdown-item border-top text-wrap" href="">
									<i class="fe fe-user"></i> My Profile
								</a>
								<a class="dropdown-item text-wrap" href="">
									<i class="fe fe-edit"></i> Edit Profile
								</a> -->

								<a class="dropdown-item border-top text-wrap" href="./index.php?logout=1">
									<i class="fe fe-power"></i> Sign Out
								</a>
							</div>
						</li>
						<li class="dropdown header-settings">
							<!-- <a href="javascript:void(0);" class="nav-link icon" data-bs-toggle="sidebar-right" data-bs-target=".sidebar-right">
								<i class="fe fe-align-right"></i>
							</a> -->
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Main Header -->

<!-- Sidemenu -->
<div class="sticky">
	<aside class="app-sidebar ps horizontal-main">
		<div class="app-sidebar__header">
			<a class="main-logo" href="index.php">
				<img src="../assets/img/SLogoBlue.png" class="desktop-logo desktop-logo-dark" alt="dashleadlogo">
				<img src="../assets/img/SLogoWhite.png" class="desktop-logo" alt="dashleadlogo">

			</a>
		</div>
		<div class="main-sidemenu">
			<div class="slide-left disabled" id="slide-left">
				<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
					<path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
				</svg>
			</div>
			<ul class="side-menu">
				<li class="side-item side-item-category">Crew Dashboard</li>
				<li class="slide">
					<a class="side-menu__item" data-bs-toggle="slide" href="index.php">
						<span class="side-menu__icon">
							<i class="fe fe-airplay side_menu_img"></i>
						</span>
						<span class="side-menu__label">Dashboard</span>
					</a>
				</li>
				<?php if ($_SESSION['modulename'] == "Sales") { ?>
					<li class="side-item side-item-category">Leads</li>
					<li class="slide">
						<a class="side-menu__item" data-bs-toggle="slide" href="add-lead.php">
							<span class="side-menu__icon"><i class="fe fe-box side_menu_img"></i></span>
							<span class="side-menu__label">Add Lead</span>
						</a>

					</li>
					<li class="slide">
						<a class="side-menu__item" data-bs-toggle="slide" href="add-followup.php">
							<span class="side-menu__icon"><i class="fe fe-zap side_menu_img"></i></span>
							<span class="side-menu__label">Add Lead Follow-up</span>
						</a>

					</li>
					<li class="slide">
						<a class="side-menu__item" data-bs-toggle="slide" href="leadlist.php">
							<span class="side-menu__icon"><i class="fe fe-award side_menu_img"></i></span>
							<span class="side-menu__label">Leads List</span>
						</a>

					</li>
				<?php } ?>
				<?php if ($_SESSION['modulename'] == "Digital") { ?>
					<li class="side-item side-item-category">Work Shedules</li>
					<li class="slide">
						<a class="side-menu__item" data-bs-toggle="slide" href="dmworklist.php">
							<span class="side-menu__icon"><i class="fe fe-box side_menu_img"></i></span>
							<span class="side-menu__label">Works Assigned</span>
						</a>
						<a class="side-menu__item" data-bs-toggle="slide" href="calendar.php">
							<span class="side-menu__icon"><i class="fe fe-calendar side_menu_img"></i></span>
							<span class="side-menu__label">Calendar Assigning</span>
						</a>
						<a class="side-menu__item" data-bs-toggle="slide" href="add-Graphics-Staff-details.php">
							<span class="side-menu__icon"><i class="fe fe-award side_menu_img"></i></span>
							<span class="side-menu__label">Assign Graphics Work</span>
						</a>

					</li>
				<?php } ?>

				<?php if ($_SESSION['modulename'] == "Web") { ?>
					<li class="side-item side-item-category">Work Shedules</li>
					<li class="slide">
						<a class="side-menu__item" data-bs-toggle="slide" href="worklist.php">
							<span class="side-menu__icon"><i class="fe fe-box side_menu_img"></i></span>
							<span class="side-menu__label">Works Assigned</span>
						</a>
						<!-- <a class="side-menu__item" data-bs-toggle="slide" href="calendar.php">
						<span class="side-menu__icon"><i class="fe fe-calendar side_menu_img"></i></span>
						<span class="side-menu__label">Calendar Assigning</span>
					</a> -->

					</li>
				<?php } ?>
				<?php if ($_SESSION['modulename'] == "Graphics") { ?>
					<li class="side-item side-item-category">Work Shedules</li>
					<li class="slide">
						<a class="side-menu__item" data-bs-toggle="slide" href="worklist.php">
							<span class="side-menu__icon"><i class="fe fe-box side_menu_img"></i></span>
							<span class="side-menu__label">Admin Assigned Works</span>
						</a>
						<?php
						$sql = "SELECT * FROM department where dname='Graphics'";
						$result = $connection->query($sql);
						if ($result->num_rows > 0) {
							while ($rowdept = $result->fetch_assoc()) {
								$sqlemp = "SELECT * FROM employee where department_id='" . $rowdept['id']  . "'  and id='" . $empid . "'";
								$resultemp = $connection->query($sqlemp);
								if ($resultemp->num_rows > 0) {
									while ($rowemp = $resultemp->fetch_assoc()) {
										$hod = $rowemp['hod'];
										if ($hod === "Yes") {
						?>
											<a class="side-menu__item" data-bs-toggle="slide" href="gdworklist.php">
												<span class="side-menu__icon"><i class="fe fe-calendar side_menu_img"></i></span>
												<span class="side-menu__label">DM Assigned Works</span>
											</a>

										<?php
										} elseif ($hod === "") {
										?>
											<a class="side-menu__item" data-bs-toggle="slide" href="gdsubworklist.php">
												<span class="side-menu__icon"><i class="fe fe-calendar side_menu_img"></i></span>
												<span class="side-menu__label">DM Assigned Works</span>
											</a>
						<?php


										}
									}
								}
							}
						}


						?>



					</li>
				<?php } ?>
				<!-- <li class="slide">
						<a class="side-menu__item" data-bs-toggle="slide" href="usermanuel.php">
							<span class="side-menu__icon"><i class="fe fe-box side_menu_img"></i></span>
							<span class="side-menu__label">User Manuel</span>
						</a>
					

					</li> -->

			</ul>
			<div class="slide-right" id="slide-right">
				<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
					<path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
				</svg>
			</div>
		</div>
	</aside>
</div>
<!-- End Sidemenu -->