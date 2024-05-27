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

$currentMonth = date('m'); // Get the current month (as '01' for January, '02' for February, etc.)

function showorderlist($currentMonth)
{
    global $connection;
    // $query = "select * from staff_pjob_allocation order by id desc";
    // 
    
    // $query = "SELECT * FROM staff_pjob_allocation WHERE MONTH(assigndate) = '$currentMonth' ORDER BY id DESC";
    $query = "SELECT * FROM staff_pjob_allocation WHERE SUBSTRING(assigndate, 4, 2) = '$currentMonth' ORDER BY id DESC";
     $select_posts = mysqli_query($connection, $query);
    $i = 0;
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $id = $row['id'];

        $post_jobname="";
        $sqljob = "SELECT * FROM process_jobs where id='" . $row['jobid'] . "'";
        $resultjob = $connection->query($sqljob);
        if ($resultjob->num_rows > 0) {
        while($rowjob = $resultjob->fetch_assoc()) {
            $post_jobname= $rowjob['jobname'];
        }}
       
        $post_staffname="";
                $sql1 = "SELECT * FROM employee where id='" . $row['empid'] . "'";
                $result1 = $connection->query($sql1);
                if ($result1->num_rows > 0) {
                while($row2 = $result1->fetch_assoc()) {
                    $post_staffname= $row2['empname'];
            }
        }
                $post_timetaken=0;
                $sql1 = "SELECT * FROM staff_pjob_allocation_details where staff_allocation_id ='" . $id . "'";
                $result1 = $connection->query($sql1);
                if ($result1->num_rows > 0) {
                while($row2 = $result1->fetch_assoc()) {
                    $post_timetaken += timeToDecimal($row2['timetaken']);
                }}

                $post_description="";
                $post_workstatus="";
                $sql1 = "SELECT * FROM staff_pjob_allocation_details where staff_allocation_id ='" . $id . "' order by id desc limit 1";
                $result1 = $connection->query($sql1);
                if ($result1->num_rows > 0) {
                while($row2 = $result1->fetch_assoc()) {
                    $post_description=$row2['job_description'];
                    $post_workstatus=$row2['work_status'];
                }}
            

       
            $post_deadline = $row['deadline'];
            $post_assigndate = $row['assigndate'];
      
        $i = $i + 1;
        echo "<tr>";
        echo "<td>$i</td>";
      
        echo "<td>$post_staffname</td>";
        echo "<td>$post_jobname</td>";

        echo "<td>$post_workstatus</td>";
        echo "<td>$post_description</td>";
      
        
        echo "<td>$post_timetaken</td>";
        echo "<td>$post_assigndate</td>"; 
        echo "<td>$post_deadline</td>"; 
        
 
        echo "<td><a class='btn btn-sm btn-cyan view-details-btn'   data-bs-target='#viewmodal' data-bs-toggle='modal' data-recordid={$id}  title='View Process Job Details' style='color:white'>
        <span class='fe fe-eye'> </span></a>&nbsp;
        </td>";

        // <a class='btn btn-sm btn-success edit-details-btn' data-bs-target='#editmodal' data-bs-toggle='modal' data-recordid={$id} title='Edit DM Content' style='color:white'>
        // <span class='fe fe-edit'> </span></a>&nbsp;</a>
        echo "</tr>";
    }
}

