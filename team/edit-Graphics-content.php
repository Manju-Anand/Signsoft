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
                                            <h2 class="main-content-title tx-24 mg-b-5" ;">Edit Graphics Designers Content</h2>
                                            <span class="mt-2">You can Edit Graphics Designers Content here.</span>


                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="panel panel-primary">
                                        <form method="post" enctype="multipart/form-data">
                                            <input type="hidden" id="editid" name="editid" value="<?php echo isset($_POST['editid']) ? htmlspecialchars($_POST['editid']) : ''; ?>" readonly>
                                            <input type="hidden" id="orderid" name="orderid" value="<?php echo isset($_POST['orderid']) ? htmlspecialchars($_POST['orderid']) : ''; ?>" readonly>
                                            <input type="hidden" id="empid" name="empid" value="<?php echo isset($_POST['empid']) ? htmlspecialchars($_POST['empid']) : ''; ?>" readonly>


                                            <div class="row mb-4">



                                                <div class="col-md-6">
                                                    <label class="form-label" for="postings">Postings :</label>
                                                    <select class="form-select mb-3" name="postings" id="postings" required>
                                                        <option value="Poster" <?php echo (isset($_POST['postings']) && $_POST['postings'] == 'Poster') ? 'selected' : ''; ?>>Poster</option>
                                                        <option value="Video" <?php echo (isset($_POST['postings']) && $_POST['postings'] == 'Video') ? 'selected' : ''; ?>>Video</option>
                                                        <option value="GIF" <?php echo (isset($_POST['postings']) && $_POST['postings'] == 'GIF') ? 'selected' : ''; ?>>GIF</option>

                                                    </select>

                                                    <label class="form-label" for="content">Content :</label>
                                                    <textarea class="form-control" name="content" id="content" rows="7" style="margin-bottom: 10px;"><?php echo isset($_POST['content']) ? htmlspecialchars($_POST['content']) : ''; ?></textarea>





                                                </div>

                                                <div class="col-md-6">

                                                    <label class="form-label" for="idea">Idea :</label>
                                                    <textarea class="form-control" name="idea" id="idea" rows="2" style="margin-bottom: 10px;"><?php echo isset($_POST['idea']) ? htmlspecialchars($_POST['idea']) : ''; ?></textarea>

                                                    <label class="form-label" for="deadline">Deadline :</label>
                                                    <input type="date" class="form-control mb-3" id="deadline" name="deadline" placeholder="" value="<?php echo isset($_POST['deadline']) ? htmlspecialchars($_POST['deadline']) : ''; ?>" required>

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
                                              
                                            
                                                // Initialize variables
                                                $assigndate = date("d-m-Y");
                                                $posting = $_POST['postings'];
                                                $content =   $_POST['content'];
                                                // $content = mysqli_real_escape_string($connection, $_POST['content']);
                                                $idea = $_POST['idea'];
                                                $deadline1 = $_POST['deadline'];
                                                $orderid = $_POST['orderid'];
                                                $empid = $_POST['empid'];
                                                $editid = $_POST['editid'];
                                            
                                                // Convert deadline to d-m-Y format
                                                if (!empty($deadline1)) {
                                                    $date = DateTime::createFromFormat('Y-m-d', $deadline1);
                                                    if ($date) {
                                                        $deadline = $date->format('d-m-Y');
                                                    } else {
                                                        echo "Invalid date format!";
                                                        exit;
                                                    }
                                                } else {
                                                    echo "No date provided!";
                                                    exit;
                                                }
                                            
                                                // Get current date and time
                                                date_default_timezone_set("Asia/Calcutta");
                                                $postdate = date("M d,Y h:i:s a");
                                            
                                                // Get staff id from the department table
                                                $sql = "SELECT * FROM department WHERE dname='Graphics'";
                                                $result = $connection->query($sql);
                                                if ($result->num_rows > 0) {
                                                    while ($rowdept = $result->fetch_assoc()) {
                                                        $sqlemp = "SELECT * FROM employee WHERE department_id='" . $rowdept['id'] . "' AND hod='Yes'";
                                                        $resultemp = $connection->query($sqlemp);
                                                        if ($resultemp->num_rows > 0) {
                                                            while ($rowemp = $resultemp->fetch_assoc()) {
                                                                $staffid = $rowemp['id'];
                                                            }
                                                        }
                                                    }
                                                }
                                            
                                                // Insert main data into the staff_dm_graphics_allocation table
                                                // $sql = "INSERT INTO staff_dm_graphics_allocation (orderid, staffid, postings, content, status, assigndate, work_status, created, assigned_staffid, redirect_status, posteridea, deadline) VALUES (?, ?, ?, ?, 'New', ?, 'Active', ?, ?, 'Self', ?, ?)";
                                               
                                                $sql = "UPDATE staff_dm_graphics_allocation SET orderid=?, staffid=?, postings=?, content=?, assigndate=?, status='Edited', modified=?, assigned_staffid=?, redirect_status='Self', posteridea=?, deadline=? WHERE id=?";
                                                     if ($stmt = $connection->prepare($sql)) {
                                                        $stmt->bind_param("sssssssssi", $orderid, $staffid, $posting, $content, $assigndate, $postdate, $empid, $idea, $deadline, $editid);
                                                        if ($stmt->execute()) {
                                                        
                                            
                                                        // Handle file uploads
                                                        $targetDir = "uploads/dm/";
                                                        $uploadedImages = array();
                                            
                                                        foreach ($_FILES['images']['name'] as $key => $val) {
                                                            $targetFilePath = $targetDir . basename($_FILES['images']['name'][$key]);
                                                            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                                                            if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetFilePath)) {
                                                                // Insert each uploaded image into the images_table
                                                                $sqlImage = "INSERT INTO staff_dm_graphics_images (allocation_id, file_name, uploaded_on) VALUES (?, ?, NOW())";
                                                                if ($stmtImage = $connection->prepare($sqlImage)) {
                                                                    $stmtImage->bind_param("is", $editid, $targetFilePath);
                                                                    $stmtImage->execute();
                                                                    $stmtImage->close();
                                                                }
                                            
                                                                // Store uploaded image details for displaying in the table
                                                                $uploadedImages[] = array('id' => $editid, 'file' => $targetFilePath);
                                                            }
                                                        }
                                            
                                                        // Redirect to the next page or display success message
                                                        // header("Location: add-Graphics-Staff-details.php");
                                                        // exit;
                                                        header("Location: add-Graphics-Staff-details.php?orderid=$orderid&from=change");
                                                        exit;
                                                    } else {
                                                        echo "Error: " . $stmt->error;
                                                        header("Location: add-Graphics-Staff-details.php?orderid=$orderid&from=change");
                                                        exit;
                                                    }
                                                    $stmt->close();
                                                } else {
                                                    echo "Error: " . $connection->error;
                                                }
                                            }
                                            



                                            // Delete image if delete button is clicked
                                            if (isset($_GET['delete_id'])) {
                                                $delete_id = $_GET['delete_id'];
                                                // Fetch file name to be deleted
                                                $sqlFetchFileName = "SELECT file_name FROM staff_dm_graphics_images WHERE id = ?";
                                                if ($stmtFetchFileName = $connection->prepare($sqlFetchFileName)) {
                                                    $stmtFetchFileName->bind_param("i", $delete_id);
                                                    $stmtFetchFileName->execute();
                                                    $stmtFetchFileName->store_result();
                                                    if ($stmtFetchFileName->num_rows > 0) {
                                                        $stmtFetchFileName->bind_result($fileToDelete);
                                                        $stmtFetchFileName->fetch();
                                                        $stmtFetchFileName->close();

                                                        // Delete file from uploads folder
                                                        if (unlink($fileToDelete)) {
                                                            // Delete record from images_table
                                                            $sqlDeleteImage = "DELETE FROM staff_dm_graphics_images WHERE id = ?";
                                                            if ($stmtDeleteImage = $connection->prepare($sqlDeleteImage)) {
                                                                $stmtDeleteImage->bind_param("i", $delete_id);
                                                                if ($stmtDeleteImage->execute()) {
                                                                    // Record deleted successfully
                                                                     // Redirect to the next page
                                                                    header("Location: add-Graphics-Staff-details.php");
                                                                } else {
                                                                    echo "Error deleting record: " . $stmtDeleteImage->error;
                                                                }
                                                                $stmtDeleteImage->close();
                                                            } else {
                                                                echo "Error preparing delete statement: " . $connection->error;
                                                            }
                                                        } else {
                                                            echo "Error deleting file: " . $fileToDelete;
                                                        }
                                                    } else {
                                                        echo "File not found in database!";
                                                    }
                                                } else {
                                                    echo "Error fetching file name: " . $connection->error;
                                                }
                                            }

                                            ?>


                                            <div class="container">
                                                <h2>Uploaded Images</h2>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Image</th>
                                                            <th>Uploaded On</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php

                                                        $sqlFetchImages = "SELECT * FROM staff_dm_graphics_images WHERE allocation_id = ?";
                                                        if ($stmtFetchImages = $connection->prepare($sqlFetchImages)) {
                                                            $stmtFetchImages->bind_param("s", $_POST['editid']); // Use $last_id or the appropriate allocation ID
                                                            $stmtFetchImages->execute();
                                                            $resultFetchImages = $stmtFetchImages->get_result();


                                                            // Loop through fetched images and display them in table rows
                                                            while ($rowImage = $resultFetchImages->fetch_assoc()) {
                                                                echo "<tr>";
                                                                echo "<td><img src='" . htmlspecialchars($rowImage['file_name']) . "' height='100'></td>";
                                                                echo "<td>" . htmlspecialchars($rowImage['uploaded_on']) . "</td>";
                                                                echo "<td><button class='btn btn-danger btn-sm' onclick=\"confirmDeletion('?delete_id=" . htmlspecialchars($rowImage['id']) . "')\">Delete</button></td>";

                                                                // echo "<td><a href='?delete_id=" . htmlspecialchars($rowImage['id']) . "' class='btn btn-danger btn-sm'>Delete</a></td>";
                                                                echo "</tr>";
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>


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
    <script>
        function confirmDeletion(deleteUrl) {
            if (confirm("Are you sure you want to delete this image?")) {
                window.location.href = deleteUrl;
            }
        }
    </script>


</body>

</html>