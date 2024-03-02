
// **************************start edit & delete table rows for staff table**********************************
// Add a click event listener for the "Edit" buttons

$('body').on('click', '.edit-staff-btn', function () {

    //    $('#modalpostings').select2();
    //    $('#modalpostings123').select2();

    // Get the corresponding row
    var row = $(this).closest('tr');

    // Extract values from the row
    var workdate = row.find('td:eq(1)').text(); // Replace 1 with the actual column index
    var worktime = row.find('td:eq(2)').text(); // Replace 2 with the actual column index
    var workstatus = row.find('td:eq(3)').text(); // Replace 2 with the actual column index
    // var recordstatus = row.find('td:eq(5)').text(); // Replace 2 with the actual column index
    var allotid = row.find('td:eq(6)').text(); // Replace 3 with the actual column index
    var orderid = row.find('td:eq(7)').text(); // Replace 4 with the actual column index
    var editid = row.find('td:eq(8)').text(); // Replace 4 with the actual column index
    var staffrowId = row.data('rowid'); // Assuming you have a data-rowid attribute on your row
    // alert (workdate);
    var workdate = row.find('td:eq(1)').text(); // Assuming the format is 'dd-mm-YYYY'
    var dateParts = workdate.split('-');
    var formattedDate = dateParts[2] + '-' + dateParts[1].padStart(2, '0') + '-' + dateParts[0].padStart(2, '0');

    $('#modalworkdate').val(formattedDate);
    // Set values in the modal

    $('#modalworkstatus').val(workstatus);
    $('#modalworktime').val(worktime);
    $('#modalallotid').val(allotid);
    $('#modalorderid').val(orderid);
    // Set the value of the new textbox
    $('#modalstaffrowid').val(staffrowId);
    $('#modaleditid').val(editid);
    // Trigger the modal to display
    $('#staffmodal').modal('show');
});

$('body').on('click', '.delete-staff-btn', function () {
    // Get the corresponding row
    var row = $(this).closest('tr');

    // Extract the row data id
    var rowId = row.data('rowid');
    $('#paystatus').val('Payment edited');
    // Confirmation dialog before deleting
    if (confirm("Are you sure you want to delete this row?")) {
        // Perform the delete action (you can replace this with your actual deletion logic)
        row.remove();

        // Here you can also add code to perform additional actions, such as making an AJAX request to delete the row from the server.

        // Optionally, update the numbering in the first column of remaining rows
        updatestaffRowNumbers();
    }
});

function updatestaffRowNumbers() {
    // Update the numbering in the first column of each remaining row
    $('#staffallocateTable tbody tr').each(function (index, element) {
        $(element).find('td:eq(0)').text(index + 1);
    });
}

