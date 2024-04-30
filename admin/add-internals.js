
// **************************start edit & delete table rows for staff table**********************************
// Add a click event listener for the "Edit" buttons
$('body').on('click', '.edit-staff-btn', function () {
    // alert("staff");
    // Get the corresponding row
    var row = $(this).closest('tr');

    // Extract values from the row
    var stafforderentry = row.find('td:eq(1)').text(); // Replace 1 with the actual column index
    var stafforderid = row.find('td:eq(2)').text(); // Replace 2 with the actual column index
    var staffempname = row.find('td:eq(3)').text(); // Replace 2 with the actual column index
    var staffempid = row.find('td:eq(4)').text(); // Replace 2 with the actual column index
    var staffworkdesp = row.find('td:eq(5)').text(); // Replace 3 with the actual column index
    var staffdeadline = row.find('td:eq(6)').text(); // Replace 4 with the actual column index
    var staffworkper = row.find('td:eq(7)').text(); // Replace 4 with the actual column index
    var staffassigndate = row.find('td:eq(8)').text(); // Replace 4 with the actual column index
    var staffrowId = row.data('rowid'); // Assuming you have a data-rowid attribute on your row
// alert(staffassigndate);
    // Set values in the modal
    $('#modalstafforders').val(stafforderid).trigger('change');
    $('#modalstaff').val(staffempid).trigger('change');
    $('#modalassignwork').val(staffworkdesp);
    $('#modaldeadline').val(staffdeadline);
    $('#modalpercentage').val(staffworkper);
    $('#modalassigndate').val(staffassigndate);
    // Set the value of the new textbox
    $('#modalstaffrowid').val(staffrowId);

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
        updatepayRowNumbers();
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
    $('#staffallocateTable tbody tr').each(function(index, element) {
        var currentRowNumber = parseInt($(element).find('td:eq(0)').text(), 10);
        rowCounter = Math.max(rowCounter, currentRowNumber);
    });
} 
function addstaffRow() {
     // Call the function to find the maximum row number
     findMaxstaffRowNumber(); 

    var table = document.getElementById("staffallocateTable");
    var tbody = table.getElementsByTagName("tbody")[0]; // Get the tbody element
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
    var selectBox1 = document.getElementById("dept");
    cell2.innerHTML = selectBox1.options[selectBox1.selectedIndex].text;

    // Select Box 2
    var cell3 = newRow.insertCell(2);
    var selectBox2 = document.getElementById("dept");
    cell3.innerHTML = selectBox2.options[selectBox2.selectedIndex].value;
    cell3.classList.add('hidden-cell');

    // Select Box 1
    var cell4 = newRow.insertCell(3);
    var selectBox1 = document.getElementById("staff");
    cell4.innerHTML = selectBox1.options[selectBox1.selectedIndex].text;

    // Select Box 2
    var cell5 = newRow.insertCell(4);
    var selectBox2 = document.getElementById("staff");
    cell5.innerHTML = selectBox2.options[selectBox2.selectedIndex].value;
    cell5.classList.add('hidden-cell');
    // Text Box 1
    var cell6 = newRow.insertCell(5);
    var textBox1 = document.getElementById("assignwork");
    cell6.innerHTML = textBox1.value;

    // Text Box 2
    var cell7 = newRow.insertCell(6);
    var textBox2 = document.getElementById("deadline");
    cell7.innerHTML = textBox2.value;

    // Text Box 3
    var cell8 = newRow.insertCell(7);
    var textBox3 = document.getElementById("workper");
    cell8.innerHTML = textBox3.value;

// Add another column for today's date
var cell9 = newRow.insertCell(8);
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
var yyyy = today.getFullYear();

today =  yyyy + '-' + mm + '-' + dd;
cell9.innerHTML = today;


// New cell with Edit and Delete buttons  ===========href='edit-supplier.php?edit=" + ++rowCounter + "'---onclick='javascript:confirmationDelete($(this));return false;
var cell10 = newRow.insertCell(9);
cell10.innerHTML = "<a class='btn btn-sm btn-primary edit-staff-btn'  data-bs-target='#staffmodal' data-bs-toggle='modal' title='Edit' style='color:white'>" +
    "<span class='fe fe-edit'> </span></a>&nbsp;&nbsp;" +
    "<a class='btn btn-sm btn-danger delete-staff-btn'  id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'>" +
    "<span class='fe fe-trash-2'> </span></a>";
 // Text Box 3
 var cell11 = newRow.insertCell(10);
 cell11.innerHTML = "New";
 cell11.classList.add('hidden-cell');
    // Clear input values after adding to the table
    textBox1.value = "";
    textBox2.value = "";
    textBox3.value = "";
    // Clear select box values
    selectBox1.selectedIndex = -1;
    selectBox2.selectedIndex = -1;
}


$('#savestaffChangesBtn').on('click', function () {
    // Get the values from the modal fields
    var staffordersValueid = $('#modalstafforders').val();
    var staffordersValue = $('#modalstafforders option:selected').text();
    var staffValueid = $('#modalstaff').val();
    var staffValue = $('#modalstaff option:selected').text();
    var staffassignwork = $('#modalassignwork').val();
    var staffdeadline = $('#modaldeadline').val();
    var staffpercentage = $('#modalpercentage').val();
    var staffassigndate = $('#modalassigndate').val();
    var pstatus = "Edited";
    $('#paystatus').val('Payment edited');
    // Get the selected row in the table (assuming it has an id, adjust as needed)
    var selectedRowId = $('#modalstaffrowid').val(); // Update this to the actual input or method to get the row ID

    // Update the corresponding row in the table
    var selectedRow = $('#staffallocateTable tbody tr[data-rowid="' + selectedRowId + '"]');
    selectedRow.find('td:eq(1)').text(staffordersValue); // Update with the correct column indices.
    selectedRow.find('td:eq(2)').text(staffordersValueid); // Update with the correct column indices.
    selectedRow.find('td:eq(3)').text(staffValue); // Update with the correct column indices
    selectedRow.find('td:eq(4)').text(staffValueid); // Update with the correct column indices
    selectedRow.find('td:eq(5)').text(staffassignwork); // Update with the correct column indices
    selectedRow.find('td:eq(6)').text(staffdeadline); // Update with the correct column indices
    selectedRow.find('td:eq(7)').text(staffpercentage); // Update with the correct column indices
    selectedRow.find('td:eq(8)').text(staffassigndate); // Update with the correct column indices
    selectedRow.find('td:eq(10)').text(pstatus); // Update with the correct column indices
    // Hide the modal
    $('#staffmodal').modal('hide');
});


// ************* end staff details ****************





// ============start data saving code================================
function saveDataToDatabase() {
    var correctorderid =  document.getElementById("ordersdisplay").value;
    
    
      
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
             orderid: document.getElementById("ordersdisplay").value,
             entry: cells[1].innerHTML, // Adjust the index based on your table structure
             entryid: cells[2].innerHTML, // Adjust the index based on your table structure
             staffName: cells[3].innerHTML, // Adjust the index based on your table structure
             staffid: cells[4].innerHTML, // Adjust the index based on your table structure
             workAssigned: cells[5].innerHTML, // Adjust the index based on your table structure
             deadline: cells[6].innerHTML, // Adjust the index based on your table structure
             percentOfWork: cells[7].innerHTML, // Adjust the index based on your table structure
             assignDate: cells[8].innerHTML, // Adjust the index based on your table structure
             payStatus: cells[10].innerHTML
 
        };
 
         staffallocationdataToSave.push(rowData1);
     }
     console.log(rowData1);
    // ==============================================
    // Combine the two arrays into a single object for the AJAX request
    var combinedData = {
        correctorderid:correctorderid,
        staffallocationdataToSave:staffallocationdataToSave,
        // supplierdataToSave: supplierdataToSave,
        // paymentdataToSave: paymentdataToSave,
        // followupdataToSave: followupdataToSave,
    };

    // Send data to the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "save-inorderpaymentdetails.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Handle the response from the server if needed
                console.log("result: " + xhr.responseText);
                alert("Succesfully Saved Data.");
                window.location.href = 'add-inorder-details.php';
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


