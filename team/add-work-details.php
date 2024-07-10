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

                    <!-- End Page Header -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card custom-card mt-3" id="right">
                                <div class="card-header rounded-bottom-0">

                                    <div class="row">
                                        <div class="col-md-5">
                                            <h5 class="mt-2">You can Add & Edit Work Details here.</h5>
                                            <input type="hidden" id="empid" name="empid" value="<?php echo $_SESSION['empid']; ?>" readonly>
                                            <input type="hidden" id="paystatus" name="paystatus" value="Payment Add" readonly>
                                            <input type="hidden" id="datastatus" name="datastatus" value="" readonly>
                                        </div>
                                        <div class="col-md-7">
                                            <button type="submit" name="submit" onclick="saveDataToDatabase()" class="btn btn-primary float-end" style="color:white;cursor:pointer;">Submit Details</button>
                                            <a href="javascript:void(0)" class="btn btn-default float-end" id="cancel">Discard</a>
                                            <!-- float-end -->

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="panel panel-primary">
                                        <div class="tab-menu-heading">
                                            <div class="tabs-menu">
                                                <!-- Tabs -->
                                                <ul class="nav panel-tabs panel-info">
                                                    <li><a href="#tab17" class="active" data-bs-toggle="tab"><span><i class="fe fe-book-open mx-1"></i></span>Work Details</a>
                                                    </li>




                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-body tabs-menu-body">
                                            <form method="post">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab17">

                                                        <div class="row mb-4">

                                                            <div class="col-md-12" style="margin: bottom 10px; border: 1px double  rgb(210, 180, 140);padding:15px;
                                                            border-top-style: dotted;  border-right-style: solid;  border-bottom-style: dotted;
                                                            border-left-style: solid; border-left: 6px solid red;" id="orderdetails"></div>
                                                        </div>
                                                        <hr>

                                                        <div class="row mb-4">

                                                            <div class="col-md-3">
                                                                <label class="form-label" for="dmpayment">Time Taken :</label>
                                                                <input type="time" class="form-control" id="timetaken" name="timetaken" max="08:00" placeholder="" required>

                                                                          </div>

                                                            <div class="col-md-3">
                                                                <label class="form-label" for="staff">Work Description [If Any] :</label>
                                                                <textarea class="form-control" name="workdesc" id="workdesc" rows="4"></textarea>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label" for="staff">Work Status :</label>
                                                                <select class="form-select mb-3" aria-label="Default select example" name="workstatus" id="workstatus" required>
                                                                    <option value="" disabled selected>Select Work Status</option>

                                                                    <option value="Work In Progress">Work In Progress</option>
                                                                    <option value="Internal Edits">Internal Edits</option>
                                                                    <option value="External Edits">External Edits</option>
                                                                    <option value="Closed">Closed</option>
                                                                </select>
                                                            </div>


                                                            <div class="col-md-3">
                                                                <label class="form-label" for="dept" style="color:transparent">Transparent Label :</label>
                                                                <button type="button" name="submit" class="btn btn-primary" onclick="addstaffRow()" style="color:white;cursor:pointer;">Add Work Details</button>

                                                            </div>
                                                            <hr>

                                                            <div class="table-responsive">

                                                                <table class="table table-bordered mg-b-0" id="staffallocateTable">
                                                                    <thead>
                                                                        <tr style="background-color: #add8e6;">
                                                                            <th>#</th>
                                                                            <th>Date</th>
                                                                            <th>Time Taken</th>
                                                                            <th>Description</th>
                                                                            <th>Work Status</th>

                                                                            <th>Action</th>
                                                                            <!-- class="hidden-cell" -->
                                                                            <th class="hidden-cell">status</th>
                                                                            <th class="hidden-cell">editid</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="ajaxstaffallocateresults">

                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        </div>

                                                    </div>






                                                </div>
                                            </form>
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
        <!-- ===========================modals ======================================= -->

        <!-- Basic modal -->
        <div class="modal fade" id="staffmodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Work Details</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" class="form-control" id="modalstaffrowid" name="modalstaffrowid" required>
                            <input type="hidden" class="form-control" id="modaleditid" name="modaleditid" required>
                            <input type="hidden" class="form-control" id="modalorderid" name="modalorderid" required>
                            <input type="hidden" class="form-control" id="modalallotid" name="modalallotid" required>

                            <div class="col-md-6">
                                <label class="form-label" for="modalworkdate">Work Date :</label>
                                <input type="date" class="form-control" id="modalworkdate" name="modalworkdate"  required>
                               

                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="modaldmpayment">Work Time :</label>
                                <input type="text" class="form-control" id="modalworktime" name="modalworktime"  required>


                            </div>

                           

                            <div class="col-md-12">
                                <label class="form-label" for="modalstaff">Staff Name :</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="modalworkstatus" id="modalworkstatus" required>
                                    <option value="" disabled selected>Select Work Status</option>

                                    <option value="Work In Progress">Work In Progress</option>
                                    <option value="Internal Edits">Internal Edits</option>
                                    <option value="External Edits">External Edits</option>
                                    <option value="Closed">Closed</option>
                                </select>
                            </div>
                           

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="savestaffChangesBtn" type="button">Save changes</button>
                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                    </div>
                </div>
            </div>

        </div>
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
    <script src="add-work-details.js"></script>

    <!--- TABS JS -->
    <script src="../assets/plugins/tabs/jquery.multipurpose_tabcontent.js"></script>
    <script src="../assets/plugins/tabs/tab-content.js"></script>
    <script>
        $(document).ready(function(e) {
            $('#modalpostings').select2();
            $('#modalpostings123').select2();
            // ========================
            var timeInput = document.getElementById('timetaken');
            timeInput.value = '00:00';
            timeInput.addEventListener('input', function() {
                var maxValue = '10:00';
                if (this.value > maxValue) {
                    alert('Time cannot exceed 10 hours');
                    this.value = '00:00'; // Set the input to '00:00'
                }
            });
            // ============================
       
    //   ===========================================
            // alert('Form loaded!');

            // Function to get URL parameter by name
            function getParameterByName(name, url) {
                if (!url) url = window.location.href;
                name = name.replace(/[\[\]]/g, '\\$&');
                var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                    results = regex.exec(url);
                if (!results) return null;
                if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\+/g, ' '));
            }

            // Get the value of 'orderid' parameter from the URL
            var orderIdFromURL = getParameterByName('workid');

            // Now 'orderIdFromURL' holds the value of 'orderid' from the URL
            console.log('Order ID from URL:', orderIdFromURL);

            $.ajax({
                type: 'POST',
                url: 'viewworkdetails.php',
                data: {
                    selectedOrderId: orderIdFromURL
                },
                success: function(data) {

                    $('#orderdetails').html(data);

                }
            });
            $.ajax({

            type: 'POST',
            url: 'get_staff_work_allocation_details.php',
            data: {
                selectedOrderId: orderIdFromURL
            },
            success: function (data) {


                $('#ajaxstaffallocateresults').html(data);


            }
            });
            // $('#mulselect').delegate('', 'click change', function() {
            //     var ordersValueid = $('#mulselect').val();
            //     console.log(ordersValueid);
            // });
        });
    </script>

</body>

</html>