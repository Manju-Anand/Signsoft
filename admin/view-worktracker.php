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
$categid = $_GET["edit"];
$empname="";
$sqltracker = "SELECT * FROM tracker where id='" . $categid  . "'";
$resulttracker = $connection->query($sqltracker);

if ($resulttracker->num_rows > 0) {
  while($rowtracker = $resulttracker->fetch_assoc()) {
    $queryemp1 = "select * from employee where id='" . $rowtracker['emp_id'] . "'";
    $select_postsemp1 = mysqli_query($connection, $queryemp1);
    while ($rowemp1 = mysqli_fetch_assoc($select_postsemp1)) {
        $empname=$rowemp1['empname'];
    }
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
                            <h2 class="main-content-title tx-24 mg-b-5">View Employees Work tracker</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Employee Masters</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Employees Work tracker</li>
                            </ol>
                        </div>
                        <div class="btn-list">
                            <a class="btn ripple btn-primary" href="javascript:void(0);"><i class="fe fe-external-link"></i> Export</a>
                            <a class="btn ripple btn-secondary" href="javascript:void(0);"><i class="fe fe-download"></i> Download</a>
                            <a class="btn ripple btn-info" href="javascript:void(0);"><i class="fe fe-help-circle"></i> Help</a>
                            <a class="btn ripple btn-danger dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="fe fe-settings"></i> Settings <i class="fa fa-caret-down ms-1"></i>
                            </a>
                            <!-- <div class="dropdown-menu tx-13">
                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-eye me-2 float-start"></i>View</a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-plus-circle me-2 float-start"></i>Add</a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-mail me-2 float-start"></i>Email</a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-folder-plus me-2 float-start"></i>Save</a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-trash-2 me-2 float-start"></i>Remove</a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-settings me-2 float-start"></i>More</a>
                            </div> -->
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- ROW-1 OPEN -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Work tracker of : <?php echo $empname; ?></div>
                                    
                                </div>
                                <form id="addcateg" method="post" action="">
                                <input type="hidden" name="trackerid" value="<?php echo $categid;?>"  > 
                                    <div class="card-body">
                                        <div class="row">
                                            
                                            <style>
                                                .scrollable-list {
                                                    max-height: 200px; /* Adjust this value as needed */
                                                    overflow-y: auto;
                                                }

                                            </style>
                                            <div class="col-md-12">
                                                <label for="designation" class="form-label">Questions assigned for the employee</label>
                                                <div class="scrollable-list" data-simplebar data-simplebar-auto-hide="false" data-simplebar-track="primary">
                                                    <div class="list-group">
                                                        <?php
                                                        $query = "select * from questions order by id desc";
                                                        $select_posts = mysqli_query($connection, $query);
                                                        while ($row = mysqli_fetch_assoc($select_posts)) {
                                                            // ==========check whether this qus is added or not in tracker details================
                                                                $typ="false";
                                                                $trackerid="";
                                                                $querytracker1 = "select * from trackerdetails where question_id='" . $row['id'] . "' and tracker_id='" . $categid  . "' and status='Active'";
                                                                $select_poststracker1 = mysqli_query($connection, $querytracker1);
                                                                while ($rowtracker1 = mysqli_fetch_assoc($select_poststracker1)) { 
                                                                    $typ="true";  
                                                                    $trackerid = $rowtracker1['id'];
                                                             
                                                        ?>
                                                            <label class="list-group-item">
                                                                <input class="form-check-input me-1" type="checkbox" name="fruits[]" <?php if ($typ=="true"){?> checked <?php }  ?> value="<?php echo $row['id']; ?>">
                                                                <?php echo $row['question']; ?>
                                                            </label>
                                                        <?php    }} ?>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>






                                    </div>
                                    <div class="card-footer">
                                        <!--Row-->
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <!-- <button type="submit" name="submit" class="btn btn-primary" style="color:white;cursor:pointer;">Allocate Process Jobs</button> -->
                                                <a href="javascript:void(0)" class="btn btn-default float-end" id="cancel">Discard</a>
                                            </div>
                                        </div>
                                        <!--End Row-->
                                    </div>

                                    

                                </form>
                            </div>
                        </div>
                    </div>
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
    <!-- <script src="../assets/js/simplebar.min.js"></script> -->
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

    <!-- Sticky js-->
    <script src="../assets/js/sticky.js"></script>

    <!-- Custom-Switcher js -->
    <script src="../assets/js/custom-switcher.js"></script>

    <!-- Custom js-->
    <script src="../assets/js/custom.js"></script>

    <!-- Switcher js -->
    <script src="../assets/switcher/js/switcher.js"></script>
    <script>
        $(document).ready(function(e) {
            $('#cancel').delegate('', 'click change', function() {
                window.location = "worktracker.php";
                return false;
            });

// Get the select element
var selectElement = document.getElementById('empname');

// Add change event listener to select element
selectElement.addEventListener('change', function() {
    // Get the selected option
    var selectedOption = this.options[this.selectedIndex];

    // Get the value of the data-ans attribute of the selected option
    var empName = selectedOption.getAttribute('data-ans');

    // Set the value of the hidden input field
    document.getElementById('selectedEmpName').value = empName;
});

            
        });

        
    </script>
    <script>

</script>

</body>

</html>
<?php }} ?>