var rowCounter = 0; // Move the initialization here
// Find the maximum row number in the existing table rows
function findMaxstaffRowNumber() {
    // alert("increment");
    // Find the maximum row number in the existing table rows
    $('#staffallocateTable tbody tr').each(function (index, element) {
        var currentRowNumber = parseInt($(element).find('td:eq(0)').text(), 10);
        rowCounter = Math.max(rowCounter, currentRowNumber);
    });
}
function addstaffRow() {
    // Call the function to find the maximum row number
    findMaxstaffRowNumber();

    var table = document.getElementById("staffallocateTable");
    var tbody = table.getElementsByTagName("tbody")[0]; // Get the tbody element

    // Get the values from the dropdowns
    var timetakenValue = document.getElementById("timetaken").value;
    var workstatusValue = document.getElementById("workstatus").value;
    // Check if both timetaken and workstatus are selected
    if (timetakenValue && workstatusValue) {

        var newRow = tbody.insertRow(tbody.rows.length); // Insert row into tbody

        // Generate a unique identifier for the row
        var rowId = "row_" + (new Date().getTime()); // You can use a more robust method based on your needs

        // Numbering Column
        var cell1 = newRow.insertCell(0);

        cell1.innerHTML = ++rowCounter; // Increment before setting the innerHTML
        // Set the unique identifier as a data attribute
        newRow.setAttribute('data-rowid', rowId);
        // Select Box 1
        var cell2 = newRow.insertCell(1);
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var yyyy = today.getFullYear();
        
        today = dd + '-' + mm + '-' + yyyy ;
        cell2.innerHTML = today;




        var cell3 = newRow.insertCell(2);
        var selectBox1 = document.getElementById("timetaken");
        cell3.innerHTML = selectBox1.value;

        // Select Box 1
        var cell4 = newRow.insertCell(3);
        var selectBox1 = document.getElementById("workstatus");
        cell4.innerHTML = selectBox1.options[selectBox1.selectedIndex].text;

        // New cell with Edit and Delete buttons  ===========href='edit-supplier.php?edit=" + ++rowCounter + "'---onclick='javascript:confirmationDelete($(this));return false;
        var cell5 = newRow.insertCell(4);
        cell5.innerHTML = "<a class='btn btn-sm btn-primary edit-staff-btn'  data-bs-target='#staffmodal' data-bs-toggle='modal' title='Edit' style='color:white'>" +
            "<span class='fe fe-edit'> </span></a>&nbsp;&nbsp;" +
            "<a class='btn btn-sm btn-danger delete-staff-btn'  id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'>" +
            "<span class='fe fe-trash-2'> </span></a>";
        // Text Box 3
        var cell6 = newRow.insertCell(5);
        cell6.innerHTML = "New";
         cell6.classList.add('hidden-cell');

        // Text Box 3
        var cell7 = newRow.insertCell(6);
        var textBox1 = document.getElementById("allotid");
        cell7.innerHTML = textBox1.value;  // Set the content of the cell to be empty
        cell7.classList.add('hidden-cell');

        var cell8 = newRow.insertCell(7);
        var textBox1 = document.getElementById("orderid");
        cell8.innerHTML = textBox1.value;  // Set the content of the cell to be empty
        cell8.classList.add('hidden-cell');

        var cell9 = newRow.insertCell(8);
               cell9.innerHTML = "";  // Set the content of the cell to be empty
        cell9.classList.add('hidden-cell');


        // Clear input values after adding to the table
       

       
        selectBox1.selectedIndex = -1;
    } else {
        // If either timetaken or workstatus is not selected, show an alert or handle it accordingly
        alert('Please select both timetaken and workstatus.');
    }
}


$('#savestaffChangesBtn').on('click', function () {
    // Get the values from the modal fields
    // var modalworkdate = $('#modalworkdate').val();
  
    var modalworktime = $('#modalworktime').val();
    var modalworkstatus = $('#modalworkstatus option:selected').text();
    var modalallotid = $('#modalallotid').val();
    var modalorderid = $('#modalorderid').val();
    var modaleditid = $('#modaleditid').val();

    var modalworkdate = $('#modalworkdate').val();

// Convert the date to a JavaScript Date object
var dateObject = new Date(modalworkdate);

// Format the date to "dd-mm-yyyy"
var formattedDate = ("0" + dateObject.getDate()).slice(-2) + "-" + ("0" + (dateObject.getMonth() + 1)).slice(-2) + "-" + dateObject.getFullYear();

    var pstatus = "Edited";
    $('#paystatus').val('Payment edited');
    // Get the selected row in the table (assuming it has an id, adjust as needed)
    var selectedRowId = $('#modalstaffrowid').val(); // Update this to the actual input or method to get the row ID

    // Update the corresponding row in the table
    var selectedRow = $('#staffallocateTable tbody tr[data-rowid="' + selectedRowId + '"]');
    selectedRow.find('td:eq(1)').text(formattedDate); // Update with the correct column indices.
    selectedRow.find('td:eq(2)').text(modalworktime); // Update with the correct column indices.
    selectedRow.find('td:eq(3)').text(modalworkstatus); // Update with the correct column indices
    // selectedRow.find('td:eq(4)').text(staffValueid); // Update with the correct column indices
    selectedRow.find('td:eq(5)').text(pstatus); // Update with the correct column indices
    selectedRow.find('td:eq(6)').text(modalallotid); // Update with the correct column indices
    selectedRow.find('td:eq(7)').text(modalorderid); // Update with the correct column indices
    selectedRow.find('td:eq(8)').text(modaleditid); // Update with the correct column indices
   
    // Hide the modal
    $('#staffmodal').modal('hide');
});


