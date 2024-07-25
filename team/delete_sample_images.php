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
$empid = isset($_SESSION['empid']) ? $_SESSION['empid'] : '';
$mainorderid = "";

// Function to fetch and delete images
function fetchAndDeleteImages($connection, $deleteIds) {
    $deletedCount = 0;
    $fileToDelete ="";
    foreach ($deleteIds as $delete_id) {
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
                            $deletedCount++;
                        } else {
                            echo "Error deleting record: " . $stmtDeleteImage->error;
                        }
                        $stmtDeleteImage->close();
                    } else {
                        echo "Error preparing delete statement: " . $connection->error;
                    }
                } else {
                    echo "Error deleting file: $fileToDelete<br>";
                }
            } else {
                echo "File not found in database!<br>";
            }
        } else {
            echo "Error fetching file name: " . $connection->error;
        }
    }
    return $deletedCount;
}

// Handle POST request for deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_images'])) {
    $deleteIds = $_POST['delete_images'];
    $deletedCount = fetchAndDeleteImages($connection, $deleteIds);
    echo "Deleted $deletedCount images successfully.";
    exit; // Stop further execution
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
    <link href="../assets/css/style.css?v=1.0.1" rel="stylesheet">

    <!--- Plugins css -->
    <link href="../assets/css/plugins.css" rel="stylesheet">

    <!-- Switcher css -->
    <link href="../assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="../assets/switcher/demo.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/imageupload.css">


</head>

<body class="app sidebar-mini">


    <!-- Page -->
    <div class="page">
        <div>
            <?php include 'includes/header.php'; ?>
        </div>

        <!-- Main Content-->
        <div class="main-content side-content pt-100">
            <div class="side-app">

                <div class="main-container container-fluid">

                    <!-- Page Header -->

                    <!-- End Page Header -->
                    <div class="POST">
                        <div class="col-md-12">
                            <div class="card custom-card mt-3" id="right">
                                <div class="card-header rounded-bottom-0">

                                    <div class="POST">
                                        <div class="col-md-12">
                                            <h2 class="main-content-title tx-24 mg-b-5" ;">Delete Sample Images from Graphics Designers Content</h2>
                                            <span class="mt-2">You can Delete Graphics Designers sample images here.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="panel panel-primary">
                                        <form method="post" id="deleteForm">
                                            <div class="container">
                                            <h4 style="text-decoration: underline;">Sample Images</h4>
                                              
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="ml-2">
                                                            <input type="checkbox" onclick="toggleAll(this)"> Select All
                                                        </label>
                                                    </div>
                                                    <div class="col-md-8 d-flex justify-content-md-end">
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteSelected()">Delete Selected</button>
                                                    </div>
                                                </div>

                                              
                                                <table class="table table-bordered"  id="example1">
                                                    <thead>
                                                        <tr>
                                                        <th>Delete</th>
                                                            <th>Image</th>
                                                            <th>Uploaded On</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        // $sqlFetchImages = "SELECT * FROM staff_dm_graphics_images ORDER BY id ASC";
                                                        $sqlFetchImages = "SELECT * FROM staff_dm_graphics_images where allocation_id IN(select id  from staff_dm_graphics_allocation where assigned_staffid='$empid')  ORDER BY id DESC";
                                                        if ($stmtFetchImages = $connection->prepare($sqlFetchImages)) {
                                                            $stmtFetchImages->execute();
                                                            $resultFetchImages = $stmtFetchImages->get_result();

                                                            while ($rowImage = $resultFetchImages->fetch_assoc()) {
                                                                echo "<tr>";
                                                                echo "<td><input type='checkbox' name='delete_images[]' value='" . htmlspecialchars($rowImage['id']) . "'></td>";
                                                                echo "<td><img src='" . htmlspecialchars($rowImage['file_name']) . "' height='100'></td>";
                                                                echo "<td>" . htmlspecialchars($rowImage['uploaded_on']) . "</td>";
                                                                
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

                    <!-- Main Footer-->
                    <?php include 'includes/footer.php'; ?>
                    <!--End Footer-->

                </div>
            </div>
        </div>
        <!-- End Main Content-->

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

    <!-- INTERNAL File-Uploads Js-->
    <script src="../assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
    <script src="../assets/plugins/fancyuploder/jquery.fileupload.js"></script>
    <script src="../assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
    <script src="../assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
    <script src="../assets/plugins/fancyuploder/fancy-uploader.js"></script>
<!-- DATA TABLE JS-->
<script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
            <script src="../assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
            <script src="../assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
            <script src="../assets/js/table-data.js"></script>
            <script src="../assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
            <script src="../assets/plugins/datatable/js/jszip.min.js"></script>
            <script src="../assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
            <script src="../assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
            <script src="../assets/plugins/datatable/js/buttons.html5.min.js"></script>
            <script src="../assets/plugins/datatable/js/buttons.print.min.js"></script>
            <script src="../assets/plugins/datatable/js/buttons.colVis.min.js"></script>
            <script src="../assets/plugins/datatable/dataTables.responsive.min.js"></script>
            <script src="../assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
    <!-- Custom js-->
    <script src="../assets/js/custom.js"></script>

    <!-- Switcher js -->
    <script src="../assets/switcher/js/switcher.js"></script>

    <!-- Function to toggle all checkboxes -->
    <script>
        function toggleAll(source) {
            checkboxes = document.getElementsByName('delete_images[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = source.checked;
            }
        }

        // Function to handle delete action
        function deleteSelected() {
            var checkedBoxes = document.querySelectorAll('input[name="delete_images[]"]:checked');
            var deleteIds = [];
            checkedBoxes.forEach(function(checkbox) {
                deleteIds.push(checkbox.value);
            });

            if (deleteIds.length === 0) {
                alert('Please select at least one image to delete.');
                return;
            }

            if (confirm("Are you sure you want to delete the selected images?")) {
                $.ajax({
                    type: 'POST',
                    url: window.location.href,
                    data: { delete_images: deleteIds },
                    success: function(response) {
                        alert(response); // Show success message or handle as needed
                        location.reload(); // Reload the page to reflect changes
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting images:', error);
                        alert('Error deleting images. Please try again later.');
                    }
                });
            }
        }
    </script>

</body>

</html>
