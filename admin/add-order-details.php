<?php
ob_start();
session_start();

if (!isset($_SESSION['adminname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['adminname']);
    header("location: signin.php");
}

include "includes/connection.php";
// $orderid = $_GET["add"];
$mainorderid = "";
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
                            <h2 class="main-content-title tx-24 mg-b-5" style="color:brown;text-transform:uppercase; text-decoration: underline;">Add & Edit Order Details</h2>
                            <!-- <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Payment Details</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Closing Order Form</li>
                            </ol> -->
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
                    <div class="row">
					<div class="col-md-12">
						<div class="card custom-card mt-3" id="right">
							<div class="card-header rounded-bottom-0">
								<h5 class="mt-2">Tabs on Right Side</h5>
							</div>
							<div class="card-body">
								<div class="tab_wrapper second_tab">
									<ul class="tab_list">
										<li class="active">Order Details</li>
										<li>Quotation Splitup</li>
										<li>Staff Allocation</li>
										<li>Supplier Payment Details</li>
										<li>Customer Payment Details</li>
										<!-- <li>Tab 6</li> -->
									</ul>

									<div class="content_wrapper">
										<div class="tab_content active">
											<p>It is a long established fact that a reader will be distracted by
												the readable content of a page when looking at its layout. The
												point of using Lorem Ipsum is that it has a more-or-less normal
												distribution
												of letters, as opposed to using 'Content here, content here',
												making it look like readable English. Many desktop publishing
												packages and web page editors now use Lorem Ipsum as their
												default model text,
												and a search for 'lorem ipsum' will uncover many web sites still
												in their infancy. Various versions have evolved over the years,
												sometimes by accident, sometimes on purpose (injected humour and
												the like)
												It is a long established fact that a reader will be distracted
												by the readable content of a page when looking at its layout.
												The point of using Lorem Ipsum is that it has a more-or-less
												normal distribution
												of letters, as opposed to using 'Content here, content here',
												making it look like readable English. Many desktop publishing
												packages and web page editors now use Lorem Ipsum as their
												default model text,
												and a search for 'lorem ipsum' will uncover many web sites still
												in their infancy. Various versions have evolved over the years,
												sometimes by accident, sometimes on purpose (injected humour and
												the like).</p>
										</div>

										<div class="tab_content">
											<p>Contrary to popular belief, Lorem Ipsum is not simply random
												text. It has roots in a piece of classical Latin literature from
												45 BC, making it over 2000 years old. Richard McClintock, a
												Latin professor at
												Hampden-Sydney College in Virginia, looked up one of the more
												obscure Latin words, consectetur, from a Lorem Ipsum passage,
												and going through the cites of the word in classical literature,
												discovered
												the undoubtable source. Lorem Ipsum comes from sections 1.10.32
												and 1.10.33 of"de Finibus Bonorum et Malorum" (The Extremes of
												Good and Evil) by Cicero, written in 45 BC. This book is a
												treatise on the
												theory of ethics, very popular during the Renaissance. The first
												line of Lorem Ipsum,"Lorem ipsum dolor sit amet..", comes from a
												line in section 1.10.32. Contrary to popular belief, Lorem Ipsum
												is not
												simply random text. It has roots in a piece of classical Latin
												literature from 45 BC, making it over 2000 years old. Richard
												McClintock, a Latin professor at Hampden-Sydney College in
												Virginia, looked
												up one of the more obscure Latin words, consectetur, from a
												Lorem Ipsum passage, and going through the cites of the word in
												classical literature, discovered the undoubtable source. Lorem
												Ipsum comes
												from sections 1.10.32 and 1.10.33 of"de Finibus Bonorum et
												Malorum" (The Extremes of Good and Evil) by Cicero, written in
												45 BC. This book is a treatise on the theory of ethics, very
												popular during the
												Renaissance. The first line of Lorem Ipsum,"Lorem ipsum dolor
												sit amet..", comes from a line in section 1.10.32.</p>
										</div>


										<div class="tab_content">
											<p>It is a long established fact that a reader will be distracted by
												the readable content of a page when looking at its layout. The
												point of using Lorem Ipsum is that it has a more-or-less normal
												distribution
												of letters, as opposed to using 'Content here, content here',
												making it look like readable English. Many desktop publishing
												packages and web page editors now use Lorem Ipsum as their
												default model text,
												and a search for 'lorem ipsum' will uncover many web sites still
												in their infancy. Various versions have evolved over the years,
												sometimes by accident, sometimes on purpose (injected humour and
												the like)
												It is a long established fact that a reader will be distracted
												by the readable content of a page when looking at its layout.
												The point of using Lorem Ipsum is that it has a more-or-less
												normal distribution
												of letters, as opposed to using 'Content here, content here',
												making it look like readable English. Many desktop publishing
												packages and web page editors now use Lorem Ipsum as their
												default model text,
												and a search for 'lorem ipsum' will uncover many web sites still
												in their infancy. Various versions have evolved over the years,
												sometimes by accident, sometimes on purpose (injected humour and
												the like).</p>
										</div>

										<div class="tab_content">
											<p>Contrary to popular belief, Lorem Ipsum is not simply random
												text. It has roots in a piece of classical Latin literature from
												45 BC, making it over 2000 years old. Richard McClintock, a
												Latin professor at
												Hampden-Sydney College in Virginia, looked up one of the more
												obscure Latin words, consectetur, from a Lorem Ipsum passage,
												and going through the cites of the word in classical literature,
												discovered
												the undoubtable source. Lorem Ipsum comes from sections 1.10.32
												and 1.10.33 of"de Finibus Bonorum et Malorum" (The Extremes of
												Good and Evil) by Cicero, written in 45 BC. This book is a
												treatise on the
												theory of ethics, very popular during the Renaissance. The first
												line of Lorem Ipsum,"Lorem ipsum dolor sit amet..", comes from a
												line in section 1.10.32. Contrary to popular belief, Lorem Ipsum
												is not
												simply random text. It has roots in a piece of classical Latin
												literature from 45 BC, making it over 2000 years old. Richard
												McClintock, a Latin professor at Hampden-Sydney College in
												Virginia, looked
												up one of the more obscure Latin words, consectetur, from a
												Lorem Ipsum passage, and going through the cites of the word in
												classical literature, discovered the undoubtable source. Lorem
												Ipsum comes
												from sections 1.10.32 and 1.10.33 of"de Finibus Bonorum et
												Malorum" (The Extremes of Good and Evil) by Cicero, written in
												45 BC. This book is a treatise on the theory of ethics, very
												popular during the
												Renaissance. The first line of Lorem Ipsum,"Lorem ipsum dolor
												sit amet..", comes from a line in section 1.10.32.</p>
										</div>

										<div class="tab_content">
											<p>There are many variations of passages of Lorem Ipsum available,
												but the majority have suffered alteration in some form, by
												injected humour, or randomised words which don't look even
												slightly believable.
												If you are going to use a passage of Lorem Ipsum, you need to be
												sure there isn't anything embarrassing hidden in the middle of
												text. All the Lorem Ipsum generators on the Internet tend to
												repeat predefined
												chunks as necessary, making this the first true generator on the
												Internet. It uses a dictionary of over 200 Latin words, combined
												with a handful of model sentence structures, to generate Lorem
												Ipsum
												which looks reasonable. The generated Lorem Ipsum is therefore
												always free from repetition, injected humour, or
												non-characteristic words etc. There are many variations of
												passages of Lorem Ipsum available,
												but the majority have suffered alteration in some form, by
												injected humour, or randomised words which don't look even
												slightly believable. If you are going to use a passage of Lorem
												Ipsum, you need to
												be sure there isn't anything embarrassing hidden in the middle
												of text. All the Lorem Ipsum generators on the Internet tend to
												repeat predefined chunks as necessary, making this the first
												true generator
												on the Internet. It uses a dictionary of over 200 Latin words,
												combined with a handful of model sentence structures, to
												generate Lorem Ipsum which looks reasonable. The generated Lorem
												Ipsum is therefore
												always free from repetition, injected humour, or
												non-characteristic words etc.</p>
										</div>

										<div class="tab_content">
											<p>Contrary to popular belief, Lorem Ipsum is not simply random
												text. It has roots in a piece of classical Latin literature from
												45 BC, making it over 2000 years old. Richard McClintock, a
												Latin professor at
												Hampden-Sydney College in Virginia, looked up one of the more
												obscure Latin words, consectetur, from a Lorem Ipsum passage,
												and going through the cites of the word in classical literature,
												discovered
												the undoubtable source. Lorem Ipsum comes from sections 1.10.32
												and 1.10.33 of"de Finibus Bonorum et Malorum" (The Extremes of
												Good and Evil) by Cicero, written in 45 BC. This book is a
												treatise on the
												theory of ethics, very popular during the Renaissance. The first
												line of Lorem Ipsum,"Lorem ipsum dolor sit amet..", comes from a
												line in section 1.10.32. Contrary to popular belief, Lorem Ipsum
												is not
												simply random text. It has roots in a piece of classical Latin
												literature from 45 BC, making it over 2000 years old. Richard
												McClintock, a Latin professor at Hampden-Sydney College in
												Virginia, looked
												up one of the more obscure Latin words, consectetur, from a
												Lorem Ipsum passage, and going through the cites of the word in
												classical literature, discovered the undoubtable source. Lorem
												Ipsum comes
												from sections 1.10.32 and 1.10.33 of"de Finibus Bonorum et
												Malorum" (The Extremes of Good and Evil) by Cicero, written in
												45 BC. This book is a treatise on the theory of ethics, very
												popular during the
												Renaissance. The first line of Lorem Ipsum,"Lorem ipsum dolor
												sit amet..", comes from a line in section 1.10.32.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>





                    
                    <!-- ROW-1 OPEN -->

                    <!-- /ROW-1 CLOSED -->
                </div>
            </div>
        </div>
        <!-- End Main Content-->
       
        <!-- Main Footer-->
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

    <!-- INTERNAL SELECT2 JS -->
    <script src="../assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="../assets/js/select2.js"></script>

    <!-- Chart.Bundle js-->
    <script src="../assets/plugins/chart.js/Chart.bundle.min.js"></script>

    <!-- Perfect-scrollbar js-->
    <script src="../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/plugins/perfect-scrollbar/p-scroll-1.js"></script>

    <!-- Sidemenu js-->
    <script src="../assets/plugins/sidemenu/sidemenu.js"></script>

    <!-- Sidebar js-->
    <script src="../assets/plugins/sidebar/sidebar.js"></script>

    <!-- INTERNAL WYSIWYG Editor JS -->
    <script src="../assets/plugins/wysiwyag/jquery.richtext.js "></script>
    <script src="../assets/plugins/wysiwyag/wysiwyag.js "></script>

    <!-- INTERNAL File-Uploads Js-->
    <script src="../assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
    <script src="../assets/plugins/fancyuploder/jquery.fileupload.js"></script>
    <script src="../assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
    <script src="../assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
    <script src="../assets/plugins/fancyuploder/fancy-uploader.js"></script>
    <!-- Sweet-Alert js-->
    <script src="../assets/plugins/sweet-alert/sweetalert.min.js"></script>
    <script src="../assets/plugins/sweet-alert/jquery.sweet-alert.js"></script>
    <script src="../assets/js/sweet-alert.js"></script>

    <!-- Sticky js-->
    <script src="../assets/js/sticky.js"></script>

    <!-- Custom-Switcher js -->
    <script src="../assets/js/custom-switcher.js"></script>

    <!-- Custom js-->
    <script src="../assets/js/custom.js"></script>

    <!-- Switcher js -->
    <script src="../assets/switcher/js/switcher.js"></script>

    <!-- password-addon init -->
    <!-- <script src="../assets/js/password-addon.js"></script> -->
    <script src="view-payment.js"></script>

	<!--- TABS JS -->
	<script src="../assets/plugins/tabs/jquery.multipurpose_tabcontent.js"></script>
	<script src="../assets/plugins/tabs/tab-content.js"></script>


</body>

</html>