<?php
ob_start();
session_start();

// if (!isset($_SESSION['empname'])) {
//     $_SESSION['msg'] = "You must log in first";
//     header('location: signin.php');
// }

// if (isset($_GET['logout'])) {
//     session_destroy();
//     unset($_SESSION['empname']);
//     header("location: signin.php");
// }

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            var currentDate = new Date();
            var currentMonth = currentDate.getMonth() + 1;
            // $('#month-select').val(currentMonth);
            // fetchData(currentMonth);
            // Function to fetch data from the database
            function fetchData(month, selectedYear) {
                var selectedempname = $('#empname').val();
                // Assuming you have a server-side script (e.g., PHP) to handle the database query
                $.ajax({
                    type: "POST",
                    url: "worktracker_fetch_data.php",
                    data: {
                        month: month,
                        syear: selectedYear,
                        empid : selectedempname
                    },
                    success: function(response) {
                        // Process the retrieved data
                        console.log(response);
                        var data = JSON.parse(response);
                       // Access the first object in the 'headings' array
                        var firstHeading = data.checking[0];

                        if (firstHeading.exist === "yes") {
                            createTable(data);
                        } else {
                            $('#htmlgrid').empty();
                            $('#htmlgrid1').empty();
                            alert("No Work Details Entered for this Month");
                        }
                    }
                });
            }

            // Function to create the HTML table
            function createTable(data) {
                // Clear any existing table
                $('#htmlgrid').empty();
                $('#htmlgrid1').empty();
                // Create table header
                var headerRow = "<tr><th style='position: sticky; left: 0; background: white; z-index: 1;'>Questions</th>";
                for (var i = 0; i < data.rows.length; i++) {
                    // headerRow += "<th>" + data.rows[i].day + "<br>" + data.rows[i].weekday + "</th>";
                    headerRow += "<th>" + data.rows[i].day + "</th>";
                }
                headerRow += "</tr>";


                // Append the table header row
                $('#htmlgrid').append(headerRow);

                // Create table rows with data, ist coulmn qustions and second one '0'
                for (var i = 0; i < data.questions.length; i++) {
                    var r = "R" + i;
                    if (data.questions[i].subquestion == ""){
                    var rowData = "<tr id='" + r + "'><td  style='position: sticky; left: 0; background: white;text-align:left'>" + data.questions[i].question + "</td>";
                    } else {
                        var rowData = "<tr id='" + r + "' style='background-color:#FAFFC7;'><td style='position: sticky; left: 0;background-color:#FAFFC7;text-align:right;'>" + data.questions[i].subquestion + "</td>";
                    }
                    for (var j = 0; j < data.rows.length; j++) {

                        // =========================================check ans for qustion id=======
                        // Find the corresponding answer for the current question and day
                        var questionId = data.questions[i].qid;
                        var subquestionId = data.questions[i].subqid;
                        var workdate = data.rows[j].day;
                        var answer = "";
                        for (var k = 0; k < data.answers.length; k++) {
                         
                            if (data.answers[k].qid === questionId && data.answers[k].subqid === subquestionId && data.answers[k].workdate === workdate) {
                                answer = data.answers[k].answers;
                                break;
                            }
                        }

                        rowData += "<td>" + answer + "</td>";
                        // rowData += "<td contenteditable='true'>" + data.rows[i].data[j] + "</td>";
                    }
                    rowData += "</tr>";

                    // Append each row to the table
                    $('#htmlgrid').append(rowData);
                }
                // =========================showing aggrgate table
                // Clear any existing table
                $('#htmlgrid1').empty();
                 // Create table header
                 var headerRow = "<tr><th >Questions</th><th >Total</th>";
                                headerRow += "</tr>";
                // Append the table header row
                $('#htmlgrid1').append(headerRow);
                 // Create table rows with data, ist coulmn qustions and second one '0'
                 for (var i = 0; i < data.aggregate.length; i++) {
                    var rowData = "<tr><td>" + data.aggregate[i].question + "</td>";
                    rowData += "<td>" +  data.aggregate[i].count + "</td>";
                    rowData += "</tr>";
                    $('#htmlgrid1').append(rowData);
                 }
               

                // =================================================
            }

            // Event handler for month selection change
            // $('#month-select').on('change', function() {
            //     console.log("Month select changed");
            //     var selectedempname = $('#empname').val();
            //     console.log(selectedempname);
            //     if (selectedempname === null){
            //         alert("select Employee first");
            //     }
            //     else {
            //         var selectedMonth = $(this).val();
            //     fetchData(selectedMonth);
            //     }
            // });
                        $('#showresult').on('click', function() {
                console.log("Month select changed");
                var selectedempname = $('#empname').val();
                console.log(selectedempname);
                if (selectedempname === null) {
                    alert("select Employee first");
                } else {
                    var selectedMonth = $('#month-select').val();
                    var selectedYear = $('#year-select').val();
                    if (selectedMonth === null) {
                        alert("select Month");
                    } else {

                        fetchData(selectedMonth, selectedYear);
                    }
                }
            });
        });
    </script>
    <style>
        .disabled-li {
            color: #999;
            /* Change the color to visually indicate it's disabled */
            pointer-events: none;
            /* Prevent interactions */
        }
        .hidden {
            display: none;
        }
    </style>
    <style>
        /* Apply styles to the table container */
        .table-container {
            width: 100%;
            overflow-x: auto; /* Enable horizontal scrollbar */
            overflow-y: auto; /* Enable horizontal scrollbar */
            scrollbar-width: thick; /* Set the scrollbar width */
        }

       /* Webkit browsers (Chrome, Safari) */
       .table-container::-webkit-scrollbar {
            width: 500px; 
            height:20px;
        }
        /* Webkit browsers (Chrome, Safari) */