// Function to convert HH:MM to decimal hours
function timeToDecimal($time) {

    list($hours, $minutes) = explode(':', $time);
    return $hours + ($minutes / 60);
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
                            <h2 class="main-content-title tx-24 mg-b-5">Process Job Work Details</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Work Details List</li>
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
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4 class="card-title mb-1">List of Process Job work Details</h4>
                                            </div>
                                            <div class="col-md-8">
                                           
                                                    <label for="designation" class="form-label">Select Month</label>
                                                    <select id="month-select" name="month-select" class="form-select mb-3" required onchange="filterOrders()">
                                                    <option value="" disabled selected>Select Month</option>
                                                        <option value="01">January</option>
                                                        <option value="02">February</option>
                                                        <option value="03">March</option>
                                                        <option value="04">April</option>
                                                        <option value="05">May</option>
                                                        <option value="06">June</option>
                                                        <option value="07">July</option>
                                                        <option value="08">August</option>
                                                        <option value="09">September</option>
                                                        <option value="10">October</option>
                                                        <option value="11">November</option>
                                                        <option value="12">December</option>
                                                        <!-- ... Add options for other months ... -->
                                                    </select>
                                                    <!-- <h5 class="card-title mb-0">Questions List</h5> -->
                                            
                                            </div>
                                        </div>
                                       
                                        
                                    </div>
                                    
                                    <div class="table-responsive">

                                        <table class="table" id="example3">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                   
                                                    <th>Staff</th>
                                                    <th>Process Job</th>
                                                    <th>Work Status</th>
                                                    <th>Description</th>
                                                    <th>Total Work Hours</th>
                                                    <th>Assign Date</th>
                                                    <th>Deadline</th>
                                                   
                                                    <th>Action</th>
                                                   
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $currentMonth = date('m');
                                                showorderlist($currentMonth);
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
        
        <div class="modal fade" id="viewmodal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">View Work Details</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            
                           
                         
                            <div class="col-md-12">
                            <div class="table-responsive mt-20">
                                        <table class="table table-bordered mg-b-0" id="workdetails">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                   <th>Work Date</th>
                                                   <th>Work Description</th>
                                                    <th>Time Taken</th>
                                                    <th>Work Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                           </tbody>
                                        </table>
                                    </div>

                        </div></div>
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
            <!-- <script src="../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script> -->
            <!-- <script src="../assets/plugins/perfect-scrollbar/p-scroll-1.js"></script> -->

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
                alert(recordId);
                // var redirectId = $(this).data('redirectid');
                // Make AJAX request to fetch data based on recordId
                $.ajax({
                    type: 'POST',
                    url: 'web-viewprocessjobworkdetails.php', // Replace with the actual path to your PHP script
                    data: {
                        recordId: recordId,
                        // redirectId: redirectId
                    },
                    dataType: 'json',
                    success: function(response) {
                        //


                        // Clear existing rows in the workdetails table
                        $('#workdetails tbody').empty();

                        // Display data from the second table (staff_dm_graphics_allocation_details)
                        if (response.details && response.details.length > 0) {
                            for (var i = 0; i < response.details.length; i++) {
                                j=i+1;
                                var newRow = '<tr>' +
                                    '<td>' + j + '</td>' +
                                    '<td>' + response.details[i].workdate + '</td>' +
                                    '<td>' + response.details[i].timetaken + '</td>' +
                                    '<td>' + response.details[i].work_status + '</td>' +
                                    // Add similar lines for other columns in staff_dm_graphics_allocation_details
                                    '</tr>';

                                // Append the new row to the workdetails table
                                $('#workdetails tbody').append(newRow);
                            }
                        } else {
                            // No details data available
                            $('#workdetails tbody').html('<tr><td colspan="3">No details available.</td></tr>');
                        }

                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });

            $('.view-details-btn123').on('click', function() {
                var recordId = $(this).data('recordid');
               alert (recordId);
                // Make AJAX request to fetch data based on recordId
                $.ajax({
                    type: 'POST',
                    url: 'web-viewprocessjobworkdetails.php', // Replace with the actual path to your PHP script
                    data: {
                        recordId: recordId,
                        
                    },
                    // dataType: 'json',
                    success: function(response) {
                        // Populate fields in viewmodal
                     
                       
                 


                        // Clear existing rows in the workdetails table
                        $('#workdetails tbody').empty();

                        // Display data from the second table (staff_dm_graphics_allocation_details)
                        if (response.details && response.details.length > 0) {
                            for (var i = 0; i < response.details.length; i++) {
                                j=i+1;
                                var newRow = '<tr>' +
                                    '<td>' + j + '</td>' +
                                    '<td>' + response.details[i].workdate + '</td>' +
                                    '<td>' + response.details[i].job_description + '</td>' +
                                    '<td>' + response.details[i].timetaken + '</td>' +
                                    
                                    '<td>' + response.details[i].work_status + '</td>' +
                                    // Add similar lines for other columns in staff_dm_graphics_allocation_details
                                    '</tr>';

                                // Append the new row to the workdetails table
                                $('#workdetails tbody').append(newRow);
                            }
                        } else {
                            // No details data available
                            $('#workdetails tbody').html('<tr><td colspan="3">No details available.</td></tr>');
                        }

                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });

            
            </script>
            <script>
    // Get the current month
    var currentMonth = new Date().getMonth() + 1; // JavaScript months are zero-based, so add 1

    // Set the selected option in the select box
    document.getElementById("month-select").value = currentMonth;

    function filterOrders() {
    var monthselect = document.getElementById('month-select').value;

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_processjob_data.php?monthselect=' + monthselect, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.querySelector('#example3 tbody').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
</script>
</body>

</html>