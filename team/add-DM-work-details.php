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
                                            <h5 class="mt-2">DM Work Details Entry form.</h5>
                                            

                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="panel panel-primary">

                                        <div class="panel-body ">
                                            <form method="post">
                                                <input type="hidden" id="empid" name="empid" value="<?php echo $empid; ?>" readonly>
                                                <div class="row mb-4">
                                                    <div class="col-md-5" style="margin: bottom 10px; border: 1px double  rgb(210, 180, 140);padding:15px;
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

                                                                            <option value="<?php echo $roworder['id'] ?>" data-custName="<?php echo $roworder['custName'] ?>" data-brandName="<?php echo $roworder['brandName'] ?>" data-quotedAmt="<?php echo $roworder['quotedAmt'] ?>"><?php echo $roworder['brandName'] ?></option>
                                                                    <?php }
                                                                    }    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-4 form-label" for="ordersdisplay">Channel :</label>
                                                            <div class="col-md-8">
                                                                <select class="form-select mb-3" aria-label="Default select example" name="channel" id="channel" required>
                                                                    <option value="" disabled selected>Select Channel</option>
                                                                    <option value="FaceBook">FaceBook</option>
                                                                    <option value="Instagram">Instagram</option>
                                                                    <option value="FB&Insta">FB&Insta</option>
                                                                    
                                                                    <option value="Indeed">Indeed</option>
                                                                    <option value="YouTube">YouTube</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-4 form-label" for="ordersdisplay">Uploaded Content Type :</label>
                                                            <div class="col-md-8">
                                                                <select class="form-select mb-3" aria-label="Default select example" name="upcontent" id="upcontent" required>
                                                                    <option value="" disabled selected>Select Content Type</option>
                                                                    <option value="Poster">Poster</option>
                                                                    <option value="Video">Video</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-4 form-label" for="ordersdisplay">Uploaded On :</label>
                                                            <div class="col-md-8">
                                                                <input type="date" class="form-control" name="uploadon" id="uploadon" >
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-md-3 form-label">Campaign:</div>
                                                            <div class="col-md-9 form-check">
                                                                <input type="checkbox" class="form-check-input" name="campaignchk" id="campaignchk"  onchange="toggleDiv()">
                                                                <label class="form-check-label" for="campaignchk">Yes, if it is a campaign</label>
                                                            </div>
                                                        </div>
                                                        






                                                       
                                                    </div>

                                                    <!-- <p>*************************************************************************************************************************************************************************************************</p> -->
                                                   

                                             
                                                    <div class="col-md-7" style="margin: bottom 10px; border: 1px double  rgb(210, 180, 140);padding:15px;
                                                            border-top-style: dotted;  border-right-style: solid;  border-bottom-style: dotted;
                                                            border-left-style: solid; border-left: 6px solid blue;">
                                                       <div id="campaignDetails" class="row mb-4" style="display: none;">
                                                            <h4 class="col-md-12" style="text-align: center;">Campaign Details</h4>
                                                           
                                                            <div class="row mb-4">
                                                                <div class="col-md-3 form-label">Budget:</div>
                                                                <div class="col-md-9 form-check">
                                                                    <input type="text" class="form-control" name="budget" id="budget" >
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-3 form-label">Start Date:</div>
                                                                <div class="col-md-4">
                                                                    <input type="date" class="form-control" name="startdate" id="startdate">
                                                                </div>
                                                                <div class="col-md-2 form-label">End Date:</div>
                                                                <div class="col-md-3">
                                                                    <input type="date" class="form-control" name="enddate" id="enddate">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-4">
                                                                <div class="col-md-3 form-label">Campaign Name</div>
                                                                <div class="col-md-9 form-check">
                                                                    <input type="text" class="form-control" name="campname" id="campname" >
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-3 form-label">Remarks</div>
                                                                <div class="col-md-9 ">
                                                                    <input type="text" class="form-control" name="remarks" id="remarks" >
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-2 form-label">Intrim 1 : </div>
                                                                <div class="col-md-4 form-check">
                                                                    <input type="checkbox" class="form-check-input" name="intrim1" id="intrim1">
                                                                    <label class="form-check-label" for="intrim1">Check if Submitted</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <div class="col-md-3 form-label">Date : </div>
                                                                        <div class="col-md-9">
                                                                            <input type="date" class="form-control" name="intrim1Date" id="intrim1Date">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-2 form-label">Intrim 2 : </div>
                                                                <div class="col-md-4 form-check">
                                                                    <input type="checkbox" class="form-check-input" name="intrim2" id="intrim2" disabled>
                                                                    <label class="form-check-label" for="intrim2">Check if Submitted</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <div class="col-md-3 form-label">Date : </div>
                                                                        <div class="col-md-9">
                                                                            <input type="date" class="form-control" name="intrim2Date" id="intrim2Date" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-3 form-label">Result</div>
                                                                <div class="col-md-9 ">
                                                                   <textarea id="cresult" class="form-control" name="cresult" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>




                                                </div>

                                                <button type="submit" name="submit" class="btn btn-primary float-end" style="color:white;cursor:pointer;">Submit Details</button>

                                                <a href="dmworkdetailslist.php" class="btn btn-default float-end" id="cancel">Discard</a>

                                                <?php
                                               
                                                if (isset($_POST['submit'])) {
                                                    $orderid = $_POST["ordersdisplay"];
                                                    $channel = $_POST["channel"];
                                                    $upcontent = $_POST["upcontent"];
                                                    $uploadon = $_POST["uploadon"];
                                                    $campaignchk = isset($_POST["campaignchk"]) ? true : false;
                                                    $budget = $_POST["budget"];
                                                    $startdate = $_POST["startdate"];
                                                    $enddate = $_POST["enddate"];
                                                    $campname = $_POST["campname"];
                                                    $remarks = $_POST["remarks"];
                                                    $intrim1 = isset($_POST["intrim1"]) ? true : false;
                                                    $intrim2 = isset($_POST["intrim2"]) ? true : false;
                                                    $intrim1Date = $_POST["intrim1Date"];
                                                    $intrim2Date = $_POST["intrim2Date"];
                                                    $cresult = $_POST["cresult"];
                                                    $empid = $_POST["empid"];
                                                    $currentYear = date("Y");
                                                    $currentMonth = date("m");

                                                    date_default_timezone_set("Asia/Calcutta");
                                                    $postdate = date("M d,Y h:i:s a");

                                                   
                                                    
                                                        $sql = "INSERT INTO dm_workdetails (orderid,channel, upload_content_type, upload_date, campaign, budget, start_date, end_date, 
                                                        campaign_name, remarks, intrim1, intrim1_date, intrim2, intrim2_date, result, created, empid,campMonth,campYear) 
                                                        values('" . mysqli_real_escape_string($connection, $orderid) . "',
                                                        '" . mysqli_real_escape_string($connection, $channel) . "',
                                                        '" . mysqli_real_escape_string($connection, $upcontent) . "',
                                                        '" . mysqli_real_escape_string($connection, $uploadon) . "',
                                                        '" . mysqli_real_escape_string($connection, $campaignchk) . "',
                                                        '" . mysqli_real_escape_string($connection, $budget) . "'
                                                        ,'" . mysqli_real_escape_string($connection, $startdate) . "',
                                                        '" . mysqli_real_escape_string($connection, $enddate) . "',
                                                        '" . mysqli_real_escape_string($connection, $campname) . "',
                                                        '" . mysqli_real_escape_string($connection, $remarks) . "'
                                                        ,'" . mysqli_real_escape_string($connection, $intrim1) . "',
                                                        '" . mysqli_real_escape_string($connection, $intrim1Date) . "',
                                                        '" . mysqli_real_escape_string($connection, $intrim2) . "',
                                                        '" . mysqli_real_escape_string($connection, $intrim2Date) . "'
                                                        ,'" . mysqli_real_escape_string($connection, $cresult) . "',
                                                        '" . mysqli_real_escape_string($connection, $postdate) . "',
                                                       '" . mysqli_real_escape_string($connection, $empid) . "',
                                                        '" . mysqli_real_escape_string($connection, $currentMonth) . "',
                                                       '" . mysqli_real_escape_string($connection, $currentYear) . "')";
                                                    // } elseif ($editstatus == "Edit") {

                                                    //     $sql = "UPDATE gd_work_approval SET workid='" . mysqli_real_escape_string($connection, $workid) . "',total_hours_worked='" . mysqli_real_escape_string($connection, $noofhours) . "',
                                                    //     no_internal_edits='" . mysqli_real_escape_string($connection, $internaledits) . "',no_external_edits='" . mysqli_real_escape_string($connection, $extrenaledits) . "',
                                                    //     percentage_completion='" . mysqli_real_escape_string($connection, $percompletion) . "',modified='" . mysqli_real_escape_string($connection, $postdate) . "',
                                                    //     deadline_status='" . mysqli_real_escape_string($connection, $deadline_status) . "',empid='" . mysqli_real_escape_string($connection, $empid) . "',
                                                    //     worktype='Graphics' WHERE id='" . $editid . "'";
                                                    // }

                                                    if ($connection->query($sql) === TRUE) {
                                                        header("Location: dmworkdetailslist.php");
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
    function toggleDiv() {
        var checkbox = document.getElementById('campaignchk');
        var campaignDetailsDiv = document.getElementById('campaignDetails');

        if (checkbox.checked) {
            campaignDetailsDiv.style.display = 'block';
        } else {
            campaignDetailsDiv.style.display = 'none';
        }
    }
</script>
</body>

</html>
<?php ob_end_flush(); ?>