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
function showworklist()
{
    global $connection;
    $query = "select * from staff_dm_graphics_allocation where staffid='" . $_SESSION['empid'] . "' order by id desc";
    $select_posts = mysqli_query($connection, $query);
    $i = 0;
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $id = $row['id'];
        $post_orderid = $row['orderid'];
        $queryorder = "select * from order_customers where id='" .  $post_orderid . "' and order_status='Active'";
        $select_postsorder = mysqli_query($connection, $queryorder);
        while ($roworder = mysqli_fetch_assoc($select_postsorder)) {

            $post_brandName = $roworder['brandName'];
            $post_postings = $row['postings'];
            $post_content = $row['content'];
            $post_idea = $row['posteridea'];
            $post_assigndate = $row['assigndate'];
           
            $post_assignstaffid = $row['assigned_staffid'];

            $queryemp = "select * from employee where id='" .  $post_assignstaffid . "'";
            $select_postsemp = mysqli_query($connection, $queryemp);
            while ($rowemp = mysqli_fetch_assoc($select_postsemp)) {
                $post_empname = $rowemp['empname'];
            }
            // $queryemp = "select * from employee where id='" .  $_SESSION['empid'] . "'";
            // $select_postsemp = mysqli_query($connection, $queryemp);
            // while ($rowemp = mysqli_fetch_assoc($select_postsemp)) {
            //     $post_hod = $rowemp['hod'];
            // }

            $post_workstatus = $row['work_status'];

            $i = $i + 1;
            echo "<tr>";
            echo "<td>$i</td>";
            echo "<td>$post_brandName</td>";
            echo "<td>$post_postings</td>";
            echo "<td>$post_empname</td>";
            echo "<td>$post_assigndate</td>";

            if ($post_workstatus === 'Active') {
                echo "<td><span class='badge bg-success' style='font-size:15px'>$post_workstatus</span></td>";
            }
            if ($post_workstatus === 'Closed') {
                echo "<td><span class='badge bg-danger' style='font-size:15px'>$post_workstatus</span></td>";
            }

          

            echo "<td>";
            
                echo "<a class='btn btn-sm btn-blue' href='add-gdsub-work-details.php?workid={$id}' title='Enter Work Details' style='color:white;font: weight 200px;'>
        <span class='fe fe-edit'> </span></a> &nbsp;";
           
            echo "<a class='btn btn-sm btn-gray-dark  view-details-btn'   data-bs-target='#viewmodal' data-bs-toggle='modal' data-recordid={$id} title='View work Details' style='color:white;font: weight 200px;'>
        <span class='fe fe-eye'> </span></a>";
            echo "</td>";



            echo "</tr>";
        }
    }
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

    <!---bootstrap css-->
    <link id="style" href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="../assets/css/icons.css" rel="stylesheet">

    <!---Style css-->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!---Plugins css-->
    <link href="../assets/css/plugins.css" rel="stylesheet">

    <!-- Switcher css -->
    <link href="../assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="../assets/switcher/demo.css" rel="stylesheet">

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
                    <div class="page-header">
                        <div>
                            <h2 class="main-content-title tx-24 mg-b-5">Work List</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Digital Marketers</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Assigned Works</li>
                            </ol>
                        </div>
                        <div class="btn-list">
                            <!-- <a class="btn ripple btn-success" href="add-lead.php"><i class="fe fe-external-link"></i> &nbsp;&nbsp; Add New Lead</a> -->

                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="card-header border-bottom-0 p-0">
                                        <h6 class="card-title mb-1">List of Works</h6>
                                        <p class="text-muted card-sub-title"><?php echo $_SESSION['empname'] ?> , These are the List of works assigned by Digital Marketers.</p>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="example1">
                                            <thead style="background-color:beige;">
                                                <tr>
                                                    <!-- class="wd-5p" -->
                                                    <th>#</th>
                                                    <th>Brand Name</th>
                                                    <th>Postings</th>
                                                    <th>Work Assigned By</th>
                                                    <th>Assigned Date</th>
                                                    <th>Work Status</th>
                                                    <!-- <th>Redirect Status</th> -->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                showworklist();
                                                ?>



                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Row -->


                </div>
            </div>
        </div>
        <!-- End Main Content-->
        <!-- Basic modal -->
        <div class="modal fade" id="staffmodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Redirect Graphics Work</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" class="form-control" id="modalrecordid" name="modalrecordid" required>
                            <div class="col-md-6">
                                <label class="form-label" for="modalgraph">Graphic Designers :</label>

                                <select class="form-select" name="modalgraph" id="modalgraph" required>
                                    <option value="" disabled selected>Select Employee</option>
                                    <?php
                                    $sql = "SELECT * FROM department where dname='Graphics'";
                                    $result = $connection->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($rowdept = $result->fetch_assoc()) {
                                            $sqlemp = "SELECT * FROM employee where department_id='" . $rowdept['id']  . "' and hod=''";
                                            $resultemp = $connection->query($sqlemp);
                                            if ($resultemp->num_rows > 0) {
                                                while ($rowemp = $resultemp->fetch_assoc()) {
                                                    $staffid = $rowemp['id'];
                                                    echo "<option value='" . $staffid . "'>" . $rowemp['empname'] . "</option>";
                                                }
                                            }
                                        }
                                    }


                                    ?>

                                </select>


                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="modaldeadline">Deadline :</label>
                                <input type="date" class="form-control" id="modaldeadline" name="modaldeadline" placeholder="">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="savestaffChangesBtn" type="button">Assign Work</button>
                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                    </div>
                </div>
            </div>

        </div>

     

        <div class="modal fade" id="viewmodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">View Graphics Work Details</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label" for="postercontent">Poster Content :</label>
                                <textarea class="form-control" name="postercontent" id="postercontent" rows="5" readonly> </textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="posteridea">Poster Idea :</label>
                                <textarea class="form-control"  name="posteridea" id="posteridea" rows="5" readonly> </textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="pdeadline">Deadline Assigned :</label>
                                <input class="form-control"  type="text" id="pdeadline" name="pdeadline" value="" readonly>
                            </div>
                           

                        <!-- </div> -->
                    </div>
                    <div class="modal-footer">
                       
                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                    </div>
                </div>
            </div>

        </div></div>
        <!-- End Basic modal -->

        <!-- Main Footer-->
        <?php include 'includes/footer.php'; ?>
        <!--End Footer-->

    </div>
    <!-- Back-to-top -->
    <a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

    <!-- Jquery js-->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap js-->
    <script src="../assets/plugins/bootstrap/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Select2 js-->
    <script src="../assets/plugins/select2/js/select2.min.js"></script>

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

    <!-- Perfect-scrollbar js-->
    <script src="../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/plugins/perfect-scrollbar/p-scroll-1.js"></script>

    <!-- Sidemenu js-->
    <script src="../assets/plugins/sidemenu/sidemenu.js"></script>

    <!-- Sidebar js-->
    <script src="../assets/plugins/sidebar/sidebar.js"></script>

    <!-- Sticky js-->
    <script src="../assets/js/sticky.js"></script>
    <!-- Select2 js-->
    <script src="../assets/plugins/select2/js/select2.min.js"></script>
    <script src="../assets/js/select2.js"></script>
    <!-- Custom-Switcher js -->
    <script src="../assets/js/custom-switcher.js"></script>

    <!-- Custom js-->
    <script src="../assets/js/custom.js"></script>

    <!-- Switcher js -->
    <script src="../assets/switcher/js/switcher.js"></script>
    <script src="notification.js"></script>
    <script>
        function confirmationDelete(anchor) {
            var conf = confirm('Are you sure want to delete this record?');
            if (conf)
                window.location = anchor.attr("href");
        }
    </script>
    <script>
        $(document).ready(function() {

            // Triggered when the modal is about to be shown
            $('#staffmodal').on('show.bs.modal', function(e) {
                // Extract the data-recordid attribute value from the button
                var recordId = $(e.relatedTarget).data('recordid');

                // Set the value of the input box in the modal
                $('#modalrecordid').val(recordId);
            });


            $('#savestaffChangesBtn').on('click', function() {
                // Get values from the modal inputs
                var recordId = $('#modalrecordid').val();
                var selectedEmployeeId = $('#modalgraph').val();
                var deadline = $('#modaldeadline').val();

                // Create an object with the data to be sent to the server
                var dataToSend = {
                    recordId: recordId,
                    selectedEmployeeId: selectedEmployeeId,
                    deadline: deadline
                };

                // Send an AJAX request to the server to save the data
                $.ajax({
                    type: 'POST',
                    url: 'gd-redirectworksave.php', // Replace with the actual path to your PHP script
                    data: dataToSend,
                    success: function(response) {
                        // Handle the success response from the server
                        console.log('Data saved successfully:', response);
                        alert("Succesfully Redirected Work.");
                        // Optionally, you can close the modal after saving
                        $('#staffmodal').modal('hide');

                        window.location.href = 'gdworklist.php';
                    },
                    error: function(error) {
                        // Handle the error response from the server
                        console.error('Error saving data:', error);
                    }
                });
            });

            $('.view-details-btn').on('click', function () {
                var recordId = $(this).data('recordid');

                // Make AJAX request to fetch data based on recordId
                $.ajax({
                    type: 'POST',
                    url: 'gd-viewworkdetails.php', // Replace with the actual path to your PHP script
                    data: { recordId: recordId },
                    dataType: 'json',
                    success: function (response) {
                        // Populate fields in viewmodal
                       
                        $('#postercontent').val(response.content);
                        $('#posteridea').val(response.posteridea);
                        $('#pdeadline').val(response.deadline);
                       
                        // Add similar lines for other fields
                    },
                    error: function (error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });

        });
    </script>
</body>

</html>