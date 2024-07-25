<?php
session_start();

if (!isset($_SESSION['adminname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
}


include "includes/connection.php";
// $adminname = isset($_SESSION['adminname']) ? $_SESSION['adminname'] : '';
$mainorderid = "";
$workid = $_GET["edit"];








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
                                            <h5 class="mt-2">DM Work details View.</h5>
                                           
                                           
                                        </div>
          
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="panel panel-primary">

                                        <div class="panel-body ">
                                            <form method="post">


                                                <div class="row mb-4">

                                                    <div class="col-md-7" style="margin: bottom 10px; border: 1px double  rgb(210, 180, 140);padding:15px;
                                                            border-top-style: dotted;  border-right-style: solid;  border-bottom-style: dotted;
                                                            border-left-style: solid; border-left: 6px solid red;" id="orderdetails">

                                                    </div>
                                                    <div class="col-md-5" style="margin: bottom 10px; border: 1px double  rgb(210, 180, 140);padding:15px;
                                                            border-top-style: dotted;  border-right-style: solid;  border-bottom-style: dotted;
                                                            border-left-style: solid; border-left: 6px solid green;">
                                                        <h4>Monthly Report Details Entered</h4>
                                                        <hr>
                                                        <?php

                                                        $reach="";
                                                        $impression="";
                                                        $follows="";
                                                        $likes="";
                                                        $totalamt="";
                                                        $allotamt="";

                                                          $query = "select * from dm_monthlyreport where orderid = '". $workid ."'";
                                                          $select_posts = mysqli_query($connection, $query);
                                                          while ($row = mysqli_fetch_assoc($select_posts)) {
                                                            $reach=$row['reach'];
                                                            $impression=$row['impression'];
                                                            $follows=$row['follows'];
                                                            $likes=$row['likes'];
                                                            $totalamt=$row['totalPaidAmount'];
                                                            $allotamt=$row['allotamt'];
                                                          
                                                          }
                                                        ?>
                                                      

                                                        <div class="row mb-4">
                                                            <label class="col-md-5 form-label" for="category">Reach :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control" name="noofhours" id="noofhours" value="<?php echo $reach; ?>" placeholder="Total No of Hours Worked" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-5 form-label" for="category">Impression:</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control" name="internaledits" id="internaledits" value="<?php echo $impression; ?>"  placeholder="Enter No of Internal Edits" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-5 form-label" for="category">Follows :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control" name="extrenaledits" id="extrenaledits" value="<?php echo $follows; ?>"  placeholder="Enter No of External Edits" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-5 form-label" for="category">Likes :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control" name="percompletion" id="percompletion" value="<?php echo $likes; ?>"  placeholder="Enter Percentage of Completion" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-5 form-label" for="category">Total Amount Spend :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control" name="percompletion" id="percompletion" value="<?php echo $totalamt; ?>"  placeholder="Enter Percentage of Completion" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-5 form-label" for="category">Alloted Amount:</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control" name="percompletion" id="percompletion" value="<?php echo $allotamt; ?>"  placeholder="Enter Percentage of Completion" readonly>
                                                            </div>
                                                        </div>
                                                 
                                                        <!-- float-end -->
                                                       
                                                          <a href="workdetailslist-dm.php" class="btn btn-default float-end" id="cancel">Discard</a>
                                                    </div>
                                                    <div class="col-md-12" style="margin: bottom 10px; border: 1px double  rgb(210, 180, 140);padding:15px;
                                                            border-top-style: dotted;  border-right-style: solid;  border-bottom-style: dotted;
                                                            border-left-style: solid; border-left: 6px solid blue;">
                                                        <h4>DM Work Details</h4>
                                                        <hr>
                                                        <div class="table-responsive">

                                                            <table class="table table-bordered mg-b-0" id="staffallocateTable">
                                                                <thead>
                                                                    <tr style="background-color: #add8e6;">
                                                                        <th>#</th>
                                                                        <th>Channel</th>
                                                                        <th>Uploaded Content</th>
                                                                        <th>Upload date</th>

                                                                        <th>Campaign Done Or Not</th>
                                                                        <th>Campaign Name</th>
                                                                        <th>Budget</th>
                                                                        <th>Start Date</th>
                                                                        <th>End Date</th>
                                                                        
                                                                        <th>Remarks</th>
                                                                        <th>Intrim 1 Date</th>
                                                                        <th>Intrim 2 Date</th>
                                                                        
                                                                        <th>Result</th>

                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="ajaxstaffallocateresults">

                                                                </tbody>
                                                            </table>
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


    <!-- <script src="add-gd-work-details.js"></script> -->
    <script src="notification.js"></script>

    <!--- TABS JS -->
    <script src="../assets/plugins/tabs/jquery.multipurpose_tabcontent.js"></script>
    <script src="../assets/plugins/tabs/tab-content.js"></script>
    <script>

        $(document).ready(function(e) {



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
            var orderIdFromURL = getParameterByName('edit');

            // Now 'orderIdFromURL' holds the value of 'orderid' from the URL
            console.log('Order ID from URL:', orderIdFromURL);

            $.ajax({
                type: 'POST',
                url: 'viewdmworkdetails.php',
                data: {
                    selectedOrderId: orderIdFromURL
                },
                success: function(data) {

                    $('#orderdetails').html(data);

                }
            });
            $.ajax({

            type: 'POST',
            url: 'get_dm_staff_work_details.php',
            data: {
                selectedOrderId: orderIdFromURL
            },
            success: function(data) {


                $('#ajaxstaffallocateresults').html(data);


            }
            });
          
        });
    </script>

</body>

</html>