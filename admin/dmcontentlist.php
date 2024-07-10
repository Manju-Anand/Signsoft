<?php
session_start();

if (!isset($_SESSION['adminname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
}

include "includes/connection.php";
function showorderlist()
{
    global $connection;
    $query = "select * from staff_dm_graphics_allocation where redirect_recordid = '' order by id desc";
    $select_posts = mysqli_query($connection, $query);
    $i = 0;
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $id = $row['id'];
        $post_assignedstaffid= $row['assigned_staffid'];

        $sql = "SELECT * FROM employee where id='" . $post_assignedstaffid . "'";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
        while($row1 = $result->fetch_assoc()) {
            $post_assignedstaffname= $row1['empname'];
        }}

        $post_gdstaffid= $row['staffid'];
        $sql1 = "SELECT * FROM employee where id='" . $post_gdstaffid . "'";
        $result1 = $connection->query($sql1);
        if ($result1->num_rows > 0) {
        while($row2 = $result1->fetch_assoc()) {
            $post_gdstaffname= $row2['empname'];
        }}

        $post_orderid = $row['orderid'];
        $sql = "SELECT * FROM order_customers where id='" . $post_orderid . "'";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
        while($row1 = $result->fetch_assoc()) {
            $post_brandName= $row1['brandName'];
        }}

        $post_redirect_status = $row['redirect_status'];
        $post_deadline = $row['deadline'];
        $post_assigndate = $row['assigndate'];
        $post_postings = $row['postings'];
        $i = $i + 1;
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>$post_assignedstaffname</td>";
        echo "<td>$post_brandName</td>";
        echo "<td>$post_postings</td>";
        echo "<td>$post_assigndate</td>";
        echo "<td>$post_gdstaffname</td>"; 
        if($post_redirect_status == "Redirected"){
            echo "<td>$post_redirect_status</td>"; 
        }else {
            echo "<td></td>";
        }
        echo "<td>$post_deadline </td>";
 
        echo "<td><a class='btn btn-sm btn-cyan  view-details-btn'   data-bs-target='#viewmodal' data-bs-toggle='modal' data-recordid={$id} title='View DM Content &  Details' style='color:white'>
        <span class='fe fe-eye'> </span></a>&nbsp;<a class='btn btn-sm btn-success edit-details-btn' data-bs-target='#editmodal' data-bs-toggle='modal' data-recordid={$id} title='Edit DM Content' style='color:white'>
        <span class='fe fe-edit'> </span></a>&nbsp;</a>
        </td>";

        // <a class='btn btn-sm btn-danger' onclick='javascript:confirmationDelete($(this));return false;' href='orderlist.php?delete={$id}' class='text-inverse' id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'>
        // <span class='fe fe-trash-2'> </span>
   

        echo "</tr>";
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
                            <h2 class="main-content-title tx-24 mg-b-5">DM Content List</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">DM Content</li>
                            </ol>
                        </div>
                        <div class="btn-list">
                            <!-- <a class="btn ripple btn-primary" href="javascript:void(0);"><i class="fe fe-external-link"></i> Export</a> -->
                            <!-- <a class="btn ripple btn-success" href="add-order.php"><i class="fe fe-external-link"></i> &nbsp;&nbsp; Add New Order</a> -->
                            <!-- <a class="btn ripple btn-info" href="javascript:void(0);"><i class="fe fe-help-circle"></i> Help</a>
						<a class="btn ripple btn-danger dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown"
							aria-haspopup="true" aria-expanded="true">
							<i class="fe fe-settings"></i> Settings <i class="fa fa-caret-down ms-1"></i>
						</a>
						<div class="dropdown-menu tx-13">
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

                    <!-- Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="card-header border-bottom-0 p-0">
                                        <h6 class="card-title mb-1">List of DM Contents</h6>
                                        <!-- <p class="text-muted card-sub-title">Searching, ordering and paging goodness will be
										immediately added to the table, as shown in this example.</p> -->
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="example3">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>DM Staff Name</th>
                                                    <th>Brand Name</th>
                                                    <th>Postings</th>
                                                    <th>Assign Date</th>
                                                    <th>Assigned To</th>
                                                    <th>Redirected Status</th>
                                                    <th>Deadline</th>
                                                    <th>Action</th>
                                                   
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                showorderlist();
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
        <div class="modal fade" id="editmodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Content</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                    <input type="hidden" class="form-control" id="modaleditid" name="modaleditid" required>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label" for="editpostercontent">Poster Content :</label>
                                <textarea class="form-control" name="editpostercontent" id="editpostercontent" rows="5" > </textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="editposteridea">Poster Idea :</label>
                                <textarea class="form-control" name="editposteridea" id="editposteridea" rows="5" > </textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-primary" id="updatecontent" data-bs-dismiss="modal" type="button">Update Content</button>
                            <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        </div>
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
                                <textarea class="form-control" name="posteridea" id="posteridea" rows="5" readonly> </textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="pdeadline">Deadline Assigned by DM:</label>
                                <input class="form-control" type="text" id="pdeadline" name="pdeadline" value="" readonly>
                            </div>
                            <h4>Redirected Work Details [ If Any ]</h4>
                            <div class="col-md-6">
                                <label class="form-label" for="redirectstaff">Redirected to :</label>
                                <!-- <input class="form-control"  type="text" id="redirectstaff" name="redirectstaff" value="" readonly> -->
                                <select class="form-select" name="redirectstaff" id="redirectstaff" readonly>
                                    <?php
                                    $sql = "SELECT * FROM department where dname='Graphics'";
                                    $result = $connection->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($rowdept = $result->fetch_assoc()) {
                                            $sqlemp = "SELECT * FROM employee where department_id='" . $rowdept['id']  . "' and hod='No'";
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
                                <label class="form-label" for="redirectdeadline">Redirected Deadline :</label>
                                <input class="form-control" type="text" id="redirectdeadline" name="redirectdeadline" value="" readonly>
                            </div>

                            <!-- </div> -->
                        </div>
                        <div class="modal-footer">

                            <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
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
            <script>

                


            $('.view-details-btn').on('click', function() {
                var recordId = $(this).data('recordid');

                // Make AJAX request to fetch data based on recordId
                $.ajax({
                    type: 'POST',
                    url: 'gd-viewworkdetails.php', // Replace with the actual path to your PHP script
                    data: {
                        recordId: recordId
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Populate fields in viewmodal
                        var isReadOnly = true; // Set this based on your condition
                        document.getElementById('redirectstaff').disabled = isReadOnly;
                        var newOptionValue = response.redirect_staffid;
                        $('#redirectstaff').val(newOptionValue);
                        $('#postercontent').val(response.content);
                        $('#posteridea').val(response.posteridea);
                        $('#pdeadline').val(response.deadline);
                        // $('#redirectstaff').val(response.redirect_staffid);
                        $('#redirectdeadline').val(response.redirect_deadline);
                        // Add similar lines for other fields
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });

            $('.edit-details-btn').on('click', function() {
                var recordId = $(this).data('recordid');

                // Make AJAX request to fetch data based on recordId
                $.ajax({
                    type: 'POST',
                    url: 'gd-viewworkdetails.php', // Replace with the actual path to your PHP script
                    data: {
                        recordId: recordId
                    },
                    dataType: 'json',
                    success: function(response) {
                                            
                        $('#modaleditid').val(recordId);
                        $('#editpostercontent').val(response.content);
                        $('#editposteridea').val(response.posteridea);
                       
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });

            $('#updatecontent').on('click', function() {
                // Get values from the modal inputs
                var recordId = $('#modaleditid').val();
                var editpostercontent = $('#editpostercontent').val();
                var editposteridea = $('#editposteridea').val();

                // Create an object with the data to be sent to the server
                var dataToSend = {
                    recordId: recordId,
                    editpostercontent: editpostercontent,
                    editposteridea: editposteridea
                };

                // Send an AJAX request to the server to save the data
                $.ajax({
                    type: 'POST',
                    url: 'gd-contentupdate.php', // Replace with the actual path to your PHP script
                    data: dataToSend,
                    success: function(response) {
                        // Handle the success response from the server
                        console.log('Data saved successfully:', response);
                        alert("Succesfully Updated Content.");
                        // Optionally, you can close the modal after saving
                        $('#editmodal').modal('hide');

                        window.location.href = 'dmcontentlist.php';
                    },
                    error: function(error) {
                        // Handle the error response from the server
                        console.error('Error saving data:', error);
                    }
                });
            });
            </script>
</body>

</html>