.table-container::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px; 
}

.table-container::-webkit-scrollbar-thumb:hover {
    background: #555; 
}
        /* Apply styles to the entire table */
        #htmlgrid {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
            margin-top: 20px;
            table-layout: fixed; /* Allow automatic column width adjustment */
            /* overflow: auto;  */
        }

        /* Apply styles to table header cells */
        #htmlgrid th {
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
            font-weight: bold;

            width: 100px;

        }
        #htmlgrid th:first-child, 
        #htmlgrid td:first-child {
            width: 300px;
            border-left: 1px solid #ffcc00; 
            border-right: 1px solid #ffcc00; 
            border-top: 1px solid #ffcc00; 
            border-bottom: 1px solid #ffcc00; 
        }
        /* Apply styles to table data cells */
        #htmlgrid td {
            border: 1px solid #ccc;
            padding: 15px;
            text-align: center; 
            word-wrap: break-word; 
        }

        /* Apply alternating row colors for better readability */
        #htmlgrid tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Apply hover effect on table rows */
        #htmlgrid tr:hover {
            background-color: #e0e0e0;
        }

        .elegant-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
            background-color: #fff;
            margin: 20px auto;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .elegant-table th,
        .elegant-table td {
            padding: 10px 15px;
            text-align: left;
        }

        .elegant-table thead {
            background-color: #f9f9f9;
        }

        .elegant-table th {
            font-weight: bold;
            border-bottom: 2px solid #ccc;
        }

        .elegant-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .elegant-table tbody tr:hover {
            background-color: #e0e0e0;
            cursor: pointer;
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
						<h2 class="main-content-title tx-24 mg-b-5">Work Tracker Viewer</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
							<li class="breadcrumb-item active" aria-current="page">view work details</li>
						</ol>
					</div>
					<div class="btn-list">
						<a class="btn ripple " style="background-color:#FAFFC7;"><i class="fe fe-external-link"></i> Indicates SubQuestion</a>
					
						
					</div>
				</div>
				<!-- End Page Header -->
                    <div class="card custom-card">
							<div class="card-body">
                                <div class="row">
                                        <div class="col-md-3">
                                            <label for="designation" class="form-label">Select Employee</label>
                                            <select class="form-select mb-3" id="empname" name="empname" required>
                                                <option value="" disabled selected>Select Employee</option>
                                                <?php
                                                $query = "select * from employee  where status='Active'  order by id desc";
                                                $select_posts = mysqli_query($connection, $query);
                                                while ($row = mysqli_fetch_assoc($select_posts)) {
                                                ?>
                                                    <option value="<?php echo $row['id'] ?>" data-questions="<?php echo $row['id']; ?>" data-ans="<?php echo $row['empname']; ?>"><?php echo $row['empname'] ?></option>
                                                <?php } ?>


                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="designation" class="form-label">Select Month</label>
                                            <select id="month-select" name="month-select" class="form-select mb-3" required>
                                            <option value="" disabled selected>Select Month</option>
                                                <option value="1">January</option>
                                                <option value="2">February</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                                <!-- ... Add options for other months ... -->
                                            </select>
                                            <!-- <h5 class="card-title mb-0">Questions List</h5> -->
                                        </div>
                                           <div class="col-md-3">
                                            <label for="designation" class="form-label">Select Year</label>
                                            <select id="year-select" name="year-select" class="form-select mb-3" required>
                                                <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                                <option value="2027">2027</option>
                                                <option value="2028">2028</option>
                                                <option value="2029">2029</option>
                                                <option value="2030">2030</option>

                                                <!-- ... Add options for other months ... -->
                                            </select>
                                            <!-- <h5 class="card-title mb-0">Questions List</h5> -->
                                        </div>
                                        <div class="col-md-3">

                                            <button type="button" id="showresult" class="btn btn-outline-secondary waves-effect waves-light" style="margin-top:28px;width:250px">Show Work Details</button>
                                        </div>
                                </div>
                            </div>
                    </div>
				<!-- Row -->
				<div class="row sidemenu-height">
					<div class="col-lg-12">
						<div class="card custom-card">
							<div class="card-body">
                            <!-- <div class="table-responsive"> -->
                                <!-- $id = "example1"; -->
                                <div class="table-container">
                                <table id="htmlgrid" class="table nowrap align-middle" 
                                style="width:100%;">

                                </table>
                                </div>
                                <!-- </div> -->
							</div>
						</div>
					</div>
                    <div class="col-lg-12">
						<div class="card custom-card">
							<div class="card-body">
                            <h5>Aggregate</h5>
                            <style>
                                        .table-wrapper {
                                            overflow-x: auto;
                                        }

                                        #htmlgrid1 {
                                            border-collapse: collapse;
                                            width: 100%;
                                            max-width: 800px;
                                            margin: 0 auto;
                                        }

                                        #htmlgrid1 th,
                                        td {
                                            padding: 10px;
                                            text-align: center;
                                            border: 1px solid #ddd;
                                        }

                                        #htmlgrid1 th {
                                            background-color: #3498db;
                                            color: white;
                                        }

                                        #htmlgrid1 tr:nth-child(even) {
                                            background-color: #f2f2f2;
                                        }

                                        #htmlgrid1 tr:hover {
                                            background-color: #e0e0e0;
                                        }
                                    </style>
                                <div class="table-responsive">
                                <!-- $id = "example1"; -->
                                <!-- <div class="table-wrapper"> -->

                                    <table id="htmlgrid1" class="table nowrap align-middle elegant-table" style="width:100%">

                                    </table>

<!-- </div> -->
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
    <script>
        // JavaScript to select the current month
        document.addEventListener('DOMContentLoaded', function() {
            var currentMonth = new Date().getMonth() + 1; // getMonth() returns month index (0-11), so add 1
            var monthSelect = document.getElementById('month-select');
            monthSelect.value = currentMonth; // Set the value to the current month
        });
    </script>
</body>

</html>
