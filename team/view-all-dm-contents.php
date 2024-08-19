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
// $orderid = $_GET["add"];
$mainorderid = "";

// Check if the page is loaded as a new call or return from the edit page
$isReturnFromEdit = isset($_GET['from']) && $_GET['from'] === 'change';




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
    <link href="../assets/css/style.css?v=1.0.1" rel="stylesheet">

    <!--- Plugins css -->
    <link href="../assets/css/plugins.css" rel="stylesheet">

    <!-- Switcher css -->
    <link href="../assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="../assets/switcher/demo.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/imageupload.css">
    <style>
        .hidden-cell {
            display: none;
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
                    <?php
                    if ($isReturnFromEdit) {
                        // Handle the case where the form is returning from the edit page
                        $orderid = isset($_GET['orderid']) ? $_GET['orderid'] : '';


                        // echo "Returned from edit page for order ID: $orderid";
                    } else {
   
                        $orderid = '';
                        // echo "This is a new form call";
                    }
                    ?>
                    <!-- End Page Header -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card custom-card mt-3" id="right">
                                <div class="card-header rounded-bottom-0">

                                    <div class="row">
                                        <div class="col-md-5">
                                            <h2 class="main-content-title tx-24 mg-b-5">View Given Contents here.</span>
                                            <input type="hidden" id="paystatus" name="paystatus" value="Payment Add" readonly>
                                            <input type="hidden" id="datastatus" name="datastatus" value="" readonly>
                                            <input type="hidden" id="empid" name="empid" value="<?php echo $_SESSION['empid']; ?>" readonly>
                                        </div>
                                        <div class="col-md-7">
                                            <br>
                                            <!-- <button type="submit" name="submit" onclick="saveDataToDatabase()" class="btn btn-primary float-end" style="color:white;cursor:pointer;">Submit Details</button> -->
                                            <a href="javascript:void(0)" class="btn btn-default float-end" id="cancel">Discard</a>
                                            <!-- float-end -->

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="panel panel-primary">
                                        <form method="post">


                                            <div class="row mb-4">
                                                <div class="col-md-4">
                                                    <label class="form-label" for="ordersdisplay">Clients :</label>
                                                    <select class="form-select mb-3" aria-label="Default select example" name="ordersdisplay" id="ordersdisplay" required>
                                                        <option value="" disabled selected>Select Clients</option>
                                                        <?php
                                                        $queryorder = "select * from order_customers where order_status='Active' order by id desc";
                                                        $select_postsorder = mysqli_query($connection, $queryorder);
                                                        while ($roworder = mysqli_fetch_assoc($select_postsorder)) {

                                                            $mainorderid = $roworder['id'];
                                                            $dmorder = "false";
                                                            $querydigital = "select * from category where dept_id=(select id from department where dname='Digital')";
                                                            // $querydigital = "select * from category where category='Social Media'";
                                                            $select_postsdigital = mysqli_query($connection, $querydigital);
                                                            while ($rowdigital = mysqli_fetch_assoc($select_postsdigital)) {
                                                                $catId = $rowdigital['id'];



                                                                $queryordercat = "select * from order_category where order_id='" . $roworder['id'] . "' and category_id='" . $catId . "'";
                                                                $select_postsordercat = mysqli_query($connection, $queryordercat);
                                                                while ($rowordercat = mysqli_fetch_assoc($select_postsordercat)) {
                                                                    $categoryId = $rowordercat['category_id'];
                                                                    $querydmallot = "select * from staff_dm_allocation where orderid='" . $roworder['id'] . "' and staffid='" .  $_SESSION['empid'] . "'";
                                                                    $select_postsdmallot = mysqli_query($connection, $querydmallot);
                                                                    while ($rowdmallot = mysqli_fetch_assoc($select_postsdmallot)) {
                                                                        $dmorder = "true";
                                                                    }
                                                                }
                                                            }

                                                            if ($dmorder == "true") {
                                                        ?>

                                                                <option value="<?php echo $roworder['id'] ?>" data-custName="<?php echo $roworder['custName'] ?>" data-brandName="<?php echo $roworder['brandName'] ?>" data-quotedAmt="<?php echo $roworder['quotedAmt'] ?>"><?php echo $roworder['brandName'] ?></option>
                                                        <?php }
                                                        }    ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-8" style="margin: bottom 10px; border: 1px double  rgb(210, 180, 140);padding:15px;
                                                                border-top-style: dotted;  border-right-style: solid;  border-bottom-style: dotted;
                                                                border-left-style: solid; border-left: 6px solid red;" id="orderdetails">
                                                </div>
                                            </div>


                                            <div class="row mb-4">


                                                <div class="col-md-4 mb-4">
                                                    <!-- <button type="button" name="addcontent" id="addcontent" class="btn btn-primary" style="color:white; cursor:pointer;" disabled>
                                                                <a href="add-Graphics-new-content.php" style="color: white; text-decoration: none;">Add New Content</a>
                                                            </button> -->

                                                    <!-- <button type="button" name="addcontent" id="addcontent" class="btn btn-primary" style="color:white; cursor:pointer;" disabled onclick="navigateToPage()">
                                                        Add New Content
                                                    </button> -->






                                                </div>
                                                <div class="table-responsive">

                                                    <table class="table table-bordered mg-b-0 staffallocateTable" id="example1">
                                                        <thead>
                                                            <tr style="background-color: #add8e6;">
                                                                <th class="wd-2p">#</th>
                                                                <th class="wd-10p">Assign Date</th>
                                                                <th class="wd-10p">Posting</th>
                                                                <th class="wd-30p">Content</th>
                                                                <th class="wd-20p">Idea</th>
                                                                <th class="wd-10p">Deadline</th>
                                                                <th class="hidden-cell">Action</th>
                                                                <!-- class="hidden-cell" -->
                                                                <th class="hidden-cell">status</th>
                                                                <th class="hidden-cell">editid</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="ajaxstaffallocateresults">
                                                            <!-- ================ ======================================= -->






                                                            <!-- ============================================================================= -->
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>


                                        </form>
                                        <!-- <div class="panel-body tabs-menu-body">
                                           
                                        </div> -->
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
        <!-- ===========================modals ======================================= -->

        <!-- Basic modal -->
      
        <!-- End Basic modal -->

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
    <!-- DATA TABLE JS-->
    <script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
    <script src="../assets/js/table-data.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
    <script src="../assets/plugins/datatable/js/jszip.min.js"></script>
    <script src="../assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
    <script src="../assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.html5.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.colVis.min.js"></script>
    <script src="../assets/plugins/datatable/dataTables.responsive.min.js"></script>
    <script src="../assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
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
    <script src="add-graphics-details.js"></script>
    <script src="notification.js"></script>
    <script src="../assets/js/imageupload.js"></script>
    <!--- TABS JS -->
    <script src="../assets/plugins/tabs/jquery.multipurpose_tabcontent.js"></script>
    <script src="../assets/plugins/tabs/tab-content.js"></script>


    <script>
        document.getElementById('ordersdisplay').addEventListener('change', function () {
            // alert (selectedOrderId);
            var selectedOption = this.options[this.selectedIndex];
            var selectedOrderId = selectedOption.value;
            if (selectedOrderId) {
                var ordersDisplay = document.getElementById('ordersdisplay');
                ordersDisplay.value = selectedOrderId;
                // Call your AJAX functions to load the data
                $.ajax({
                    type: 'POST',
                    url: 'vieworderdetails.php', // Replace with the actual URL that fetches data based on selectedOrderId
                    data: {
                        selectedOrderId: selectedOrderId
                    },
                    success: function(data) {
                        // Update options of the second select
                        $('#orderdetails').html(data);
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: 'get_graphics_content_details_viewing.php',
                    data: {
                        selectedOrderId: selectedOrderId
                    },
                    success: function(data) {
                        // Destroy the DataTable if it exists to reinitialize it
                        if ($.fn.DataTable.isDataTable('#example1')) {
                            $('#example1').DataTable().destroy();
                        }
                        $('#ajaxstaffallocateresults').html(data);
                        // Reinitialize DataTable with updated content
                        $('#example1').DataTable({
                            "paging": true, // Enable pagination
                            "lengthChange": true, // Enable number of records per page
                            "searching": true, // Enable search box
                            "ordering": true, // Enable column sorting
                            "info": true, // Enable table information display
                            "autoWidth": true, // Disable auto width calculation
                            "responsive": true, // Enable responsive design
                            // Additional options as needed
                        });
                    }
                });
                // Ensure event delegation is set up after content is loaded
             
            }
        });
    </script>


</body>

</html>