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
						<li class="dropdown main-header-notification">
							<a class="nav-link icon" href="javascript:void(0);" data-bs-toggle="dropdown">
								<i class="fe fe-bell"></i>
								<span class="pulse bg-danger"></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
								<div class="header-navheading d-flex border-bottom mb-0">
									<h5 class="fw-semibold mb-0 mt-1">Notifications(3)</h5>
									<a class="btn ripple btn-primary btn-sm ms-auto" href="javascript:void(0);">Mark all as Read</a>
								</div>
								<div class="header-dropdown-list notification-list">

								</div>
								<div class="dropdown-footer">
									<a class="btn ripple btn-success btn-sm btn-block" href="mail-inbox.html">View All Notifications</a>
								</div>
							</div>
						</li>
						<li class="dropdown main-profile-menu">
							<?php
							$query = "select * from employee where id = '" . $_SESSION['empid'] . "'";
							$select_posts = mysqli_query($connection, $query);

							while ($row = mysqli_fetch_assoc($select_posts)) {
								if (isset($row['emppic'])) {
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
											<?php echo strtoupper(substr($_SESSION['adminname'], 0, 1)); ?>
										</div>
									</a>
							<?php  }
							} ?>
							<div class="dropdown-menu">
								<div class="header-navheading">
									<h6 class="main-notification-title"><?php echo strtoupper($_SESSION['salesname']); ?></h6>
									<p class="main-notification-text"><?php echo "Emp Id : " . $_SESSION['salesempid']; ?></p>
									<p class="main-notification-text"><?php echo "Dept Id : " . $_SESSION['deptid']; ?></p>
									<p class="main-notification-text"><?php echo "Module name : " . $_SESSION['modulename']; ?></p>
								</div>
								<a class="dropdown-item border-top text-wrap" href="">
									<i class="fe fe-user"></i> My Profile
								</a>
								<a class="dropdown-item text-wrap" href="">
									<i class="fe fe-edit"></i> Edit Profile
								</a>

								<a class="dropdown-item text-wrap" href="./index.php?logout=1">
									<i class="fe fe-power"></i> Sign Out
								</a>
							</div>
						</li>
						<li class="dropdown header-settings">
							<a href="javascript:void(0);" class="nav-link icon" data-bs-toggle="sidebar-right" data-bs-target=".sidebar-right">
								<i class="fe fe-align-right"></i>
							</a>
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
				<img src="../assets/img/SLogoBlue.png" class="desktop-logo" alt="dashleadlogo">
				<!-- <img src="../assets/img/brand/favicon.png" class="mobile-logo mobile-logo-dark" alt="dashleadlogo">
							<img src="../assets/img/brand/favicon1.png" class="mobile-logo" alt="dashleadlogo"> -->
			</a>
		</div>
		<div class="main-sidemenu">
			<div class="slide-left disabled" id="slide-left">
				<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
					<path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
				</svg>
			</div>
			<ul class="side-menu">
				<li class="side-item side-item-category">Sales Dashboard</li>
				<li class="slide">
					<a class="side-menu__item" data-bs-toggle="slide" href="index.php">
						<span class="side-menu__icon">
							<i class="fe fe-airplay side_menu_img"></i>
						</span>
						<span class="side-menu__label">Dashboard</span>
					</a>
				</li>
				<li class="side-item side-item-category">Leads</li>
				<li class="slide">
					<a class="side-menu__item" data-bs-toggle="slide" href="add-lead.php">
						<span class="side-menu__icon"><i class="fe fe-box side_menu_img"></i></span>
						<span class="side-menu__label">Add Lead</span>
					</a>
					<!-- <ul class="slide-menu">
						<li class="panel sidetab-menu">
							<div class="tab-menu-heading p-0 pb-2 border-0">
								<div class="tabs-menu ">
									<ul class="nav panel-tabs">
										<li><a href="#side5" class="active" data-bs-toggle="tab"><i class="bi bi-house"></i>
												<p>Home</p>
											</a></li>
									
									</ul>
								</div>
							</div>
							<div class="panel-body tabs-menu-body p-0 border-0">
								<div class="tab-content">
									<div class="tab-pane active" id="side5">
										<ul class="sidemenu-list">
											<li class="side-menu__label1"><a href="javascript:void(0)">Apps</a></li>
											<li class="sub-slide">
												<a class="slide-item side-menu__item-sub" data-bs-toggle="sub-slide" href="javascript:void(0)">
													<span class="sub-side-menu__label">Mail</span>
													<i class="sub-angle fe fe-chevron-down"></i>
												</a>
												<ul class="sub-slide-menu">
													<li><a class="sub-side-menu__item" href="mail-inbox.html">Mail Inbox</a></li>
													<li><a class="sub-side-menu__item" href="mail-compose.html">Mail compose</a></li>
													<li><a class="sub-side-menu__item" href="view-mail.html">Mail View</a></li>
												</ul>
											</li>
											<li><a href="chat.html" class="slide-item">Chat</a></li>
											<li><a href="cards.html" class="slide-item">Cards</a></li>
											<li><a href="treeview.html" class="slide-item">Treeview</a></li>
											<li><a href="contacts.html" class="slide-item">Contacts</a></li>
											<li><a href="default-calendar.html" class="slide-item">Default Calendar</a></li>
											<li><a href="full-calendar.html" class="slide-item">Full Calendar</a></li>
											<li><a href="notifications.html" class="slide-item">Notifications</a></li>
											<li><a href="range-slider.html" class="slide-item">Range Sliders</a></li>
											<li><a href="footer.html" class="slide-item">Footers</a></li>
											<li><a href="crypto-currencies.html" class="slide-item">Crypto Currencies</a></li>
											<li><a href="colors.html" class="slide-item">Colors</a></li>
											<li><a href="offcanvas.html" class="slide-item">Offcanvas</a></li>
											<li><a href="gallery.html" class="slide-item">Gallery</a></li>
											<li><a href="services.html" class="slide-item">Services</a></li>
											<li><a href="settings.html" class="slide-item">Settings</a></li>
											<li><a href="switcher.html" class="slide-item">Switcher</a></li>
										</ul>
										<div class="menutabs-content">
											<h5 class="my-4 px-1 text-default">Activites</h5>
											<div class="">
												<div class="card">
													<div class="card-body p-3">
														<div class="d-flex">
															<div class="pe-3">
																<span class="avatar avatar-md rounded-circle bg-secondary-transparent text-secondary fs-18">
																	<i class="fa fa-dollar"></i>
																</span>
															</div>
															<div class="text-default">
																<span>Revenue</span>
																<h3 class="mb-0 fs-20">$459.2</h3>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="mt-3">
												<div class="card">
													<div class="card-body p-3">
														<div class="d-flex">
															<div class="pe-3">
																<span class="avatar avatar-md rounded-circle bg-info-transparent text-info fs-18">
																	<i class="fa fa-files-o"></i>
																</span>
															</div>
															<div class="text-default">
																<span>Sales</span>
																<h3 class="mb-0 fs-20">487</h3>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="mt-3">
												<div class="card">
													<div class="card-body p-3">
														<div class="d-flex">
															<div class="pe-3">
																<span class="avatar avatar-md rounded-circle bg-success-transparent text-success fs-18">
																	<i class="fa fa-handshake-o"></i>
																</span>
															</div>
															<div class="text-default">
																<span>Deals</span>
																<h3 class="mb-0 fs-20">158</h3>
															</div>
														</div>
													</div>
												</div>
											</div>
											<h5 class="my-4 px-1 text-default">Contacts</h5>
											<div class="card-body p-0">
												<div class="list-group list-group-flush">
													<div class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<span class="avatar rounded-circle cover-image" data-image-src="../assets/img/users/12.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Mozelle</div>
														</div>
														<div class="ms-auto"> <a href="javascript:void(0);" class="btn btn-sm btn-light box-shadow-0">
																<i class="fa fa-phone fs-10"></i>
															</a>
														</div>
													</div>
													<div class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<span class="avatar rounded-circle cover-image" data-image-src="../assets/img/users/11.jpg"></span>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Florinda</div>
														</div>
														<div class="ms-auto">
															<a href="javascript:void(0);" class="btn btn-sm btn-light box-shadow-0">
																<i class="fa fa-phone fs-10"></i>
															</a>
														</div>
													</div>
													<div class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<span class="avatar rounded-circle cover-image" data-image-src="../assets/img/users/5.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">lina Bernie</div>
														</div>
														<div class="ms-auto">
															<a href="javascript:void(0);" class="btn btn-sm btn-light box-shadow-0">
																<i class="fa fa-phone fs-10"></i>
															</a>
														</div>
													</div>
													<div class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<span class="avatar rounded-circle cover-image" data-image-src="../assets/img/users/2.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Mclaughin</div>
														</div>
														<div class="ms-auto">
															<a href="javascript:void(0);" class="btn btn-sm btn-light box-shadow-0">
																<i class="fa fa-phone fs-10"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
											<h5 class="my-4 px-1 text-default">Followers</h5>
											<div class="">
												<span class="avatar rounded-circle avatar-md cover-image m-1" data-image-src="../assets/img/users/3.jpg">
													<span class="avatar-status bg-green"></span>
												</span>
												<span class="avatar rounded-circle avatar-md cover-image m-1" data-image-src="../assets/img/users/6.jpg">
													<span class="avatar-status bg-green"></span>
												</span>
												<span class="avatar rounded-circle avatar-md cover-image m-1" data-image-src="../assets/img/users/3.jpg">
													<span class="avatar-status bg-warning"></span>
												</span>
												<span class="avatar rounded-circle avatar-md cover-image m-1" data-image-src="../assets/img/users/4.jpg">
													<span class="avatar-status bg-green"></span>
												</span>
												<span class="avatar rounded-circle avatar-md cover-image m-1" data-image-src="../assets/img/users/9.jpg">
													<span class="avatar-status bg-warning"></span>
												</span>
												<span class="avatar rounded-circle avatar-md cover-image m-1 bg-success text-white">+34</span>
											</div>
										</div>
									</div>
								
								</div>
							</div>
						</li>

					</ul> -->
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
					<!-- <ul class="slide-menu">
						<li class="panel sidetab-menu">
							<div class="tab-menu-heading p-0 pb-2 border-0">
								<div class="tabs-menu ">
									<ul class="nav panel-tabs">
										<li><a href="#side8" class="active" data-bs-toggle="tab"><i class="bi bi-house"></i>
												<p>Home</p>
											</a></li>
										
									</ul>
								</div>
							</div>
							<div class="panel-body tabs-menu-body p-0 border-0">
								<div class="tab-content">
									<div class="tab-pane active" id="side8">
										<ul class="sidemenu-list">
											<li class="side-menu__label1"><a href="javascript:void(0)">Icons</a></li>
											<li><a href="icons.html" class="slide-item">Fontawesome Icons</a></li>
											<li><a href="icons-2.html" class="slide-item">Ionicons Icons</a></li>
											<li><a href="typ-icons.html" class="slide-item">Typicon Icons</a></li>
											<li><a href="feather-icons.html" class="slide-item">Feather Icons</a></li>
											<li><a href="material-icons.html" class="slide-item">MaterialDesign Icons</a></li>
											<li><a href="simple-icons.html" class="slide-item">Simpleline Icons</a></li>
											<li><a href="pe7-icons.html" class="slide-item">Pe7 Icons</a></li>
											<li><a href="themify-icons.html" class="slide-item">Themify Icons</a></li>
											<li><a href="weather-icons.html" class="slide-item">Weather Icons</a></li>
											<li><a href="bootstrap-icons.html" class="slide-item">Bootstrap Icons</a></li>
											<li><a href="flags-icons.html" class="slide-item">Flag Icons</a></li>
										</ul>
										<div class="menutabs-content">
											<h5 class="my-4 px-1 text-default">Activites</h5>
											<div class="">
												<div class="card">
													<div class="card-body p-3">
														<div class="d-flex">
															<div class="pe-3">
																<span class="avatar avatar-md rounded-circle bg-secondary-transparent text-secondary fs-18">
																	<i class="fa fa-dollar"></i>
																</span>
															</div>
															<div class="text-default">
																<span>Revenue</span>
																<h3 class="mb-0 fs-20">$459.2</h3>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="mt-3">
												<div class="card">
													<div class="card-body p-3">
														<div class="d-flex">
															<div class="pe-3">
																<span class="avatar avatar-md rounded-circle bg-info-transparent text-info fs-18">
																	<i class="fa fa-files-o"></i>
																</span>
															</div>
															<div class="text-default">
																<span>Sales</span>
																<h3 class="mb-0 fs-20">487</h3>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="mt-3">
												<div class="card">
													<div class="card-body p-3">
														<div class="d-flex">
															<div class="pe-3">
																<span class="avatar avatar-md rounded-circle bg-success-transparent text-success fs-18">
																	<i class="fa fa-handshake-o"></i>
																</span>
															</div>
															<div class="text-default">
																<span>Deals</span>
																<h3 class="mb-0 fs-20">158</h3>
															</div>
														</div>
													</div>
												</div>
											</div>
											<h5 class="my-4 px-1 text-default">Contacts</h5>
											<div class="card-body p-0">
												<div class="list-group list-group-flush">
													<div class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<span class="avatar rounded-circle cover-image" data-image-src="../assets/img/users/12.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Mozelle</div>
														</div>
														<div class="ms-auto"> <a href="javascript:void(0);" class="btn btn-sm btn-light box-shadow-0">
																<i class="fa fa-phone fs-10"></i>
															</a>
														</div>
													</div>
													<div class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<span class="avatar rounded-circle cover-image" data-image-src="../assets/img/users/11.jpg"></span>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Florinda</div>
														</div>
														<div class="ms-auto">
															<a href="javascript:void(0);" class="btn btn-sm btn-light box-shadow-0">
																<i class="fa fa-phone fs-10"></i>
															</a>
														</div>
													</div>
													<div class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<span class="avatar rounded-circle cover-image" data-image-src="../assets/img/users/5.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">lina Bernie</div>
														</div>
														<div class="ms-auto">
															<a href="javascript:void(0);" class="btn btn-sm btn-light box-shadow-0">
																<i class="fa fa-phone fs-10"></i>
															</a>
														</div>
													</div>
													<div class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<span class="avatar rounded-circle cover-image" data-image-src="../assets/img/users/2.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Mclaughin</div>
														</div>
														<div class="ms-auto">
															<a href="javascript:void(0);" class="btn btn-sm btn-light box-shadow-0">
																<i class="fa fa-phone fs-10"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
											<h5 class="my-4 px-1 text-default">Followers</h5>
											<div class="">
												<span class="avatar rounded-circle avatar-md cover-image m-1" data-image-src="../assets/img/users/3.jpg">
													<span class="avatar-status bg-green"></span>
												</span>
												<span class="avatar rounded-circle avatar-md cover-image m-1" data-image-src="../assets/img/users/6.jpg">
													<span class="avatar-status bg-green"></span>
												</span>
												<span class="avatar rounded-circle avatar-md cover-image m-1" data-image-src="../assets/img/users/3.jpg">
													<span class="avatar-status bg-warning"></span>
												</span>
												<span class="avatar rounded-circle avatar-md cover-image m-1" data-image-src="../assets/img/users/4.jpg">
													<span class="avatar-status bg-green"></span>
												</span>
												<span class="avatar rounded-circle avatar-md cover-image m-1" data-image-src="../assets/img/users/9.jpg">
													<span class="avatar-status bg-warning"></span>
												</span>
												<span class="avatar rounded-circle avatar-md cover-image m-1 bg-success text-white">+34</span>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</li>

					</ul> -->
				</li>

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