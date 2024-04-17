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

function isDateLessThanOneDayFromToday($dateString) {
    $givenDate = new DateTime($dateString);
    $currentDate = new DateTime();
    
    // Calculate the difference between the dates
    $interval = $currentDate->diff($givenDate);
    
    // Check if the difference is less than 1 day
    // 
    return ($interval->days < 1);
}
if(isset($_GET['delete']))
{
    $the_cat_id = $_GET['delete'];
    $query="DELETE FROM dailyworkstatus WHERE id = '". $the_cat_id ."'";
    $delete_query=mysqli_query($connection,$query);
     if(!$delete_query)
       {
           die('QUERY FAILED' . mysqli_error($connection));
       }
    $query="DELETE FROM dailyworkentry WHERE dailyworkstatus_id = '". $the_cat_id ."'";
    $delete_query=mysqli_query($connection,$query);
    if(!$delete_query)
        {
            die('QUERY FAILED' . mysqli_error($connection));
        }   
    header("Location: dailyworkstatus.php");
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
    <style>
        .disabled-li {
            color: #999;
            /* Change the color to visually indicate it's disabled */
            pointer-events: none;
            /* Prevent interactions */
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
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5">Empty Page</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
							<li class="breadcrumb-item active" aria-current="page">Empty Page</li>
						</ol>
					</div>
					<div class="btn-list">
						<a class="btn ripple btn-primary" href="javascript:void(0);"><i class="fe fe-external-link"></i> Export</a>
						<a class="btn ripple btn-secondary" href="javascript:void(0);"><i class="fe fe-download"></i> Download</a>
						<a class="btn ripple btn-info" href="javascript:void(0);"><i class="fe fe-help-circle"></i> Help</a>
						<a class="btn ripple btn-danger dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown"
							aria-haspopup="true" aria-expanded="true">
							<i clss="fe fe-settings"></i> Settings <i class="fa fa-caret-down ms-1"></i>
						</a>
						
					</div>
				</div>
				<!-- End Page Header -->

				<!-- Row -->
				<div class="row sidemenu-height">
					<div class="col-lg-12">
						<div class="card custom-card">
							<div class="card-body">
                            <div class="table-responsive">
                                        <table class="table" id="example1">
                                        <!--  class="table table-striped table-hover table-bordered elegant-table1"<table id="customer-info-detail-3" class="table style-3 table-bordered  table-hover">   -->
                                        <thead>
                                            <tr>
                                                <th class="">#</th>
                                                <th class="">Work Date</th>
                                                <th class="">Status</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $startDate = "";
                                            $workDate = "";
                                            // Create an array to store looped dates
                                            $dateArray = array();
                                            $sqlwsdate = "SELECT * FROM activedate LIMIT 1";
                                            $resultwsdate = $connection->query($sqlwsdate);
                                            if ($resultwsdate->num_rows > 0) {
                                                while ($rowwsdate = $resultwsdate->fetch_assoc()) {
                                                    $startDate = strtotime($rowwsdate['adate']);
                                                  
                                                    $workDate1 = strtotime(date("d-m-Y"));
                                                    // $workDate = strtotime('-1 day', $workDate1);// check upto yesterday date
                                                    
                                                     $workDate =$workDate1;
                                                }
                                            }
                                            // Loop through the dates between the start date and work date
                                            $i = 0;
                                            for ($currentDate = $workDate; $currentDate >= $startDate; $currentDate = strtotime('-1 day', $currentDate)) {
                                                // for ($currentDate = $startDate; $currentDate <= $workDate; $currentDate = strtotime('+1 day', $currentDate)) {

                                                $sqlwsdate1 = "SELECT * FROM dailyworkstatus where work_date ='" . date('d-m-Y', $currentDate)  . "' and emp_id = '" . $_SESSION['empid'] . "'";
                                                $resultwsdate1 = $connection->query($sqlwsdate1);
                                                if ($resultwsdate1->num_rows > 0) {
                                                 
                                                    while ($rowwsdate1 = $resultwsdate1->fetch_assoc()) {
                                                     
                                                        $id= $rowwsdate1['id'];
                                                        $i = $i + 1;
                                            ?>
                                                        <tr>
                                                            <td class="text-primary"><?php echo $i ?></td>

                                                            <td><?php echo $rowwsdate1['work_date']; ?></td>
                                                            <td>Done</td>
                                                            <td class="text-center">
                                                                <ul class="table-controls">
                                                                <?php if (isDateLessThanOneDayFromToday($rowwsdate1['work_date'])) { ?>
                                                                    <li>
                                                                      <a class='btn btn-sm btn-blue bs-tooltip' href='dailyworkentryedit.php?edit=<?php echo $rowwsdate1['id']?>' title='You Can Edit Now !' data-toggle="tooltip" data-placement="top" style='color:white'>
                                                                    <span class='fe fe-edit'> </span></a> &nbsp;
                                                               
                                                                    <a onclick="javascript:confirmationDelete($(this));return false;"  class='btn btn-sm btn-danger delete-staff-btn bs-tooltip' data-toggle="tooltip" data-placement="top" href="dailyworkstatus.php?delete=<?php echo  $id; ?>" id='qusdelete' title='You Can Delete Now !' data-toggle='tooltip' style='color:white'>    
                                                                    <span class='fe fe-trash-2'> </span></a>
                                                                </li>
                                                                <?php } else { ?>
                                                                    <li class="disabled-li"><a href="javascript:void(0);" class="btn btn-sm btn-blue bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><span class='fe fe-edit'> </span></a>&nbsp;
                                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><span class='fe fe-trash-2'> </span></a></li>
                                                                <?php } ?>

                                                                </ul>
                                                            </td>
                                                        </tr>





                                                    <?php
                                                    }
                                                } else {
                                                    $i = $i + 1;
                                                    ?>

                                                    <tr>
                                                        <td class="text-primary"><?php echo $i ?></td>

                                                        <td><?php echo date('d-m-Y', $currentDate) ?></td>
                                                        <td>Not Done</td>
                                                        <td class="text-center">
                                                            <ul class="table-controls">

                                                            <?php if (isDateLessThanOneDayFromToday(date('d-m-Y', $currentDate))) { ?>
                                                         
                                                             <li><a href="daily_work_entry.php" class="btn btn-sm btn-blue bs-tooltip" data-toggle="tooltip" data-placement="top" title="" title="You Can Add Now !"><span class='fe fe-edit'> </span></a></li>
                  
                                                            
                                                                    <!--<li><a href="dailyworkentry_editnewdate.php?param1=<?php echo date('d-m-Y', $currentDate) ?>&param2=<?php echo $_SESSION['empid'] ?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="You Can Edit Now !"><i class="flaticon-edit  p-1 br-6 mb-1"></i></a></li>-->
                                                                  <?php } else { ?>
                                                                    <li class="disabled-li"><a href="javascript:void(0);" class="btn btn-sm btn-blue bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><span class='fe fe-edit'> </span></a> &nbsp;
                                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><span class='fe fe-trash-2'> </span></a></li>
                                                                <?php } ?>



                                                                <!-- <li class="disabled-li"><a href="javascript:void(0);" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="flaticon-edit  p-1 br-6 mb-1"></i></a></li> -->
                                                                <!-- <li class="disabled-li"><a href="javascript:void(0);" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="flaticon-delete  p-1 br-6 mb-1"></i></a></li> -->
                                                            </ul>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }




                                            ?>


                                            <?php  ?>



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

	<!-- Perfect-scrollbar js-->
	<script src="../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="../assets/plugins/perfect-scrollbar/p-scroll-1.js"></script>

	<!-- Sidemenu js-->
	<script src="../assets/plugins/sidemenu/sidemenu.js"></script>

	<!-- Sidebar js-->
	<script src="../assets/plugins/sidebar/sidebar.js"></script>
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
	<!-- Sticky js-->
	<script src="../assets/js/sticky.js"></script>

	<!-- Custom-Switcher js -->
	<script src="../assets/js/custom-switcher.js"></script>

	<!-- Custom js-->
	<script src="../assets/js/custom.js"></script>

	<!-- Switcher js -->
	<script src="../assets/switcher/js/switcher.js"></script>
    <script src="notification.js"></script>

</body>

</html>
