<?php
session_start();

if (!isset($_SESSION['adminname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
}


include "includes/connection.php";
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
                            <h2 class="main-content-title tx-24 mg-b-5">Add Employees Work tracker</h2>
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
                                    <div class="card-title">Add Employees Work tracker</div>
                                </div>
                                <form id="addcateg" method="post" action="">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                        <label for="designation" class="form-label">Select Employee</label>
                                                        <select class="form-control form-select" data-bs-placeholder="Select Employee" id="empname" name="empname" required>
                                                            <option value="" disabled selected>Select Employee</option>
                                                            <?php
                                                            $query = "select * from employee where status='Active' order by id desc";
                                                            $select_posts = mysqli_query($connection, $query);
                                                            while ($row = mysqli_fetch_assoc($select_posts)) {
                                                            ?>
                                                                <option value="<?php echo $row['id'] ?>" data-questions="<?php echo $row['id']; ?>" data-ans="<?php echo $row['empname']; ?>"><?php echo $row['empname'] ?></option>
                                                            <?php } ?>


                                                        </select>

                                                        <input type="hidden" id="selectedEmpName" name="selectedEmpName" value="">
                                                        
                                                        <br><br>
                                                <label class="col-md-3 form-label" for="status">Status :</label>
                                                <select name="status" id="status" class="form-control form-select select2" data-bs-placeholder="Select Status">
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>

                                                </select>
                                            </div>
                                            <style>
                                                .scrollable-list {
                                                    max-height: 200px; /* Adjust this value as needed */
                                                    overflow-y: auto;
                                                }

                                            </style>
                                            <div class="col-md-6">
                                                <label for="designation" class="form-label">Select questions for the employee</label>
                                                <div class="scrollable-list" data-simplebar data-simplebar-auto-hide="false" data-simplebar-track="primary">
                                                    <div class="list-group">
                                                        <?php
                                                        $query = "select * from questions order by id desc";
                                                        $select_posts = mysqli_query($connection, $query);
                                                        while ($row = mysqli_fetch_assoc($select_posts)) {
                                                        ?>
                                                            <label class="list-group-item">
                                                                <input class="form-check-input me-1" type="checkbox" name="fruits[]" value="<?php echo $row['id']; ?>">
                                                                <?php echo $row['question']; ?>
                                                            </label>
                                                        <?php } ?>

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
                                                <button type="submit" name="submit" class="btn btn-primary" style="color:white;cursor:pointer;">Allocate Process Jobs</button>
                                                <a href="javascript:void(0)" class="btn btn-default float-end" id="cancel">Discard</a>
                                            </div>
                                        </div>
                                        <!--End Row-->
                                    </div>

                                    <?php
                                        if (isset($_POST['submit'])) {
                                            // ========================================================
                                            if (isset($_POST["fruits"])) {
                                                $empname = $_POST["empname"];
                                                $status = $_POST["status"];
                                                // ===============================Delete old datas==================


                                                $query = "DELETE FROM trackerdetails WHERE emp_id  = '" . $empname . "'";
                                                $delete_query = mysqli_query($connection, $query);
                                                if (!$delete_query) {
                                                    die('QUERY FAILED' . mysqli_error($connection));
                                                }

                                                $query = "DELETE FROM tracker WHERE emp_id = '" . $empname . "'";
                                                $delete_query = mysqli_query($connection, $query);
                                                if (!$delete_query) {
                                                    die('QUERY FAILED' . mysqli_error($connection));
                                                }



                                                // ===============================Delete old datas==================
                                                echo "dfdsff";
                                                $f = 0;
                                                $fruits = $_POST["fruits"];
                                                foreach ($fruits as $fruit) {
                                                    $f = $f + 1;
                                                    echo $fruit;
                                                }

                                                $status = $_POST["status"];
                                                date_default_timezone_set("Asia/Calcutta");
                                                $postdate = date("M d,Y h:i:s a");
                                                $sql = "INSERT INTO tracker (emp_id,no_of_qus,status,created,modified) values('" . mysqli_real_escape_string($connection, $empname) . "',
                                                '" . mysqli_real_escape_string($connection, $f) . "','" . mysqli_real_escape_string($connection, $status) . "',
                                                '" . mysqli_real_escape_string($connection, $postdate) . "','" . mysqli_real_escape_string($connection, $postdate) . "')";

                                                if ($connection->query($sql) === TRUE) {
                                                    $last_emp_id = $connection->insert_id;

                                                    foreach ($fruits as $fruit) {
                                                        $sqldetails = "INSERT INTO trackerdetails (tracker_id,question_id,emp_id,status ) values('" . mysqli_real_escape_string($connection, $last_emp_id) . "',
                                                        '" . mysqli_real_escape_string($connection, $fruit) . "','" . mysqli_real_escape_string($connection, $empname) . "','Active')";
                                                        if ($connection->query($sqldetails) === TRUE) {
                                                            header("Location: worktracker.php");
                                                        } else {
                                                            echo "Error:ans1 " . $sqldetails . "<br>" . $connection->error;
                                                        }
                                                    }
                                                } else {
                                                    echo "Error:ans1 " . $sql . "<br>" . $connection->error;
                                                }
                                            } else {
                                                echo "<script>
                                                alert('Select any Questions from the list and then save the details!.....');
                                                </script>";
                                            }
                                            // ==============================================================================


                                        }
                                        ?>
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