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
    <link href="../assets/css/style.css?v=1.0.1" rel="stylesheet">

    <!--- Plugins css -->
    <link href="../assets/css/plugins.css" rel="stylesheet">

    <!-- Switcher css -->
    <link href="../assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="../assets/switcher/demo.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/imageupload.css">


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
                    <div class="POST">
                        <div class="col-md-12">
                            <div class="card custom-card mt-3" id="right">
                                <div class="card-header rounded-bottom-0">

                                    <div class="POST">
                                        <div class="col-md-5">
                                            <h2 class="main-content-title tx-24 mg-b-5" ;">Add Graphics Designers Content</h2>
                                            <span class="mt-2">You can Add Graphics Designers Content here.</span>
                                            
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="panel panel-primary">
                                        <form method="post"  enctype="multipart/form-data">

                                            <input type="hidden" class="form-control" id="orderid" name="orderid" value="<?php echo isset($_POST['orderid']) ? htmlspecialchars($_POST['orderid']) : ''; ?>">
                                            <input type="hidden" class="form-control" id="empid" name="empid" value="<?php echo isset($_POST['empid']) ? htmlspecialchars($_POST['empid']) : ''; ?>">


                                            <div class="row mb-4">



                                                <div class="col-md-6">
                                                    <label class="form-label" for="postings">Postings :</label>
                                                    <select class="form-select mb-3" name="postings" id="postings" required>
                                                        <option value="" disabled selected>Select Postings</option>
                                                        <option value="Poster">Poster</option>
                                                        <option value="Video">Video</option>
                                                        <option value="GIF">GIF</option>
                                                    </select>

                                                    <label class="form-label" for="content">Content :</label>
                                                    <textarea class="form-control" name="content" id="content" rows="4" style="margin-bottom: 10px;"></textarea>

                                                    <label class="form-label" for="idea">Idea :</label>
                                                    <textarea class="form-control" name="idea" id="idea" rows="2" style="margin-bottom: 10px;"></textarea>



                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label" for="deadline">Deadline :</label>
                                                    <input type="date" class="form-control mb-3" id="deadline" name="deadline" placeholder="" required>

                                                    <label class="form-label" for="samimages">Sample Images:</label>

                                                    <input type="file" class="form-control" id="imageInput" name="images[]" multiple accept="image/*">
                                                    <div id="imagePreviewContainer"></div>


                                                </div>





                                                <div class="col-md-7">
                                                    <br>
                                                    <button type="submit" name="submit" class="btn btn-primary float-end" style="color:white;cursor:pointer;">Submit Details</button>
                                                    <a href="add-Graphics-Staff-details.php" class="btn btn-default float-end" id="cancel">Discard</a>


                                                </div>

                                                <br>
                                                <hr>



                                            </div>
                                            <?php
                                            if (isset($_POST['submit'])) {
                                                echo "hai";
                                                $assigndate = date("d-m-Y");
                                                $posting = $_POST['postings'];
                                                // $content =  mysqli_real_escape_string($connection, $_POST['content']);
                                                $content =   $_POST['content'];
                                                $idea = $_POST['idea'];

                                                $deadline1 = $_POST['deadline'];

                                                // Check if the date is set and not empty
                                                if (!empty($deadline1)) {
                                                    // Create a DateTime object from the received date
                                                    $date = DateTime::createFromFormat('Y-m-d', $deadline1);

                                                    // Check if the date is valid
                                                    if ($date) {
                                                        // Format the date to 'd-m-Y'
                                                        $deadline = $date->format('d-m-Y');
                                                    } else {
                                                        echo "Invalid date format!";
                                                    }
                                                } else {
                                                    echo "No date provided!";
                                                }



                                                $orderid = $_POST['orderid'];
                                                $empid = $_POST['empid'];

                                                date_default_timezone_set("Asia/Calcutta");
                                                $postdate = date("M d,Y h:i:s a");

                                                $sql = "SELECT * FROM department where dname='Graphics'";
                                                $result = $connection->query($sql);
                                                if ($result->num_rows > 0) {
                                                    while ($rowdept = $result->fetch_assoc()) {
                                                        $sqlemp = "SELECT * FROM employee where department_id='" . $rowdept['id']  . "' and hod='Yes'";
                                                        $resultemp = $connection->query($sqlemp);
                                                        if ($resultemp->num_rows > 0) {
                                                            while ($rowemp = $resultemp->fetch_assoc()) {
                                                                $staffid = $rowemp['id'];
                                                            }
                                                        }
                                                    }
                                                }


                                                // Prepare an insert statement
                                                $sql = "INSERT INTO staff_dm_graphics_allocation (orderid, staffid, postings, content, status, assigndate, work_status, created, assigned_staffid, redirect_status, posteridea, deadline) VALUES (?, ?, ?, ?, 'New', ?, 'Active', ?, ?, 'Self', ?, ?)";

                                                if ($stmt = $connection->prepare($sql)) {
                                                    // Bind variables to the prepared statement as parameters
                                                    $stmt->bind_param("sssssssss", $orderid, $staffid, $posting, $content, $assigndate, $postdate, $empid, $idea, $deadline);
                                                  

                                                    if ($stmt->execute()) {
                                                        $last_id = $stmt->insert_id;

                                                        // Handle file uploads
                                                        $targetDir = "uploads/dm/";
                                                        foreach ($_FILES['images']['name'] as $key => $val) {
                                                            $targetFilePath = $targetDir . basename($_FILES['images']['name'][$key]);
                                                            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                                                            if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetFilePath)) {
                                                                $sqlImage = "INSERT INTO staff_dm_graphics_images (allocation_id, file_name, uploaded_on) VALUES (?, ?, NOW())";
                                                                if ($stmtImage = $connection->prepare($sqlImage)) {
                                                                    $stmtImage->bind_param("is", $last_id, $targetFilePath);
                                                                    $stmtImage->execute();
                                                                    $stmtImage->close();
                                                                }
                                                            }
                                                        }

                                                        // Redirect to the next page
                                                        // header("Location: add-Graphics-Staff-details.php");
                                                        // Redirect back to the parent page with the necessary parameters
                                                        header("Location: add-Graphics-Staff-details.php?orderid=$orderid&from=change");
                                                        exit;
                                                    } else {
                                                        echo "Error: " . $stmt->error;
                                                        header("Location: add-Graphics-Staff-details.php?orderid=$orderid&from=change");
                                                        exit;
                                                    }

                                                    // Close statement
                                                    $stmt->close();
                                                } else {
                                                    echo "Error: " . $connection->error;
                                                }
                                            }

                                            ?>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>






                    <!-- POST-1 OPEN -->

                    <!-- /POST-1 CLOSED -->
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
    <a href="#top" id="back-to-top"><i class="fe fe-arPOST-up"></i></a>

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
    <!-- <script src="add-graphics-details.js"></script> -->
    <script src="notification.js"></script>
    <script src="../assets/js/imageupload.js"></script>



</body>

</html>