// Add an event listener to the select element
document.getElementById('ordersdisplay').addEventListener('change', function () {
    // Get the selected option
    var selectedOption = this.options[this.selectedIndex];
    var custname = selectedOption.getAttribute('data-custName');
    var projectname = selectedOption.getAttribute('data-projectname');
    var quotedamt = selectedOption.getAttribute('data-quotedAmt');
    // Get the values from the selected option
    var selectedOrderId = selectedOption.value;
    $('#quotesplitupbtn').attr('data-quoteid', selectedOrderId);
    $('#quotesplitupbtn').attr('data-custname', custname);
    $('#quotesplitupbtn').attr('data-projectname', projectname);
    $('#quotesplitupbtn').attr('data-quotedamt', quotedamt);

    $('#editquotesplitupbtn').attr('data-quoteid', selectedOrderId);
    $('#editquotesplitupbtn').attr('data-custname', custname);
    $('#editquotesplitupbtn').attr('data-projectname', projectname);
    $('#editquotesplitupbtn').attr('data-quotedamt', quotedamt);

    $.ajax({
        type: 'POST',
        url: 'viewinorderdetails.php', // Replace with the actual URL that fetches data based on selectedOrderId
        data: {
            selectedOrderId: selectedOrderId
        },
        success: function (data) {
            // Update options of the second select
            $('#orderdetails').html(data);
            
        }
    });
    // Fetch data for the second select using AJAX
    $.ajax({
        type: 'POST',
        url: 'getorderdetails.php', // Replace with the actual URL that fetches data based on selectedOrderId
        data: {
            selectedOrderId: selectedOrderId
        },
        success: function (data) {
            // Update options of the second select
            
            $('#orders').html(data);
            $('#modalorders').html(data);
          
            $('#modalstafforders').html(data);
            $('#dept').html(data);
           
        }
    });

   

    

   
   
    
    $.ajax({
        type: 'POST',
        url: 'add_staff_allocation_details.php',
        data: {
            selectedOrderId: selectedOrderId
        },
        success: function (data) {

            $('#ajaxstaffallocateresults').html(data);
        }
    });

    
});


$(document).ready(function (e) {
    $('#cancel').on('click change', function () {
        var paystatus = $('#paystatus').val();
        if (paystatus == 'Payment edited') {
            var confirmClose = confirm("You have edited the details and not saved yet. Do you want to continue with form cancel?");
            if (confirmClose) {
                window.location = "inorderlist.php";
            }
        } else {
            window.location = "inorderlist.php";
        }
        return false;
    });
});






