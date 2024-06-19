
// **************************start edit & delete table rows for staff table**********************************
// Add a click event listener for the "Edit" buttons
// Function to pad a number with leading zeros
function padWithZeros(number, length) {
    var str = String(number);
    while (str.length < length) {
        str = '0' + str;
    }
    return str;
}
$('body').on('click', '.edit-staff-btn', function () {


    // Get the corresponding row
    var row = $(this).closest('tr');

    // Extract values from the row
    var postings = row.find('td:eq(2)').text(); // Replace 2 with the actual column index
    // alert (postings);
    var content = row.find('td:eq(3)').text(); // Replace 2 with the actual column 
    var idea = row.find('td:eq(4)').text(); // Replace 2 with the actual column index
    // Replace 2 with the actual column index
    // alert(content);
    
    var editid = row.find('td:eq(8)').text(); // Replace 4 with the actual column index
    var staffrowId = row.data('rowid'); // Assuming you have a data-rowid attribute on your row
    // alert (workdate);
    // var assigndate = row.find('td:eq(1)').text(); // Assuming the format is 'dd-mm-YYYY'
    // var dateParts = assigndate.split('-');
    // var formattedDate = dateParts[2] + '-' + dateParts[1].padStart(2, '0') + '-' + dateParts[0].padStart(2, '0');
    var assigndate = row.find('td:eq(1)').text(); // Assuming the format is 'dd-mm-YYYY'
    var dateParts = assigndate.split('-');
    var formattedDate = dateParts[2] + '-' + padWithZeros(dateParts[1], 2) + '-' + padWithZeros(dateParts[0], 2);

    var deadline = row.find('td:eq(5)').text(); // Assuming the format is 'dd-mm-YYYY'
    var dateParts = deadline.split('-');
    // var deadlineDate = dateParts[2] + '-' + dateParts[1].padStart(2, '0') + '-' + dateParts[0].padStart(2, '0');
    var deadlineDate = dateParts[2] + '-' + padWithZeros(dateParts[1], 2) + '-' + padWithZeros(dateParts[0], 2);

    $('#modaldeadline').val(deadlineDate);
    $('#modalassigndate').val(formattedDate);
    // Set values in the modal

    $('#modalpost').val(postings);
    $('#modalcontent').val(content);
    $('#modalidea').val(idea);
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
    // Extract data from a specific column (e.g., third column)
    var dataid = row.find('td').eq(8).text();

    // Confirmation dialog before deleting
    if (confirm("You are going to permanently remove this data. Are you sure you want to delete this row?")) {
        // Perform the AJAX request to delete the row from the database
        $.ajax({
            url: 'delete_graphics_details.php', // URL to the PHP script that will handle the deletion
            type: 'POST',
            data: { id: dataid },
            success: function(response) {
                if (response == 'success') {
                    // Remove the row from the table
                    row.remove();
                    
                    // Optionally, update the numbering in the first column of remaining rows
                    updatestaffRowNumbers();
                } else {
                    alert('Error: Could not delete the row from the database.');
                }
            },
            error: function() {
                alert('Error: Could not contact the server.');
            }
        });
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
    var postingsValue = document.getElementById("postings").value;
    var contentValue = document.getElementById("content").value;
    // Check if both timetaken and workstatus are selected
    if (postingsValue && contentValue) {

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
        var selectBox1 = document.getElementById("postings");
        cell3.innerHTML = selectBox1.value;

        // Select Box 1
        var cell4 = newRow.insertCell(3);
        var textBox1 = document.getElementById("content");
        cell4.innerHTML = textBox1.value

        var cell5 = newRow.insertCell(4);
        var textBox2 = document.getElementById("idea");
        cell5.innerHTML = textBox2.value

        var cell6 = newRow.insertCell(5);
        var textBox3 = document.getElementById("deadline");
        // cell6.innerHTML = textBox3.value
       // Get the value from the deadline textbox
        var originalDateValue = textBox3.value;

        // Create a Date object from the original date value
        var originalDate = new Date(originalDateValue);

        // Check if the originalDate is a valid date
        if (!isNaN(originalDate.getTime())) {
            // Format the date as "dd-mm-yyyy"
            var day = ('0' + originalDate.getDate()).slice(-2);
            var month = ('0' + (originalDate.getMonth() + 1)).slice(-2);
            var year = originalDate.getFullYear();

            var formattedDate = day + '-' + month + '-' + year;

            // Set the formatted date to the cell's innerHTML
            cell6.innerHTML = formattedDate;
        }


        // New cell with Edit and Delete buttons  ===========href='edit-supplier.php?edit=" + ++rowCounter + "'---onclick='javascript:confirmationDelete($(this));return false;
        var cell7 = newRow.insertCell(6);
        cell7.innerHTML = "<a class='btn btn-sm btn-primary edit-staff-btn'  data-bs-target='#staffmodal' data-bs-toggle='modal' title='Edit' style='color:white'>" +
            "<span class='fe fe-edit'> </span></a>&nbsp;&nbsp;" +
            "<a class='btn btn-sm btn-danger delete-staff-btn'  id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'>" +
            "<span class='fe fe-trash-2'> </span></a>";
            
        // Text Box 3
        var cell8 = newRow.insertCell(7);
        cell8.innerHTML = "New";
         cell8.classList.add('hidden-cell');

        var cell9 = newRow.insertCell(8);
        cell9.innerHTML = "";  // Set the content of the cell to be empty
        cell9.classList.add('hidden-cell');

        // Clear input values after adding to the table
           
        selectBox1.selectedIndex = -1;
        textBox1.value="";
        textBox2.value="";
        textBox3.value="";
    } else {
        // If either timetaken or workstatus is not selected, show an alert or handle it accordingly
        alert('Please select both contents and postings.');
    }
}


$('#savestaffChangesBtn').on('click', function () {
    // Get the values from the modal fields
    // var modalworkdate = $('#modalworkdate').val();
  
    // var modalpost = $('#modalpost').val();
    var modalpost = $('#modalpost option:selected').text();
    var modalcontent = $('#modalcontent').val();
    var modalarea = $('#modalidea').val();
    var modaleditid = $('#modaleditid').val();

    var modalassigndate = $('#modalassigndate').val();
    var modaldeadline = $('#modaldeadline').val();
    // Convert the date to a JavaScript Date object
    var dateObject = new Date(modalassigndate);
    // Format the date to "dd-mm-yyyy"
    var formattedDate = ("0" + dateObject.getDate()).slice(-2) + "-" + ("0" + (dateObject.getMonth() + 1)).slice(-2) + "-" + dateObject.getFullYear();
   // Convert the date to a JavaScript Date object
   var dateObject1 = new Date(modaldeadline);
   // Format the date to "dd-mm-yyyy"
   var formatteddeadlineDate = ("0" + dateObject1.getDate()).slice(-2) + "-" + ("0" + (dateObject1.getMonth() + 1)).slice(-2) + "-" + dateObject1.getFullYear();

   
    $('#paystatus').val('Payment edited');
    // Get the selected row in the table (assuming it has an id, adjust as needed)
    var selectedRowId = $('#modalstaffrowid').val(); // Update this to the actual input or method to get the row ID

    // Update the corresponding row in the table
    var selectedRow = $('#staffallocateTable tbody tr[data-rowid="' + selectedRowId + '"]');
    selectedRow.find('td:eq(1)').text(formattedDate); // Update with the correct column indices.
    selectedRow.find('td:eq(2)').text(modalpost); // Update with the correct column indices.
    selectedRow.find('td:eq(3)').text(modalcontent); // Update with the correct column indices
    selectedRow.find('td:eq(4)').text(modalarea); // Update with the correct column indices
    selectedRow.find('td:eq(5)').text(formatteddeadlineDate); // Update with the correct column indices
    if (modaleditid !== "") {
    var pstatus = "Edited";
    selectedRow.find('td:eq(7)').text(pstatus); // Update with the correct column indices
    }
    selectedRow.find('td:eq(8)').text(modaleditid); // Update with the correct column indices
   
   
    // Hide the modal
    $('#staffmodal').modal('hide');
});


// ************* end staff details ****************
// Add an event listener to the select element
document.getElementById('ordersdisplay').addEventListener('change', function () {
    // Get the selected option
    var selectedOption = this.options[this.selectedIndex];
    var custname = selectedOption.getAttribute('data-custName');
    var brandname = selectedOption.getAttribute('data-brandName');
    var quotedamt = selectedOption.getAttribute('data-quotedAmt');
    // Get the values from the selected option
    var selectedOrderId = selectedOption.value;
    $('#quotesplitupbtn').attr('data-quoteid', selectedOrderId);
    $('#quotesplitupbtn').attr('data-custname', custname);
    $('#quotesplitupbtn').attr('data-brandname', brandname);
    $('#quotesplitupbtn').attr('data-quotedamt', quotedamt);

    $('#editquotesplitupbtn').attr('data-quoteid', selectedOrderId);
    $('#editquotesplitupbtn').attr('data-custname', custname);
    $('#editquotesplitupbtn').attr('data-brandname', brandname);
    $('#editquotesplitupbtn').attr('data-quotedamt', quotedamt);

    $.ajax({
        type: 'POST',
        url: 'vieworderdetails.php', // Replace with the actual URL that fetches data based on selectedOrderId
        data: {
            selectedOrderId: selectedOrderId
        },
        success: function (data) {
            // Update options of the second select
            $('#orderdetails').html(data);
            
        }
    });
 

    $.ajax({
       
        type: 'POST',
        url: 'get_graphics_content_details.php',
        data: {
            selectedOrderId: selectedOrderId
        },
        success: function (data) {
           

            $('#ajaxstaffallocateresults').html(data);
           

        }
    });

    
});




// ============start data saving code================================
function saveDataToDatabase() {
    var empid = document.getElementById("empid").value;
    var orderid = document.getElementById("ordersdisplay").value;

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
            assigndate: cells[1].innerHTML, // Adjust the index based on your table structure
            posting: cells[2].innerHTML, // Adjust the index based on your table structure
            content: cells[3].innerHTML, // Adjust the index based on your table structure
            idea: cells[4].innerHTML, // Adjust the index based on your table structure
            deadline: cells[5].innerHTML, // Adjust the index based on your table structure
            recordstatus: cells[7].innerHTML, // Adjust the index based on your table structure
            editid: cells[8].innerHTML, // Adjust the index based on your table structure
            orderid: orderid, // Adjust the index based on your table structure
            empid: empid,
            

        };

        staffallocationdataToSave.push(rowData1);
    }
    console.log("check this :" +  staffallocationdataToSave);
    // ==============================================
    // Combine the two arrays into a single object for the AJAX request
    var combinedData = {
        staffallocationdataToSave: staffallocationdataToSave,

    };

    // Send data to the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "save-graphics-content-details.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Handle the response from the server if needed
                console.log("result: " + xhr.responseText);
                alert("Succesfully Saved Data.");
                // window.location.href = 'dmworklist.php';
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
                window.location = "dmworklist.php";
            }
        } else {
            window.location = "dmworklist.php";
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





