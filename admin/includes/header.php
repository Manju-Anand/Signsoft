<?php
// session_start();

// Check if the 'adminname' session variable is set before using it
$adminname = isset($_SESSION['adminname']) ? $_SESSION['adminname'] : '';
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
						<a class="main-logo" href="index.html">
							<img src="../assets/img/SLogoBlue.png" class="desktop-logo desktop-logo-dark" alt="dashleadlogo">
							<img src="../assets/img/SLogoWhite.png" class="desktop-logo theme-logo" alt="dashleadlogo">
						</a>
					</div>
					<div class="main-header-right">
						<button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto collapsed" type="button"
							data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
							aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
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
										<a class="nav-link icon" href="javascript:void(0);" data-bs-toggle="dropdown" >
											<i class="fe fe-bell"></i>
											<span class="pulse bg-danger"></span>
										</a>
									
									</li>
									<li class="dropdown main-profile-menu">
									<?php
										// Define an array of colors
										$colors = array('bg-pink', 'bg-blue', 'bg-green', 'bg-purple', 'bg-orange','bg-primary','bg-cyan','bg-success');

										// Choose a random color from the array
										$randomColor = $colors[array_rand($colors)];
										?>
										<!-- <a class="main-img-user" href="javascript:void(0);" data-bs-toggle="dropdown"><img alt="avatar"
												src="../assets/img/users/avatar.png"></a> -->
												<a class="main-img-user" href="javascript:void(0);" data-bs-toggle="dropdown"><div class="avatar avatar-sm <?php echo $randomColor; ?> tx-fixed-white">
														<?php echo strtoupper(substr($adminname, 0, 1)); ?>
													</div></a>
										<div class="dropdown-menu">
											<div class="header-navheading">
												<h6 class="main-notification-title"><?php echo strtoupper($adminname); ?></h6>
												<p class="main-notification-text">Administrator</p>
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
										<!-- <a href="javascript:void(0);" class="nav-link icon" data-bs-toggle="sidebar-right"
											data-bs-target=".sidebar-right">
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
						<a class="main-logo" href="index.html">
							<img src="../assets/img/SLogoBlue.png" class="desktop-logo desktop-logo-dark" alt="dashleadlogo">
							<img src="../assets/img/SLogoBlue.png" class="desktop-logo" alt="dashleadlogo">
							<img src="../assets/img/brand/favicon.png" class="mobile-logo mobile-logo-dark" alt="dashleadlogo">
							<img src="../assets/img/brand/favicon1.png" class="mobile-logo" alt="dashleadlogo">
						</a>
					</div>
					<div class="main-sidemenu">
						<div class="slide-left disabled" id="slide-left">
							<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
								<path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
							</svg>
						</div>
						<ul class="side-menu">
							<li class="side-item side-item-category">Admin Dashboard</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="index.php">
									<span class="side-menu__icon">
										<i class="fe fe-airplay side_menu_img"></i>
									</span>
									<span class="side-menu__label">Dashboard</span>
								</a>
							</li>
