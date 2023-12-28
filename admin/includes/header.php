<!--Main Header -->
<div class="main-header side-header sticky">
				<div class="container-fluid main-container">
					<div class="main-header-left sidemenu">
						<a class="main-header-menu-icon" href="javascript:void(0);" data-bs-toggle="sidebar" id="mainSidebarToggle"><span></span></a>
					</div>
					<div class="main-header-left horizontal">
						<a class="main-logo" href="index.html">
							<img src="../assets/img/SLogoBlue.png" class="desktop-logo desktop-logo-dark" alt="dashleadlogo">
							<img src="../assets/img/SLogoBlue.png" class="desktop-logo theme-logo" alt="dashleadlogo">
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
										<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
											<div
												class="header-navheading d-flex border-bottom mb-0">
												<h5 class="fw-semibold mb-0 mt-1">Notifications(3)</h5>
												<a class="btn ripple btn-primary btn-sm ms-auto" href="javascript:void(0);">Mark all as Read</a>
											</div>
											<div class="header-dropdown-list notification-list">
												<a href="view-mail.html" class="dropdown-item d-flex border-bottom pb-1">
													<div class="main-img-user online"><img alt="avatar"
														src="../assets/img/users/5.jpg">
													</div>
													<div class="media-body ms-2">
														<p class="mb-1">Congratulate <strong>Olivia James</strong> For new<br> Template start</p>
														<span>Oct 15 12:32pm</span>
													</div>
												</a>
												<a href="view-mail.html" class="dropdown-item d-flex border-bottom pb-1">
													<div class="main-img-user online"><img alt="avatar"
														src="../assets/img/users/2.jpg">
													</div>
													<div class="media-body ms-2">
														<p class="mb-1"><strong>Joshua Gray</strong> New Message Received</p>
														<span>Oct 13 02:56am</span>
													</div>
												</a>
												<a href="view-mail.html" class="dropdown-item d-flex border-bottom pb-1">
													<div class="main-img-user online"><img alt="avatar"
														src="../assets/img/users/3.jpg">
													</div>
													<div class="media-body ms-2">
														<p class="mb-1"><strong>Elizabeth Lewis</strong> added new schedule<br> realease</p>
														<span>Oct 12 10:40am</span>
													</div>
												</a>
												<a href="view-mail.html" class="dropdown-item d-flex border-bottom pb-1">
													<div class="main-img-user online"><img alt="avatar"
														src="../assets/img/users/4.jpg">
													</div>
													<div class="media-body ms-2">
														<p class="mb-1"><strong>Sonia Fraser</strong> Nemo enim voluptatem<br> sequi nesciunt</p>
														<span>Nov 3 10:21am</span>
													</div>
												</a>
												<a href="view-mail.html" class="dropdown-item d-flex pb-1">
													<div class="main-img-user online"><img alt="avatar"
														src="../assets/img/users/5.jpg">
													</div>
													<div class="media-body ms-2">
														<p class="mb-1"><strong>Kevin James</strong> simply dummy text of<br> the printing</p>
														<span>Nov 14 12:40pm</span>
													</div>
												</a>
											</div>
											<div class="dropdown-footer">
												<a class="btn ripple btn-success btn-sm btn-block" href="mail-inbox.html">View All Notifications</a>
											</div>
										</div>
									</li>
									<li class="dropdown main-profile-menu">
										<a class="main-img-user" href="javascript:void(0);" data-bs-toggle="dropdown"><img alt="avatar"
												src="../assets/img/users/avatar.png"></a>
										<div class="dropdown-menu">
											<div class="header-navheading">
												<h6 class="main-notification-title"><?php echo strtoupper($_SESSION['adminname']); ?></h6>
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
										<a href="javascript:void(0);" class="nav-link icon" data-bs-toggle="sidebar-right"
											data-bs-target=".sidebar-right">
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
							<li class="side-item side-item-category">Masters</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
									<span class="side-menu__icon"><i class="fe fe-box side_menu_img"></i></span>
									<span class="side-menu__label">Employee Details</span><i class="angle fa fa-angle-right"></i>
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
									<span class="side-menu__icon"><i class="fe fe-award side_menu_img"></i></span>
									<span class="side-menu__label">Orders</span><i class="angle fa fa-angle-right"></i>
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
													</ul>
													
												</div>
												
											</div>
										</div>
									</li>

								</ul>
							</li>
							
							<li class="side-item side-item-category">Order Execution</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="orderlist.php">
									<span class="side-menu__icon"><i class="fe fe-layers side_menu_img"></i></span>
									<span class="side-menu__label">Orders</span>
								</a>
								
							</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="staffAllocation.php">
									<span class="side-menu__icon"><i class="fe fe-compass side_menu_img"></i></span>
									<span class="side-menu__label">Staff Allocation</span>
								</a>
							
							</li>
						
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="quote_splitup.php">
									<span class="side-menu__icon"><i class="fe fe-package side_menu_img"></i></span>
									<span class="side-menu__label">Quotation Splitup</span>
								</a>
								
							</li>
							<li class="side-item side-item-category">Other Pages</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
									<span class="side-menu__icon">
										<i class="fe fe-book side_menu_img"></i>
									</span>
									<span class="side-menu__label">Sub Menus</span>
									<i class="angle fa fa-angle-right"></i>
								</a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<ul class="nav panel-tabs">
													<li><a href="#side23" class="active" data-bs-toggle="tab"><i class="bi bi-house"></i><p>Home</p></a></li>
													<li><a href="#side24" data-bs-toggle="tab" ><i class="bi bi-chat-square"></i><p>Chat</p></a></li>
													<li><a href="#side25" data-bs-toggle="tab"><i class="bi bi-box"></i><p>Activity</p></a></li>
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side23">
													<ul class="sidemenu-list">
														<li class="side-menu__label1"><a href="javascript:void(0)">Menu Levels</a></li>
														<li><a class="slide-item" href="javascript:void(0)">Sub Menu-1</a></li>
														<li class="sub-slide">
															<a class="slide-item side-menu__item-sub" data-bs-toggle="sub-slide" href="javascript:void(0)">
																<span class="sub-side-menu__label">Sub Menu-2</span>
																<i class="sub-angle fe fe-chevron-down"></i>
															</a>
															<ul class="sub-slide-menu">
																<li><a class="sub-side-menu__item" href="javascript:void(0)">Sub Menu-2.1</a></li>
																<li><a class="sub-side-menu__item" href="javascript:void(0)">Sub Menu-2.2</a></li>
																<li class="sub-slide2">
																	<a class="sub-side-menu__item side-menu__item-sub2" data-bs-toggle="sub-slide2" href="javascript:void(0)">
																		<span class="sub-side-menu__label">Sub Menu-2.3</span>
																		<i class="sub-angle2 fe fe-chevron-down"></i>
																	</a>
																	<ul class="sub-slide-menu1">
																		<li><a class="sub-slide-item2" href="javascript:void(0)">Sub Menu-2.3.1</a></li>
																		<li><a class="sub-slide-item2" href="javascript:void(0)">Sub Menu-2.3.2</a></li>
																		<li><a class="sub-slide-item2" href="javascript:void(0)">Sub Menu-2.3.3</a></li>
																	</ul>
																</li>
															</ul>
														</li>
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
												<div class="tab-pane" id="side24">
													<h5 class="my-4 px-1 text-default">Chat</h5>
													<div class="rounded-2">
														<div class="list-group-item d-flex align-items-start p-2">
															<div class="me-2">
																<span class="avatar avatar-sm rounded-circle cover-image" data-image-src="../assets/img/users/2.jpg">
																	<span class="avatar-status bg-green"></span>
																</span>
															</div>
															<div class="fs-13">
																<strong>Madeleine</strong> Hey! there I' am available....
																<div class="small text-muted">
																	3 hours ago
																</div>
															</div>
														</div>
														<div class="list-group-item d-flex align-items-start p-2">
															<div class="me-2">
																<span class="avatar avatar-sm rounded-circle cover-image" data-image-src="../assets/img/users/2.jpg"></span>
															</div>
															<div class="fs-13">
																<strong>Anthony</strong> New product Launching...
																<div class="small text-muted">
																	5 hour ago
																</div>
															</div>
														</div>
														<div class="list-group-item d-flex  align-items-start p-2">
															<div class="me-2">
																<span class="avatar avatar-sm rounded-circle cover-image" data-image-src="../assets/img/users/9.jpg">
																	<span class="avatar-status bg-green"></span>
																</span>
															</div>
															<div class="fs-13">
																<strong>Olivia</strong> New Schedule Realease......
																<div class="small text-muted">
																	45 mintues ago
																</div>
															</div>
														</div>
														<div class="list-group-item d-flex  align-items-start p-2">
															<div class="me-2">
																<span class="avatar avatar-sm rounded-circle cover-image" data-image-src="../assets/img/users/1.jpg">
																	<span class="avatar-status bg-green"></span>
																</span>
															</div>
															<div class="fs-13">
																<strong>Madeleine</strong> Hey! there I' am available....
																<div class="small text-muted">
																	3 hours ago
																</div>
															</div>
														</div>
														<div class="list-group-item d-flex  align-items-start p-2">
															<div class="me-2">
																<span class="avatar avatar-sm rounded-circle cover-image" data-image-src="../assets/img/users/1.jpg"></span>
															</div>
															<div class="fs-13">
																<strong>Anthony</strong> New product Launching...
																<div class="small text-muted">
																	5 hour ago
																</div>
															</div>
														</div>
														<div class="list-group-item d-flex  align-items-start p-2">
															<div class="me-2">
																<span class="avatar avatar-sm rounded-circle cover-image" data-image-src="../assets/img/users/5.jpg">
																	<span class="avatar-status bg-green"></span>
																</span>
															</div>
															<div class="fs-13">
																<strong>Lily May</strong> New Schedule Realease......
																<div class="small text-muted">
																	45 mintues ago
																</div>
															</div>
														</div>
														<div class="list-group-item d-flex  align-items-start p-2">
															<div class="me-2">
																<span class="avatar avatar-sm rounded-circle cover-image" data-image-src="../assets/img/users/4.jpg">
																	<span class="avatar-status bg-green"></span>
																</span>
															</div>
															<div class="fs-13">
																<strong>Eric Walsh</strong> Okay...I will be waiting for you
																<div class="small text-muted">
																	12 mintues ago
																</div>
															</div>
														</div>
														<div class="list-group-item d-flex  align-items-start p-2">
															<div class="me-2">
																<span class="avatar avatar-sm rounded-circle cover-image" data-image-src="../assets/img/users/1.jpg"></span>
															</div>
															<div class="fs-13">
																<strong>Alison White</strong> Hi we can explain our new project......
																<div class="small text-muted">
																	45 mintues ago
																</div>
															</div>
														</div>
														<div class="list-group-item d-flex  align-items-start p-2">
															<div class="me-2">
																<span class="avatar avatar-sm rounded-circle cover-image" data-image-src="../assets/img/users/7.jpg">
																	<span class="avatar-status bg-green"></span>
																</span>
															</div>
															<div class="fs-13">
																<strong>Jacob Lewis</strong> New product Launching...
																<div class="small text-muted">
																	45 mintues ago
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane" id="side25">
													<h5 class="my-4 px-1 text-default">Activity</h5>
													<div class="activity mt-3">
														<img src="../assets/img/users/1.jpg" alt="" class="img-activity">
														<div class="time-activity">
															<div class="item-activity">
																<p class="mb-0 text-default"><b>Adam	Berry</b> Add a new projects <b> AngularJS Template</b></p>
																<small class="text-muted ">30 mins ago</small>
															</div>
														</div>
														<img src="../assets/img/users/2.jpg" alt="" class="img-activity">
														<div class="time-activity">
															<div class="item-activity">
																<p class="mb-0 text-default"><b>Irene Hunter</b> Add a new projects <b>Free HTML Template</b></p>
																<small class="text-muted ">1 days ago</small>
															</div>
														</div>
														<img src="../assets/img/users/3.jpg" alt="" class="img-activity">
														<div class="time-activity">
															<div class="item-activity">
																<p class="mb-0 text-default"><b>John	Payne</b> Add a new projects <b>Free PSD Template</b></p>
																<small class="text-muted ">3 days ago</small>
															</div>
														</div>
														<img src="../assets/img/users/4.jpg" alt="" class="img-activity">
														<div class="time-activity">
															<div class="item-activity">
																<p class="mb-0 text-default"><b>Julia Hardacre</b> Add a new projects <b>Free UI Template</b></p>
																<small class="text-muted ">5 days ago</small>
															</div>
														</div>
														<img src="../assets/img/users/5.jpg" alt="" class="img-activity">
														<div class="time-activity">
															<div class="item-activity">
																<p class="mb-0 text-default"><b>Adam	Berry</b> Add a new projects <b> AngularJS Template</b></p>
																<small class="text-muted ">30 mins ago</small>
															</div>
														</div>
														<img src="../assets/img/users/6.jpg" alt="" class="img-activity">
														<div class="time-activity">
															<div class="item-activity">
																<p class="mb-0 text-default"><b>Irene Hunter</b> Add a new projects <b>Free HTML Template</b></p>
																<small class="text-muted ">1 days ago</small>
															</div>
														</div>
														<img src="../assets/img/users/7.jpg" alt="" class="img-activity">
														<div class="time-activity">
															<div class="item-activity">
																<p class="mb-0 text-default"><b>John	Payne</b> Add a new projects <b>Free PSD Template</b></p>
																<small class="text-muted ">3 days ago</small>
															</div>
														</div>
														<img src="../assets/img/users/8.jpg" alt="" class="img-activity">
														<div class="time-activity">
															<div class="item-activity">
																<p class="mb-0 text-default"><b>Julia Hardacre</b> Add a new projects <b>Free UI Template</b></p>
																<small class="text-muted ">5 days ago</small>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</li>

								</ul>
							</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="widgets.html">
									<span class="side-menu__icon">
										<i class="fe fe-database side_menu_img"></i>
									</span>
									<span class="side-menu__label">Widgets</span>
								</a>
							</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
									<span class="side-menu__icon"><i class="fe fe-codepen side_menu_img"></i></span>
									<span class="side-menu__label">Utilities</span><i class="angle fa fa-angle-right"></i>
								</a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<ul class="nav panel-tabs">
													<li><a href="#side26" class="active" data-bs-toggle="tab"><i class="bi bi-house"></i><p>Home</p></a></li>
													<li><a href="#side27" data-bs-toggle="tab" ><i class="bi bi-chat-square"></i><p>Chat</p></a></li>
													<li><a href="#side28" data-bs-toggle="tab"><i class="bi bi-box"></i><p>Activity</p></a></li>
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side26">
													<ul class="sidemenu-list">
														<li class="side-menu__label1"><a href="javascript:void(0)">Utilities</a></li>
														<li><a href="background.html" class="slide-item">Background</a></li>
														<li><a href="border.html" class="slide-item">Border</a></li>
														<li><a href="display.html" class="slide-item">Display</a></li>
														<li><a href="flex.html" class="slide-item">Flex</a></li>
														<li><a href="height.html" class="slide-item">Height</a></li>
														<li><a href="margin.html" class="slide-item">Margin</a></li>
														<li><a href="padding.html" class="slide-item">Padding</a></li>
														<li><a href="position.html" class="slide-item">Position</a></li>
														<li><a href="width.html" class="slide-item">Width</a></li>
														<li><a href="extras.html" class="slide-item">Extras</a></li>
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
												<div class="tab-pane" id="side27">
													<h5 class="my-4 px-1 text-default">Chat</h5>
													<div class="rounded-2">
														<div class="list-group-item d-flex align-items-start p-2">
															<div class="me-2">
																<span class="avatar avatar-sm rounded-circle cover-image" data-image-src="../assets/img/users/2.jpg">
																	<span class="avatar-status bg-green"></span>
																</span>
															</div>
															<div class="fs-13">
																<strong>Madeleine</strong> Hey! there I' am available....
																<div class="small text-muted">
																	3 hours ago
																</div>
															</div>
														</div>
														<div class="list-group-item d-flex align-items-start p-2">
															<div class="me-2">
																<span class="avatar avatar-sm rounded-circle cover-image" data-image-src="../assets/img/users/2.jpg"></span>
															</div>
															<div class="fs-13">
																<strong>Anthony</strong> New product Launching...
																<div class="small text-muted">
																	5 hour ago
																</div>
															</div>
														</div>
														<div class="list-group-item d-flex  align-items-start p-2">
															<div class="me-2">
																<span class="avatar avatar-sm rounded-circle cover-image" data-image-src="../assets/img/users/9.jpg">
																	<span class="avatar-status bg-green"></span>
																</span>
															</div>
															<div class="fs-13">
																<strong>Olivia</strong> New Schedule Realease......
																<div class="small text-muted">
																	45 mintues ago
																</div>
															</div>
														</div>
														<div class="list-group-item d-flex  align-items-start p-2">
															<div class="me-2">
																<span class="avatar avatar-sm rounded-circle cover-image" data-image-src="../assets/img/users/1.jpg">
																	<span class="avatar-status bg-green"></span>
																</span>
															</div>
															<div class="fs-13">
																<strong>Madeleine</strong> Hey! there I' am available....
																<div class="small text-muted">
																	3 hours ago
																</div>
															</div>
														</div>
														<div class="list-group-item d-flex  align-items-start p-2">
															<div class="me-2">
																<span class="avatar avatar-sm rounded-circle cover-image" data-image-src="../assets/img/users/1.jpg"></span>
															</div>
															<div class="fs-13">
																<strong>Anthony</strong> New product Launching...
																<div class="small text-muted">
																	5 hour ago
																</div>
															</div>
														</div>
														<div class="list-group-item d-flex  align-items-start p-2">
															<div class="me-2">
																<span class="avatar avatar-sm rounded-circle cover-image" data-image-src="../assets/img/users/5.jpg">
																	<span class="avatar-status bg-green"></span>
																</span>
															</div>
															<div class="fs-13">
																<strong>Lily May</strong> New Schedule Realease......
																<div class="small text-muted">
																	45 mintues ago
																</div>
															</div>
														</div>
														<div class="list-group-item d-flex  align-items-start p-2">
															<div class="me-2">
																<span class="avatar avatar-sm rounded-circle cover-image" data-image-src="../assets/img/users/4.jpg">
																	<span class="avatar-status bg-green"></span>
																</span>
															</div>
															<div class="fs-13">
																<strong>Eric Walsh</strong> Okay...I will be waiting for you
																<div class="small text-muted">
																	12 mintues ago
																</div>
															</div>
														</div>
														<div class="list-group-item d-flex  align-items-start p-2">
															<div class="me-2">
																<span class="avatar avatar-sm rounded-circle cover-image" data-image-src="../assets/img/users/1.jpg"></span>
															</div>
															<div class="fs-13">
																<strong>Alison White</strong> Hi we can explain our new project......
																<div class="small text-muted">
																	45 mintues ago
																</div>
															</div>
														</div>
														<div class="list-group-item d-flex  align-items-start p-2">
															<div class="me-2">
																<span class="avatar avatar-sm rounded-circle cover-image" data-image-src="../assets/img/users/7.jpg">
																	<span class="avatar-status bg-green"></span>
																</span>
															</div>
															<div class="fs-13">
																<strong>Jacob Lewis</strong> New product Launching...
																<div class="small text-muted">
																	45 mintues ago
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane" id="side28">
													<h5 class="my-4 px-1 text-default">Activity</h5>
													<div class="activity mt-3">
														<img src="../assets/img/users/1.jpg" alt="" class="img-activity">
														<div class="time-activity">
															<div class="item-activity">
																<p class="mb-0 text-default"><b>Adam	Berry</b> Add a new projects <b> AngularJS Template</b></p>
																<small class="text-muted ">30 mins ago</small>
															</div>
														</div>
														<img src="../assets/img/users/2.jpg" alt="" class="img-activity">
														<div class="time-activity">
															<div class="item-activity">
																<p class="mb-0 text-default"><b>Irene Hunter</b> Add a new projects <b>Free HTML Template</b></p>
																<small class="text-muted ">1 days ago</small>
															</div>
														</div>
														<img src="../assets/img/users/3.jpg" alt="" class="img-activity">
														<div class="time-activity">
															<div class="item-activity">
																<p class="mb-0 text-default"><b>John	Payne</b> Add a new projects <b>Free PSD Template</b></p>
																<small class="text-muted ">3 days ago</small>
															</div>
														</div>
														<img src="../assets/img/users/4.jpg" alt="" class="img-activity">
														<div class="time-activity">
															<div class="item-activity">
																<p class="mb-0 text-default"><b>Julia Hardacre</b> Add a new projects <b>Free UI Template</b></p>
																<small class="text-muted ">5 days ago</small>
															</div>
														</div>
														<img src="../assets/img/users/5.jpg" alt="" class="img-activity">
														<div class="time-activity">
															<div class="item-activity">
																<p class="mb-0 text-default"><b>Adam	Berry</b> Add a new projects <b> AngularJS Template</b></p>
																<small class="text-muted ">30 mins ago</small>
															</div>
														</div>
														<img src="../assets/img/users/6.jpg" alt="" class="img-activity">
														<div class="time-activity">
															<div class="item-activity">
																<p class="mb-0 text-default"><b>Irene Hunter</b> Add a new projects <b>Free HTML Template</b></p>
																<small class="text-muted ">1 days ago</small>
															</div>
														</div>
														<img src="../assets/img/users/7.jpg" alt="" class="img-activity">
														<div class="time-activity">
															<div class="item-activity">
																<p class="mb-0 text-default"><b>John	Payne</b> Add a new projects <b>Free PSD Template</b></p>
																<small class="text-muted ">3 days ago</small>
															</div>
														</div>
														<img src="../assets/img/users/8.jpg" alt="" class="img-activity">
														<div class="time-activity">
															<div class="item-activity">
																<p class="mb-0 text-default"><b>Julia Hardacre</b> Add a new projects <b>Free UI Template</b></p>
																<small class="text-muted ">5 days ago</small>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</li>

								</ul>
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