// ************* end staff details ****************





// ============start data saving code================================
function saveDataToDatabase() {
    var empid = document.getElementById("empid").value;


    // **********staff allocation details *********************

    var table1 = document.getElementById("staffallocateTable");
    var rows1 = table1.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
    console.log("hai staff  :" + rows1)
    var staffallocationdataToSave = [];

    // Iterate through each row
    for (var i = 0; i < rows1.length; i++) {
        console.log(i);
        var row = rows1[i];
        var cells = row.getElementsByTagName("td");

        var rowData1 = {
            workdate: cells[1].innerHTML, // Adjust the index based on your table structure
            worktime: cells[2].innerHTML, // Adjust the index based on your table structure
            workstatus: cells[3].innerHTML, // Adjust the index based on your table structure
            recordstatus: cells[5].innerHTML, // Adjust the index based on your table structure
            allotid: cells[6].innerHTML, // Adjust the index based on your table structure
            orderid: cells[7].innerHTML, // Adjust the index based on your table structure
            empid: empid,
            editid: cells[8].innerHTML,

        };

        staffallocationdataToSave.push(rowData1);
    }
    console.log("check this :" + rowData1);
    // ==============================================
    // Combine the two arrays into a single object for the AJAX request
    var combinedData = {
        staffallocationdataToSave: staffallocationdataToSave,

    };

    // Send data to the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "save-gd-work-details-staff.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Handle the response from the server if needed
                console.log("result: " + xhr.responseText);
                alert("Succesfully Saved Data.");
                window.location.href = 'gdsubworklist.php';
            } else {
                // Handle errors if any
                console.error("Error saving data: " + xhr.status);
                alert("Error saving data. Please try again.");
            }
        }
    };

    xhr.send(JSON.stringify(combinedData));
}
// ******************** end data saving code****************





$(document).ready(function (e) {
    $('#cancel').on('click change', function () {
        var paystatus = $('#paystatus').val();
        if (paystatus == 'Payment edited') {
            var confirmClose = confirm("You have edited the details and not saved yet. Do you want to continue with form cancel?");
            if (confirmClose) {
                window.location = "orderlist.php";
            }
        } else {
            window.location = "orderlist.php";
        }
        return false;
    });


    $('#modalpostings').select2();
    // Attach a change event listener to the start date input
    $("#startdate").change(function () {
        // Get the selected start date
        var startDate = new Date($(this).val());

        // Calculate the end date as one month later
        var endDate = new Date(startDate);
        endDate.setMonth(endDate.getMonth() + 1);

        // Format the end date as YYYY-MM-DD (same format as input type=date)
        var endDateFormatted = endDate.toISOString().split('T')[0];

        // Set the calculated end date to the end date input
        $("#enddate").val(endDateFormatted);
    });
    $("#modalstartdate").change(function () {
        // Get the selected start date
        var modalstartDate = new Date($(this).val());

        // Calculate the end date as one month later
        var endDate = new Date(modalstartDate);
        endDate.setMonth(endDate.getMonth() + 1);

        // Format the end date as YYYY-MM-DD (same format as input type=date)
        var endDateFormatted = endDate.toISOString().split('T')[0];

        // Set the calculated end date to the end date input
        $("#modalenddate").val(endDateFormatted);
    });

});





