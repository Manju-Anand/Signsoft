<?php
session_start();

// if (!isset($_SESSION['adminname'])) {
//     $_SESSION['msg'] = "You must log in first";
//     header('location: signin.php');
// }

// if (isset($_GET['logout'])) {
//     session_destroy();
//     unset($_SESSION['adminname']);
//     header("location: signin.php");
// }

include "includes/connection.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<meta name="description" content="Dashlead - Admin Panel HTML Dashboard Template">
	<meta name="author" content="Spruko Technologies Private Limited">
	<meta name="keywords"
		content="sales dashboard, admin dashboard, bootstrap 5 admin template, html admin template, admin panel design, admin panel design, bootstrap 5 dashboard, admin panel template, html dashboard template, bootstrap admin panel, sales dashboard design, best sales dashboards, sales performance dashboard, html5 template, dashboard template">

	<!-- Favicon -->
	<link rel="icon" href="../assets/img/brand/favicon.ico" type="image/x-icon">

	<!-- Title -->
	<title>Dashlead - Admin Panel HTML Dashboard Template</title>

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
        /* table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        } */
        select {
            width: 100%;  
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
							<i class="fe fe-settings"></i> Settings <i class="fa fa-caret-down ms-1"></i>
						</a>
						<div class="dropdown-menu tx-13">
							<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-eye me-2 float-start"></i>View</a>
							<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-plus-circle me-2 float-start"></i>Add</a>
							<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-mail me-2 float-start"></i>Email</a>
							<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-folder-plus me-2 float-start"></i>Save</a>
							<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-trash-2 me-2 float-start"></i>Remove</a>
							<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-settings me-2 float-start"></i>More</a>
						</div>
					</div>
				</div>
				<!-- End Page Header -->

				<!-- Row -->
				<div class="row sidemenu-height">
					<div class="col-lg-12">
						<div class="card custom-card">
							<div class="card-body">
                            <table class="table table-bordered border text-nowrap mb-0" id="new-edit123">
    <thead>
        <tr>
            <th style="width:400px;">Column 1</th>
            <th style="width:400px;">Select Option</th>
            <th style="width:400px;">Column 3</th>
            <th style="width:400px;">Column 4</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td contenteditable="true"></td>
            <td>
                <select>
                    <option>Joel</option>
                    <option>Siji</option>
                    <!-- Options will be dynamically populated using JavaScript -->
                </select>
            </td>
            <td contenteditable="true"></td>
            <td contenteditable="true"></td>
        </tr>
    </tbody>
</table>

<button id="saveButton">Save Data</button>
							</div>
						</div>
					</div>
				</div>
				<!-- End Row -->

			</div>
		</div>
		</div>
		<!-- End Main Content-->

		<!-- Sidebar -->

		<!-- End Sidebar -->

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
<!-- INTERNAL Edit-Table JS -->
<script src="../assets/plugins/edit-table/bst-edittable.js"></script>
	<script src="../assets/plugins/edit-table/edit-table.js"></script>
	<!-- Sidebar js-->
	<script src="../assets/plugins/sidebar/sidebar.js"></script>

	<!-- Sticky js-->
	<script src="../assets/js/sticky.js"></script>

	<!-- Custom-Switcher js -->
	<script src="../assets/js/custom-switcher.js"></script>

	<!-- Custom js-->
	<script src="../assets/js/custom.js"></script>

	<!-- Switcher js -->
	<script src="../assets/switcher/js/switcher.js"></script>
    <script>
 document.getElementById('new-edit123').addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        addRowAndFocus();
    }
});

function addRowAndFocus() {
    var table = document.getElementById('new-edit123');
    var tbody = table.getElementsByTagName('tbody')[0];
    var newRow = tbody.insertRow(tbody.rows.length);

    // Copy the styles from the first row's cells
    var firstRow = table.rows[1]; // Assuming there is at least one existing row
    for (var i = 0; i < firstRow.cells.length; i++) {
        var cell = newRow.insertCell(i);

        if (i === 1) {
            var select = document.createElement('select');
            populateSelectOptions(select);
            cell.appendChild(select);
        } else {
            var contentCell = document.createElement('td');
            contentCell.style.width = 400 + 'px';
            contentCell.style.boxSizing = 'border-box';
            contentCell.style.border = firstRow.cells[i].style.border;
            contentCell.contentEditable = true; // Ensure contenteditable is set
            cell.appendChild(contentCell);
        }
    }

    // Set focus on the first contenteditable cell of the new row
    var firstContentEditableCell = newRow.cells[0].querySelector('[contenteditable="true"]');
    firstContentEditableCell.focus();
    setSelectionRange(firstContentEditableCell);
}

// Function to set selection range for the contenteditable cell
function setSelectionRange(contentEditableElement) {
    var range = document.createRange();
    var sel = window.getSelection();
    range.selectNodeContents(contentEditableElement);
    range.collapse(false);
    sel.removeAllRanges();
    sel.addRange(range);
}
// This code ensures that the width of the contenteditable cells in the new row matches the width of the corresponding cells in the first row, making them the same.
//  The setSelectionRange function is added to set the cursor at the end of the contenteditable cell when focusing. 



function populateSelectOptions(selectElement) {
        // Fetch data from the database using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_options.php', true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                var optionsData = JSON.parse(xhr.responseText);

                optionsData.forEach(function (optionValue) {
                    var option = document.createElement('option');
                    option.value = optionValue;
                    option.text = optionValue;
                    selectElement.appendChild(option);
                });
            }
        };

        xhr.send();
    }


document.getElementById('saveButton').addEventListener('click', function () {
    saveDataToDatabase();
});


function saveDataToDatabase() {
    var table = document.getElementById('new-edit123');
    var data = [];

    // Iterate through rows and cells to collect data
    for (var i = 1; i < table.rows.length; i++) {
        var row = table.rows[i];
        var rowData = [];

        for (var j = 0; j < row.cells.length; j++) {
            var cell = row.cells[j];
            var cellData = (j === 1) ? cell.querySelector('select').value : cell.textContent.trim();
            rowData.push(cellData);
        }

        data.push(rowData);
    }

    // Send data to the server using AJAX (Assuming you have jQuery available)
    $.ajax({
        type: 'POST',
        url: 'dm_contentsave.php', // Replace with your PHP script URL
        data: { data: JSON.stringify(data) },
        success: function(response) {
            console.log('Data sent successfully:', response);
            // Handle any further actions on success
        },
        error: function(error) {
            console.error('Error sending data:', error);
            // Handle errors
        }
    });
}

</script>

</body>

</html>
