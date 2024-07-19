<?php
session_start();
ob_start();
if (!isset($_SESSION['empname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
}



include "includes/connection.php";

$mainorderid = "";
$workid = $_GET["workid"];
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
                                            <h5 class="mt-2">DM Work Details Edit form.</h5>
                                            

                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="panel panel-primary">

                                        <div class="panel-body ">
                                        <form method="post">
                                            <?php 
                                                        if (isset($_GET['workid'])) {
                                                        $the_cat_id = $_GET['workid'];

                                                        $query = "select * from dm_monthlyreport WHERE id = {$the_cat_id}";
                                                        $select_edits = mysqli_query($connection,$query);
                                                        while($row1 = mysqli_fetch_assoc($select_edits))
                                                        {
                                                        

                                                        
                                                        ?> 
                                                <input type="hidden" id="empid" name="empid" value="<?php echo $empid; ?>" readonly>
                                                <div class="row mb-4" style="width: 60%; margin: auto;">
                                                    <div class="col-md-12" style="margin: bottom 10px; border: 1px double  rgb(210, 180, 140);padding:15px;
                                                            border-top-style: dotted;  border-right-style: solid;  border-bottom-style: dotted;
                                                            border-left-style: solid; border-left: 6px solid green;">



                                                        <div class="row mb-4">
                                                            <label class="col-md-4 form-label" for="ordersdisplay">Clients :</label>
                                                            <div class="col-md-8">
                                                                <select class="form-select" aria-label="Default select example" name="ordersdisplay" id="ordersdisplay" required>
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

                                                                            <option <?php if($row1['orderid']== $roworder['id']){?> selected <?php }  ?> value="<?php echo $roworder['id'] ?>" data-custName="<?php echo $roworder['custName'] ?>" data-brandName="<?php echo $roworder['brandName'] ?>" data-quotedAmt="<?php echo $roworder['quotedAmt'] ?>"><?php echo $roworder['brandName'] ?></option>
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
                                                                    <option <?php if($row1['reportmonth']== "1"){?> selected <?php }  ?> value="1">January</option>
                                                                    <option <?php if($row1['reportmonth']== "2"){?> selected <?php }  ?> value="2">February</option>
                                                                    <option <?php if($row1['reportmonth']== "3"){?> selected <?php }  ?> value="3">March</option>
                                                                    <option <?php if($row1['reportmonth']== "4"){?> selected <?php }  ?> value="4">April</option>
                                                                    <option <?php if($row1['reportmonth']== "5"){?> selected <?php }  ?> value="5">May</option>
                                                                    <option <?php if($row1['reportmonth']== "6"){?> selected <?php }  ?> value="6">June</option>
                                                                    <option <?php if($row1['reportmonth']== "7"){?> selected <?php }  ?> value="7">July</option>
                                                                    <option <?php if($row1['reportmonth']== "8"){?> selected <?php }  ?> value="8">August</option>
                                                                    <option <?php if($row1['reportmonth']== "9"){?> selected <?php }  ?> value="9">September</option>
                                                                    <option <?php if($row1['reportmonth']== "10"){?> selected <?php }  ?> value="10">October</option>
                                                                    <option <?php if($row1['reportmonth']== "11"){?> selected <?php }  ?> value="11">November</option>
                                                                    <option <?php if($row1['reportmonth']== "12"){?> selected <?php }  ?> value="12">December</option>
                                                                    <!-- ... Add options for other months ... -->
                                                                </select>
                                                            </div>

                                                        </div>


                                                        <div class="row mb-4">
                                                            <label class="col-md-4 form-label" for="ordersdisplay">Reach :</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" name="reach" id="reach" value="<?php echo $row1['reach'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-4 form-label" for="ordersdisplay">Impressions :</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" name="impressions" id="impressions" value="<?php echo $row1['impression'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-4 form-label" for="ordersdisplay">Follows :</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" name="follows" id="follows" value="<?php echo $row1['follows'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-md-4 form-label">Likes:</div>
                                                            <div class="col-md-8 ">
                                                                <input type="text" class="form-control" name="likes" id="likes" value="<?php echo $row1['likes'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-md-4 form-label">Paid Amount:</div>
                                                            <div class="col-md-8 ">
                                                                <input type="text" class="form-control" name="paidamt" id="paidamt" readonly value="<?php echo $row1['totalPaidAmount'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-md-4 form-label">Alloted Amount:</div>
                                                            <div class="col-md-8 ">
                                                                <input type="text" class="form-control" name="allotedamt" id="allotedamt" readonly value="<?php echo $row1['allotamt'] ?>">
                                                            </div>
                                                        </div>







                                                    </div>

 
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


                                                   

                                                        $sql = "UPDATE dm_monthlyreport SET orderid='" . mysqli_real_escape_string($connection, $orderid) . "',
                                                        reach='" . mysqli_real_escape_string($connection, $reach) . "',
                                                        impression='" . mysqli_real_escape_string($connection, $impressions) . "',
                                                        follows='" . mysqli_real_escape_string($connection, $follows) . "',
                                                        likes='" . mysqli_real_escape_string($connection, $likes) . "',
                                                        modified='" . mysqli_real_escape_string($connection, $postdate) . "',
                                                        totalPaidAmount='" . mysqli_real_escape_string($connection, $paidamt) . "',
                                                        empid='" . mysqli_real_escape_string($connection, $empid) . "',
                                                        reportmonth='" . mysqli_real_escape_string($connection, $monthselect) . "',
                                                        reportyear='" . mysqli_real_escape_string($connection, $currentYear) . "',
                                                        allotamt='" . mysqli_real_escape_string($connection, $allotedamt) . "'
                                                         WHERE id='" . $the_cat_id . "'";
                                                    

                                                    if ($connection->query($sql) === TRUE) {
                                                        header("Location: dmmonthlyreportlist.php");
                                                    } else {
                                                        echo "Error:ans1 " . $sql . "<br>" . $connection->error;
                                                    }
                                                }
                                                ?>

                                                <?php }} ?>

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
    function toggleDiv() {
        var checkbox = document.getElementById('campaignchk');
        var campaignDetailsDiv = document.getElementById('campaignDetails');

        if (checkbox.checked) {
            campaignDetailsDiv.style.display = 'block';
        } else {
            campaignDetailsDiv.style.display = 'none';
        }
    }
    // Run toggleDiv on page load to set the initial state
window.onload = function() {
    toggleDiv();
};
</script>
</body>

</html>
<?php ob_end_flush(); ?>