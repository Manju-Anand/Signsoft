<?php
session_start();
ob_start();
if (!isset($_SESSION['empname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
}



include "includes/connection.php";

$mainorderid = "";
// $workid = $_GET["workid"];
$empid = isset($_SESSION['empid']) ? $_SESSION['empid'] : '';







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
    <!-- <div id="global-loader">
        <img src="../assets/img/loader.svg" class="loader-img" alt="Loader">
    </div> -->
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
                                            <h5 class="mt-2">DM Work Details Entry form.</h5>


                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="panel panel-primary">

                                        <div class="panel-body ">
                                            <form method="post">
                                                <input type="hidden" id="empid" name="empid" value="<?php echo $empid; ?>" readonly>
                                                <input type="hidden" id="ordid" name="ordid" value="" readonly>
                                                <input type="hidden" id="ordamt" name="ordamt" value="" readonly>
                                                <div class="row mb-4" style="width: 60%; margin: auto;">
                                                    <div class="col-md-12" style="margin: bottom 10px; border: 1px double  rgb(210, 180, 140);padding:15px;
                                                            border-top-style: dotted;  border-right-style: solid;  border-bottom-style: dotted;
                                                            border-left-style: solid; border-left: 6px solid green;">



                                                        <div class="row mb-4">
                                                            <label class="col-md-4 form-label" for="ordersdisplay">Clients :</label>
                                                            <div class="col-md-8">
                                                                <select class="form-select" aria-label="Default select example" name="ordersdisplay" id="ordersdisplay" onchange="updateInputValue()" required>
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
                                                        </div>

                                                        <div class="row mb-4">
                                                            <label for="designation" class="col-md-4 form-label">Select Month</label>
                                                            <div class="col-md-8">
                                                                <select id="month-select" name="month-select" class="form-select mb-3" required>
                                                                    <option value="" disabled selected>Select Month</option>
                                                                    <option value="1">January</option>
                                                                    <option value="2">February</option>
                                                                    <option value="3">March</option>
                                                                    <option value="4">April</option>
                                                                    <option value="5">May</option>
                                                                    <option value="6">June</option>
                                                                    <option value="7">July</option>
                                                                    <option value="8">August</option>
                                                                    <option value="9">September</option>
                                                                    <option value="10">October</option>
                                                                    <option value="11">November</option>
                                                                    <option value="12">December</option>
                                                                    <!-- ... Add options for other months ... -->
                                                                </select>
                                                            </div>

                                                        </div>


                                                        <div class="row mb-4">
                                                            <label class="col-md-4 form-label" for="ordersdisplay">Reach :</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" name="reach" id="reach">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-4 form-label" for="ordersdisplay">Impressions :</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" name="impressions" id="impressions">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-4 form-label" for="ordersdisplay">Follows :</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" name="follows" id="follows">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-md-4 form-label">Likes:</div>
                                                            <div class="col-md-8 ">
                                                                <input type="text" class="form-control" name="likes" id="likes">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-md-4 form-label">Paid Amount:</div>
                                                            <div class="col-md-8 ">
                                                                <input type="text" class="form-control" name="paidamt" id="paidamt" readonly required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-md-4 form-label">Alloted Amount:</div>
                                                            <div class="col-md-8 ">
                                                                <input type="text" class="form-control" name="allotedamt" id="allotedamt" readonly required>
                                                            </div>
                                                        </div>







                                                    </div>

                                                    <!-- <p>*************************************************************************************************************************************************************************************************</p> -->








                                                </div>
                                                <!-- <div class="row mb-4" style="width: 60%; margin: auto;"> -->
                                                <button type="submit" name="submit" class="btn btn-primary float-end" style="color:white;cursor:pointer;">Submit Details</button>

                                                <a href="dmmonthlyreportlist.php" class="btn btn-default float-end" id="cancel">Discard</a>
                                                <!-- </div> -->
                                                <?php

                                                if (isset($_POST['submit'])) {
                                                    $orderid = $_POST["ordersdisplay"];
                                                    $monthselect = $_POST["month-select"];
                                                    $reach = $_POST["reach"];
                                                    $impressions = $_POST["impressions"];
                                                    $follows = $_POST["follows"];
                                                    $likes = $_POST["likes"];
                                                    $paidamt = $_POST["paidamt"];
                                                    $allotedamt = $_POST["allotedamt"];
                                                    $empid = $_POST["empid"];

                                                    date_default_timezone_set("Asia/Calcutta");
                                                    $postdate = date("M d,Y h:i:s a");
                                                    $currentYear = date("Y");


                                                    $sql = "INSERT INTO dm_monthlyreport (orderid,reach, impression, follows, likes, totalPaidAmount, created, empid,reportmonth,reportyear,allotamt) 
                                                        values('" . mysqli_real_escape_string($connection, $orderid) . "',
                                                        '" . mysqli_real_escape_string($connection, $reach) . "',
                                                        '" . mysqli_real_escape_string($connection, $impressions) . "',
                                                        '" . mysqli_real_escape_string($connection, $follows) . "',
                                                        '" . mysqli_real_escape_string($connection, $likes) . "',
                                                        '" . mysqli_real_escape_string($connection, $paidamt) . "',
                                                        '" . mysqli_real_escape_string($connection, $postdate) . "',
                                                        '" . mysqli_real_escape_string($connection, $empid) . "',
                                                        '" . mysqli_real_escape_string($connection, $monthselect) . "',
                                                        '" . mysqli_real_escape_string($connection, $currentYear) . "',
                                                        '" . mysqli_real_escape_string($connection, $allotedamt) . "')";
                                                    // } elseif ($editstatus == "Edit") {

                                                    //     $sql = "UPDATE gd_work_approval SET workid='" . mysqli_real_escape_string($connection, $workid) . "',total_hours_worked='" . mysqli_real_escape_string($connection, $noofhours) . "',
                                                    //     no_internal_edits='" . mysqli_real_escape_string($connection, $internaledits) . "',no_external_edits='" . mysqli_real_escape_string($connection, $extrenaledits) . "',
                                                    //     percentage_completion='" . mysqli_real_escape_string($connection, $percompletion) . "',modified='" . mysqli_real_escape_string($connection, $postdate) . "',
                                                    //     deadline_status='" . mysqli_real_escape_string($connection, $deadline_status) . "',empid='" . mysqli_real_escape_string($connection, $empid) . "',
                                                    //     worktype='Graphics' WHERE id='" . $editid . "'";
                                                    // }

                                                    if ($connection->query($sql) === TRUE) {
                                                        header("Location: dmmonthlyreportlist.php");
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
        document.addEventListener('DOMContentLoaded', function() {
            var monthSelect = document.getElementById('month-select');
            var currentMonth = new Date().getMonth() + 1; // getMonth() returns 0-11, so add 1 to get 1-12

            monthSelect.value = currentMonth;
        });


        function updateInputValue() {
            var select = document.getElementById('ordersdisplay');
            var input = document.getElementById('ordid');
            var monthselect = document.getElementById('month-select');
            var monthId = monthselect.value;
            input.value = select.value;

            var orderid = select.value;
           
            $.ajax({
                
                url: 'fetch-dm-spent-data.php',
                type: 'POST',
                data: { orderId: orderid,monthId: monthId },
                success: function(response) {
                    // var input = document.getElementById('ordamt');
                    // input.value = response; // Assuming the response contains the data you want to display
                    
                    // var input1 = document.getElementById('paidamt');
                    // input1.value = response;

                    var data = JSON.parse(response);
                    var budgetInput = document.getElementById('ordamt');
                    var budgetInput1 = document.getElementById('paidamt');
                    var promoInput = document.getElementById('allotedamt');
                    budgetInput.value = data.budgetSum;
                    budgetInput1.value = data.budgetSum;
                    promoInput.value = data.promoAmt;
                    if (data.budgetSum == null){
                        alert("You haven't entered any work details for this client!. First Enter the work details and then add monthly report details.");
                    }
                },
                error: function() {
                    alert('Error fetching data.');
                }
            });
        }
    </script>
</body>

</html>
<?php ob_end_flush(); ?>