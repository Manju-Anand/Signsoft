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

$mainorderid = "";
$workid = $_GET["workid"];








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
                                            <h5 class="mt-2">GD Work Approval section.</h5>
                                            <input type="hidden" id="empid" name="empid" value="<?php echo $_SESSION['empid']; ?>" readonly>
                                           
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
                                                        <h4>Enter Working Details Here</h4>
                                                        <hr>
                                                        <input type="hidden" class="form-control" name="editstatus" id="editstatus" value="">
                                                        <input type="hidden" class="form-control" name="editid" id="editid"  value="">
                                                        <input type="hidden" class="form-control" name="newallotid" id="newallotid"  value="">

                                                        <div class="row mb-4">
                                                            <label class="col-md-5 form-label" for="category">Total No of Hours :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control" name="noofhours" id="noofhours" placeholder="Total No of Hours Worked" value="<?php echo $post_timetaken; ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-5 form-label" for="category">Internal Edits:</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control" name="internaledits" id="internaledits" value="<?php echo $internal; ?>" placeholder="Enter No of Internal Edits">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-5 form-label" for="category">External Edits :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control" name="extrenaledits" id="extrenaledits" value="<?php echo $external; ?>" placeholder="Enter No of External Edits">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-5 form-label" for="category">Percentage of Completion :</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control" name="percompletion" id="percompletion" value="<?php echo $percompletion; ?>" placeholder="Enter Percentage of Completion">
                                                            </div>
                                                        </div>
                                                        <!-- float-end -->
                                                        <button type="submit" name="submit" class="btn btn-primary float-end" style="color:white;cursor:pointer;">Submit Details</button>
                                                       
                                                        <button type="submit" name="delsubmit" class="btn btn-primary " onclick="return confirmDelete()" style="color:white;cursor:pointer;">Delete Details</button>
                                                        <a href="gdworkapproval.php" class="btn btn-default float-end" id="cancel">Discard</a>
                                                    </div>
                                                    <div class="col-md-12" style="margin: bottom 10px; border: 1px double  rgb(210, 180, 140);padding:15px;
                                                            border-top-style: dotted;  border-right-style: solid;  border-bottom-style: dotted;
                                                            border-left-style: solid; border-left: 6px solid blue;">
                                                        <h4>Daily Work Status</h4>
                                                        <hr>
                                                        <div class="table-responsive">

                                                            <table class="table table-bordered mg-b-0" id="staffallocateTable">
                                                                <thead>
                                                                    <tr style="background-color: #add8e6;">
                                                                        <th>#</th>
                                                                        <th>Date</th>
                                                                        <th>Time Taken</th>
                                                                        <th>Work Status</th>
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

                                                <?php
                                                 if (isset($_POST['delsubmit'])) {
                                                    $editid = $_POST["editid"];
                                                    if (isset($editid) && $editid !== null) {
                                                        $sql = "DELETE FROM gd_work_approval WHERE id='" . $editid  . "'";
                                                        if ($connection->query($sql) === TRUE) {
                                                            header("Location: gdworkapproval.php");
                                                        } else {
                                                            echo "Error:ans1 " . $sql . "<br>" . $connection->error;
                                                        }
                                                    }

                                                 }
                                                if (isset($_POST['submit'])) {
                                                    $noofhours = $_POST["noofhours"];
                                                    $internaledits = $_POST["internaledits"];
                                                    $extrenaledits = $_POST["extrenaledits"];
                                                    $percompletion = $_POST["percompletion"];
                                                    $deadline_status = $_POST["deadlinestatus"];
                                                    $workid = $_POST["newallotid"];
                                                    date_default_timezone_set("Asia/Calcutta");
                                                    $postdate = date("M d,Y h:i:s a");

                                                    $editstatus = $_POST["editstatus"];
                                                    $editid = $_POST["editid"];
                                                    if ($editstatus == "New") {
                                                        $sql = "INSERT INTO gd_work_approval (workid,total_hours_worked,no_internal_edits,no_external_edits,percentage_completion,created,modified,deadline_status) 
                                                        values('" . mysqli_real_escape_string($connection, $workid) . "',
                                                        '" . mysqli_real_escape_string($connection, $noofhours) . "',
                                                        '" . mysqli_real_escape_string($connection, $internaledits) . "',
                                                        '" . mysqli_real_escape_string($connection, $extrenaledits) . "',
                                                        '" . mysqli_real_escape_string($connection, $percompletion) . "',
                                                        '" . mysqli_real_escape_string($connection, $postdate) . "'
                                                        ,'" . mysqli_real_escape_string($connection, $postdate) . "',
                                                        '" . mysqli_real_escape_string($connection, $deadline_status) . "')";
                                                    } elseif ($editstatus == "Edit") {

                                                        $sql = "UPDATE gd_work_approval SET workid='" . mysqli_real_escape_string($connection, $workid) . "',total_hours_worked='" . mysqli_real_escape_string($connection, $noofhours) . "',
                                                        no_internal_edits='" . mysqli_real_escape_string($connection, $internaledits) . "',no_external_edits='" . mysqli_real_escape_string($connection, $extrenaledits) . "',
                                                        percentage_completion='" . mysqli_real_escape_string($connection, $percompletion) . "',modified='" . mysqli_real_escape_string($connection, $postdate) . "',
                                                        deadline_status='" . mysqli_real_escape_string($connection, $deadline_status) . "' WHERE id='" . $editid . "'";
                                                         }

                                                    if ($connection->query($sql) === TRUE) {
                                                        header("Location: gdworkapproval.php");
                                                    } else {
                                                        echo "Error:ans1 " . $sql . "<br>" . $connection->error;
                                                    }
                                                }
                                                ?>



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
        function confirmDelete() {
    return confirm("Are you sure you want to delete this record?");
}
        $(document).ready(function(e) {
            $('#modalpostings').select2();
            $('#modalpostings123').select2();


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
                url: 'viewgdworkdetails_approval.php',
                data: {
                    selectedOrderId: orderIdFromURL
                },
                success: function(data) {

                    $('#orderdetails').html(data);

                }
            });
            $.ajax({

                type: 'POST',
                url: 'get_gd_staff_work_approval.php',
                data: {
                    selectedOrderId: orderIdFromURL
                },
                success: function(data) {


                    $('#ajaxstaffallocateresults').html(data);


                }
            });
            // ===========================================================
            $.ajax({
            url: 'fetch_gd_data.php',
            type: 'GET',
            data: { workid: orderIdFromURL },
            success: function(response) {
                console.log(response);
                // You can now use the response data to update your UI
                // Example:
                
                $('#editstatus').val(response.editstatus);
          
                $('#editid').val(response.editid);
        
                $('#newallotid').val(response.orgwokid);
             
                console.log($('#newallotid').val());
                $('#noofhours').val(response.post_timetaken);
    
                $('#internaledits').val(response.internal);

                $('#extrenaledits').val(response.external);
          
                $('#percompletion').val(response.percompletion);
            
                
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
            }
        });



            // =======================================
        });
    </script>

</body>

</html>