<?php if ($_SESSION['adminname']=='Signefo'){  ?>
							<li class="side-item side-item-category">Work Scheduling</li>
							<!-- ====================================== -->
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
									<span class="side-menu__icon"><i class="fe fe-compass side_menu_img"></i></span>
									<span class="side-menu__label">Orders</span><i class="angle fa fa-angle-right"></i>
								</a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<ul class="nav panel-tabs">
													<li><a href="#side14" class="active" data-bs-toggle="tab"><i class="bi bi-house"></i><p>Home</p></a></li>
													
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side14">
													<ul class="sidemenu-list">
														<li class="side-menu__label1"><a href="javascript:void(0)">Pages</a></li>
														<li class="sub-slide">
															<a class="slide-item side-menu__item-sub" data-bs-toggle="sub-slide" href="javascript:void(0)">
																<span class="sub-side-menu__label">External Order's</span>
																<i class="sub-angle fe fe-chevron-down"></i>
															</a>
															<ul class="sub-slide-menu">
																<li><a href="orderlist.php" class="slide-item">Order List</a></li>
																<li><a href="add-order-details.php" class="slide-item">Add Order Details</a></li>
																<li><a href="close-order.php" class="slide-item">Close Order</a></li>
															</ul>
														</li>
														<li class="sub-slide">
															<a class="slide-item side-menu__item-sub" data-bs-toggle="sub-slide" href="javascript:void(0)">
																<span class="sub-side-menu__label">Internal Order's</span>
																<i class="sub-angle fe fe-chevron-down"></i>
															</a>
															<ul class="sub-slide-menu">
																<li><a href="inorderlist.php" class="slide-item">Order List</a></li>
																<li><a href="add-inorder-details.php" class="slide-item">Add Order Details</a></li>
																<li><a href="close-inorder.php" class="slide-item">Close Order</a></li>
															</ul>
														</li>
														
														
														
													</ul>
													
												</div>
											
											</div>
										</div>
									</li>

								</ul>
							</li>
							<li class="side-item side-item-category">Masters</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
									<span class="side-menu__icon"><i class="fe fe-award side_menu_img"></i></span>
									<span class="side-menu__label">Order Settings</span><i class="angle fa fa-angle-right"></i>
								</a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<ul class="nav panel-tabs">
													<li><a href="#side8" class="active" data-bs-toggle="tab"><i class="bi bi-house"></i><p>Home</p></a></li>
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side8">
													<ul class="sidemenu-list">
														<li><a href="category.php" class="slide-item">Category</a></li>
														<li><a href="subcategory.php" class="slide-item">Subcategory</a></li>
														<li><a href="supplierslist.php" class="slide-item">Suppliers</a></li>
														<li><a href="combocategorylist.php" class="slide-item">Combo Category</a></li>
													</ul>
													
												</div>
												
											</div>
										</div>
									</li>

								</ul>
							</li>


<?php  } elseif  ($_SESSION['adminname']=='SignefoMedia'){  	?>		
	
							<li class="side-item side-item-category">Work Scheduling</li>
							<!-- ====================================== -->
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
									<span class="side-menu__icon"><i class="fe fe-compass side_menu_img"></i></span>
									<span class="side-menu__label">Orders</span><i class="angle fa fa-angle-right"></i>
								</a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<ul class="nav panel-tabs">
													<li><a href="#side14" class="active" data-bs-toggle="tab"><i class="bi bi-house"></i><p>Home</p></a></li>
													
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side14">
													<ul class="sidemenu-list">
														<li class="side-menu__label1"><a href="javascript:void(0)">Pages</a></li>
														<li class="sub-slide">
															<a class="slide-item side-menu__item-sub" data-bs-toggle="sub-slide" href="javascript:void(0)">
																<span class="sub-side-menu__label">External Order's</span>
																<i class="sub-angle fe fe-chevron-down"></i>
															</a>
															<ul class="sub-slide-menu">
																<li><a href="orderlist.php" class="slide-item">Order List</a></li>
																<li><a href="add-order-details.php" class="slide-item">Add Order Details</a></li>
																<li><a href="close-order.php" class="slide-item">Close Order</a></li>
															</ul>
														</li>
														<li class="sub-slide">
															<a class="slide-item side-menu__item-sub" data-bs-toggle="sub-slide" href="javascript:void(0)">
																<span class="sub-side-menu__label">Internal Order's</span>
																<i class="sub-angle fe fe-chevron-down"></i>
															</a>
															<ul class="sub-slide-menu">
																<li><a href="inorderlist.php" class="slide-item">Order List</a></li>
																<li><a href="add-inorder-details.php" class="slide-item">Add Order Details</a></li>
																<li><a href="close-inorder.php" class="slide-item">Close Order</a></li>
															</ul>
														</li>
														
														
														
													</ul>
													
												</div>
											
											</div>
										</div>
									</li>

								</ul>
							</li>
							<li class="side-item side-item-category">Masters</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
									<span class="side-menu__icon"><i class="fe fe-award side_menu_img"></i></span>
									<span class="side-menu__label">Order Settings</span><i class="angle fa fa-angle-right"></i>
								</a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<ul class="nav panel-tabs">
													<li><a href="#side8" class="active" data-bs-toggle="tab"><i class="bi bi-house"></i><p>Home</p></a></li>
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side8">
													<ul class="sidemenu-list">
														<li><a href="category.php" class="slide-item">Category</a></li>
														<li><a href="subcategory.php" class="slide-item">Subcategory</a></li>
														<li><a href="supplierslist.php" class="slide-item">Suppliers</a></li>
														<li><a href="combocategorylist.php" class="slide-item">Combo Category</a></li>
													</ul>
													
												</div>
												
											</div>
										</div>
									</li>

								</ul>
							</li>





	<?php  } else {  	?>
							<li class="side-item side-item-category">Work Scheduling</li>
							<!-- ====================================== -->
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
									<span class="side-menu__icon"><i class="fe fe-compass side_menu_img"></i></span>
									<span class="side-menu__label">Orders</span><i class="angle fa fa-angle-right"></i>
								</a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<ul class="nav panel-tabs">
													<li><a href="#side14" class="active" data-bs-toggle="tab"><i class="bi bi-house"></i><p>Home</p></a></li>
													
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side14">
													<ul class="sidemenu-list">
														<li class="side-menu__label1"><a href="javascript:void(0)">Pages</a></li>
														<li class="sub-slide">
															<a class="slide-item side-menu__item-sub" data-bs-toggle="sub-slide" href="javascript:void(0)">
																<span class="sub-side-menu__label">External Order's</span>
																<i class="sub-angle fe fe-chevron-down"></i>
															</a>
															<ul class="sub-slide-menu">
																<li><a href="orderlist.php" class="slide-item">Order List</a></li>
																<li><a href="add-order-details.php" class="slide-item">Add Order Details</a></li>
																<li><a href="close-order.php" class="slide-item">Close Order</a></li>
															</ul>
														</li>
														<li class="sub-slide">
															<a class="slide-item side-menu__item-sub" data-bs-toggle="sub-slide" href="javascript:void(0)">
																<span class="sub-side-menu__label">Internal Order's</span>
																<i class="sub-angle fe fe-chevron-down"></i>
															</a>
															<ul class="sub-slide-menu">
																<li><a href="inorderlist.php" class="slide-item">Order List</a></li>
																<li><a href="add-inorder-details.php" class="slide-item">Add Order Details</a></li>
																<li><a href="close-inorder.php" class="slide-item">Close Order</a></li>
															</ul>
														</li>
														
														<!-- <li><a href="thumbnails.html" class="slide-item"> Thumbnails</a></li> -->
														
													</ul>
													<!-- <div class="menutabs-content">
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
													</div> -->
												</div>
											
											</div>
										</div>
									</li>

								</ul>
							</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
									<span class="side-menu__icon"><i class="fe fe-copy side_menu_img"></i></span>
									<span class="side-menu__label">Process Jobs</span><i class="angle fa fa-angle-right"></i>
								</a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<ul class="nav panel-tabs">
													<li><a href="#side14" class="active" data-bs-toggle="tab"><i class="bi bi-house"></i><p>Home</p></a></li>
													
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side14">
													<ul class="sidemenu-list">
														<li class="side-menu__label1"><a href="javascript:void(0)">Pages</a></li>
														
														
														<li><a href="processjobs.php" class="slide-item"> Process Jobs</a></li>
														<li><a href="processjoblist.php" class="slide-item"> Allocate Process Jobs</a></li>
													</ul>
													
												</div>
											
											</div>
										</div>
									</li>

								</ul>
							</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
									<span class="side-menu__icon"><i class="fe fe-users side_menu_img"></i></span>
									<span class="side-menu__label">Digital Marketing</span><i class="angle fa fa-angle-right"></i>
								</a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<ul class="nav panel-tabs">
													<li><a href="#side14" class="active" data-bs-toggle="tab"><i class="bi bi-house"></i><p>Home</p></a></li>
													
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side14">
													<ul class="sidemenu-list">
														<li class="side-menu__label1"><a href="javascript:void(0)">Pages</a></li>
														
														
														<li><a href="staffallocationlist.php" class="slide-item"> Staff Allocation List</a></li>
														<li><a href="dmcontentlist.php" class="slide-item"> DM Content View</a></li>
														<li><a href="dmstaffclienthandle.php" class="slide-item"> DM Client / Staff List</a></li>
													</ul>
													
												</div>
											
											</div>
										</div>
									</li>

								</ul>
							</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
									<span class="side-menu__icon"><i class="fe fe-battery-charging side_menu_img"></i></span>
									<span class="side-menu__label">Work Tracker</span><i class="angle fa fa-angle-right"></i>
								</a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<ul class="nav panel-tabs">
													<li><a href="#side14" class="active" data-bs-toggle="tab"><i class="bi bi-house"></i><p>Home</p></a></li>
													
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side14">
													<ul class="sidemenu-list">
														<li class="side-menu__label1"><a href="javascript:void(0)">Pages</a></li>
														
														
														<li><a href="worktracker.php" class="slide-item">Tracker Settings</a></li>
														<li><a href="work_tracker_viewer.php" class="slide-item">Tracker Viewer</a></li>
													</ul>
													
												</div>
											
											</div>
										</div>
									</li>

								</ul>
							</li>				

							<!-- ============================================ -->
							<li class="side-item side-item-category">Billing Details</li>
							<!-- <li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="gstCalculate.php">
									<span class="side-menu__icon"><i class="fe fe-dollar-sign side_menu_img"></i></span>
									<span class="side-menu__label">GST</span>
								</a>
							</li> -->
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
									<span class="side-menu__icon"><i class="fe fe-dollar-sign side_menu_img"></i></span>
									<span class="side-menu__label">GST</span><i class="angle fa fa-angle-right"></i>
								</a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<ul class="nav panel-tabs">
													<li><a href="#side14" class="active" data-bs-toggle="tab"><i class="bi bi-house"></i><p>GST</p></a></li>
													
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side14">
													<ul class="sidemenu-list">
														<li class="side-menu__label1"><a href="javascript:void(0)">Pages</a></li>
														<li class="sub-slide">
															<a class="slide-item side-menu__item-sub" data-bs-toggle="sub-slide" href="gstCalculate.php">
																<span class="sub-side-menu__label">Current Month List</span>
																<!-- <i class="sub-angle fe fe-chevron-down"></i> -->
															</a>
															
														</li>
														<li class="sub-slide">
															<a class="slide-item side-menu__item-sub" data-bs-toggle="sub-slide" href="javascript:void(0)">
																<span class="sub-side-menu__label">Paid Details</span>
																<!-- <i class="sub-angle fe fe-chevron-down"></i> -->
															</a>
															
														</li>
														
														
														
													</ul>
													
												</div>
											
											</div>
										</div>
									</li>

								</ul>
							</li>
							

							
							
							<li class="side-item side-item-category">Work Details</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="workdetailslist-graphics.php">
									<span class="side-menu__icon"><i class="fe fe-feather side_menu_img"></i></span>
									<span class="side-menu__label">Graphics Work Details</span>
								</a>
								
							</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="workdetailslist-web.php">
									<span class="side-menu__icon"><i class="fe fe-align-left side_menu_img"></i></span>
									<span class="side-menu__label">Other work Details</span>
								</a>
								
							</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="workdetailslist-processjobs.php">
									<span class="side-menu__icon"><i class="fe fe-crop side_menu_img"></i></span>
									<span class="side-menu__label">Process Job Details</span>
								</a>
								
							</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="orderlistvsclientquality.php">
									<span class="side-menu__icon"><i class="fe fe-command side_menu_img"></i></span>
									<span class="side-menu__label">Order Vs Client Quality</span>
								</a>
								
							</li>
							
							<li class="side-item side-item-category">Masters</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
									<span class="side-menu__icon"><i class="fe fe-box side_menu_img"></i></span>
									<span class="side-menu__label">Employee Settings</span><i class="angle fa fa-angle-right"></i>
								</a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<ul class="nav panel-tabs">
													<li><a href="#side5" class="active" data-bs-toggle="tab"><i class="bi bi-house"></i><p>Home</p></a></li>
													
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side5">
													<ul class="sidemenu-list">
																												
														<li><a href="department.php" class="slide-item">Department</a></li>
														<li><a href="designation.php" class="slide-item">Designation</a></li>
														<li><a href="employeelist.php" class="slide-item">Employees</a></li>
														
													
													</ul>
													
												</div>
												
											</div>
										</div>
									</li>

								</ul>
							</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
									<span class="side-menu__icon"><i class="fe fe-cpu side_menu_img"></i></span>
									<span class="side-menu__label">Tracker Settings</span><i class="angle fa fa-angle-right"></i>
								</a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<ul class="nav panel-tabs">
													<li><a href="#side5" class="active" data-bs-toggle="tab"><i class="bi bi-house"></i><p>Home</p></a></li>
													
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side5">
													<ul class="sidemenu-list">
																												
														
														<li><a href="questions.php" class="slide-item">Questions</a></li>
														<li><a href="subquestions.php" class="slide-item">Sub Questions</a></li>
														
													</ul>
													
												</div>
												
											</div>
										</div>
									</li>

								</ul>
							</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
									<span class="side-menu__icon"><i class="fe fe-award side_menu_img"></i></span>
									<span class="side-menu__label">Order Settings</span><i class="angle fa fa-angle-right"></i>
								</a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<ul class="nav panel-tabs">
													<li><a href="#side8" class="active" data-bs-toggle="tab"><i class="bi bi-house"></i><p>Home</p></a></li>
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side8">
													<ul class="sidemenu-list">
														<li><a href="category.php" class="slide-item">Category</a></li>
														<li><a href="subcategory.php" class="slide-item">Subcategory</a></li>
														<li><a href="supplierslist.php" class="slide-item">Suppliers</a></li>
														<li><a href="combocategorylist.php" class="slide-item">Combo Category</a></li>
													</ul>
													
												</div>
												
											</div>
										</div>
									</li>

								</ul>
							</li>
							
<?php  } ?>

<!-- ================================================== -->
							
						
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