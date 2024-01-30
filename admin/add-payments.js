
// **************************start edit & delete table rows for supplier table**********************************
// Add a click event listener for the "Edit" buttons
$('body').on('click', '.edit-btn', function () {
    // Get the corresponding row
    var row = $(this).closest('tr');

    // Extract values from the row
    var orders = row.find('td:eq(1)').text(); // Replace 1 with the actual column index
    var ordersValue = row.find('td:eq(2)').text();
    var supplier = row.find('td:eq(3)').text(); // Replace 3 with the actual column index
    var supplierValue = row.find('td:eq(4)').text();
    var donework = row.find('td:eq(5)').text(); // Replace 5 with the actual column index
    var supbillno = row.find('td:eq(6)').text(); // Replace 6 with the actual column index
    var payamt = row.find('td:eq(7)').text(); // Replace 7 with the actual column index
    var transmode = row.find('td:eq(8)').text(); // Replace 8 with the actual column index
    var custbillno = row.find('td:eq(9)').text(); // Replace 9 with the actual column index
    var rowId = row.data('rowid'); // Assuming you have a data-rowid attribute on your row

    // Set values in the modal
    $('#modalorders').val(ordersValue).trigger('change'); // Trigger change event to update select box
    $('#modalsupplier').val(supplierValue).trigger('change'); // Trigger c
    $('#modaldonework').val(donework);
    $('#modalsupbillno').val(supbillno);
    $('#modalpayamt').val(payamt);
    $('#modaltransmode').val(transmode).trigger('change');
    $('#modalcustbillno').val(custbillno);

    // Set the value of the new textbox
    $('#modalrowid').val(rowId);

    // Trigger the modal to display
    $('#suppliermodal').modal('show');
});

$('body').on('click', '.delete-btn', function () {
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
        updateRowNumbers();
    }
});

function updateRowNumbers() {
    // Update the numbering in the first column of each remaining row
    $('#dataTable tbody tr').each(function (index, element) {
        $(element).find('td:eq(0)').text(index + 1);
    });
}

var rowCounter = 0; // Move the initialization here
// Find the maximum row number in the existing table rows
function findMaximumRowNumber() {
    // alert("increment");
    // Find the maximum row number in the existing table rows
    $('#dataTable tbody tr').each(function(index, element) {
        var currentRowNumber = parseInt($(element).find('td:eq(0)').text(), 10);
        rowCounter = Math.max(rowCounter, currentRowNumber);
    });
} 
function addRow() {

     // Call the function to find the maximum row number
     findMaximumRowNumber();
    // Get the selected values from the first two select boxes
    var selectBox1 = document.getElementById("orders").value;
    var selectBox2 = document.getElementById("supplier").value;

    // Check if both select boxes are selected
    // if (selectBox1.selectedIndex === -1 || selectBox2.selectedIndex === -1) {
    if (selectBox1 === "" || selectBox2 === "") {
        alert("Please select values for the orders & suppliers.");
        return; // Exit the function if not selected
    }
    var table = document.getElementById("dataTable");
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
    var selectBox1 = document.getElementById("orders");
    cell2.innerHTML = selectBox1.options[selectBox1.selectedIndex].text;

    // Select Box 2
    var cell3 = newRow.insertCell(2);
    var selectBox2 = document.getElementById("orders");
    cell3.innerHTML = selectBox2.options[selectBox2.selectedIndex].value;
    cell3.classList.add('hidden-cell');

    // Select Box 1
    var cell4 = newRow.insertCell(3);
    var selectBox3 = document.getElementById("supplier");
    cell4.innerHTML = selectBox3.options[selectBox3.selectedIndex].text;

    // Select Box 2
    var cell5 = newRow.insertCell(4);
    var selectBox4 = document.getElementById("supplier");
    cell5.innerHTML = selectBox4.options[selectBox4.selectedIndex].value;
    cell5.classList.add('hidden-cell');
    // Text Box 1
    var cell6 = newRow.insertCell(5);
    var textBox1 = document.getElementById("donework");
    cell6.innerHTML = textBox1.value;

    // Text Box 2
    var cell7 = newRow.insertCell(6);
    var textBox2 = document.getElementById("supbillno");
    cell7.innerHTML = textBox2.value;

    // Text Box 3
    var cell8 = newRow.insertCell(7);
    var textBox3 = document.getElementById("payamt");
    cell8.innerHTML = textBox3.value;
    cell8.style.textAlign = "right";
    // Text Box 3
    var cell9 = newRow.insertCell(8);
    var selectBox3 = document.getElementById("transmode");
    cell9.innerHTML = selectBox3.options[selectBox3.selectedIndex].text;

    // Text Box 3
    var cell10 = newRow.insertCell(9);
    var textBox4 = document.getElementById("custbillno");
    cell10.innerHTML = textBox4.value;

    // New cell with Edit and Delete buttons  ===========href='edit-supplier.php?edit=" + ++rowCounter + "'---onclick='javascript:confirmationDelete($(this));return false;
    var cell11 = newRow.insertCell(10);
    cell11.innerHTML = "<a class='btn btn-sm btn-primary edit-btn'  data-bs-target='#suppliermodal' data-bs-toggle='modal' title='Edit' style='color:white'>" +
        "<span class='fe fe-edit'> </span></a>&nbsp;&nbsp;" +
        "<a class='btn btn-sm btn-danger delete-btn'  id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'>" +
        "<span class='fe fe-trash-2'> </span></a>";

    // Clear input values after adding to the table
    textBox1.value = "";
    textBox2.value = "";
    textBox3.value = "";
    textBox4.value = "";
    // Clear select box values
    selectBox1.selectedIndex = -1;
    selectBox2.selectedIndex = -1;
    selectBox3.selectedIndex = -1;
    selectBox4.selectedIndex = -1;
}

// Add a click event listener for the "Save changes" button in the modal
$('#saveChangesBtn').on('click', function () {
    // Get the values from the modal fields
    var ordersValueid = $('#modalorders').val();
    var ordersValue = $('#modalorders option:selected').text();
    var supplierValueid = $('#modalsupplier').val();
    var supplierValue = $('#modalsupplier option:selected').text();
    var doneworkValue = $('#modaldonework').val();
    var supbillnoValue = $('#modalsupbillno').val();
    var payamtValue = $('#modalpayamt').val();
    var transmodeValue = $('#modaltransmode').val();
    var custbillnoValue = $('#modalcustbillno').val();
    $('#paystatus').val('Payment edited');
    // Get the selected row in the table (assuming it has an id, adjust as needed)
    var selectedRowId = $('#modalrowid').val(); // Update this to the actual input or method to get the row ID

    // Update the corresponding row in the table
    var selectedRow = $('#dataTable tbody tr[data-rowid="' + selectedRowId + '"]');
    selectedRow.find('td:eq(1)').text(ordersValue); // Update with the correct column indices.
    selectedRow.find('td:eq(2)').text(ordersValueid); // Update with the correct column indices.
    selectedRow.find('td:eq(3)').text(supplierValue); // Update with the correct column indices
    selectedRow.find('td:eq(4)').text(supplierValueid); // Update with the correct column indices
    selectedRow.find('td:eq(5)').text(doneworkValue); // Update with the correct column indices
    selectedRow.find('td:eq(6)').text(supbillnoValue); // Update with the correct column indices
    selectedRow.find('td:eq(7)').text(payamtValue); // Update with the correct column indices
    selectedRow.find('td:eq(8)').text(transmodeValue); // Update with the correct column indices
    selectedRow.find('td:eq(9)').text(custbillnoValue); // Update with the correct column indices

    // Hide the modal
    $('#suppliermodal').modal('hide');
});
// ************************** end supplier details *********************


// **************************  Start edit & delete table rows for payment table**********************************
// Add a click event listener for the "Edit" buttons
$('body').on('click', '.edit-pay-btn', function () {
    // Get the corresponding row
    var row = $(this).closest('tr');

    // Extract values from the row
    var paytype = row.find('td:eq(1)').text(); // Replace 1 with the actual column index
    var transmode = row.find('td:eq(2)').text(); // Replace 2 with the actual column index
    var payamt = row.find('td:eq(3)').text(); // Replace 3 with the actual column index
    var custbillno = row.find('td:eq(4)').text(); // Replace 4 with the actual column index
    var rowId = row.data('rowid'); // Assuming you have a data-rowid attribute on your row

    // Set values in the modal
    $('#modalpaytype').val(paytype).trigger('change');
    $('#modalpaymenttransmode').val(transmode).trigger('change');
    $('#modalpaymentamt').val(payamt);
    $('#modalpaycustbillno').val(custbillno);

    // Set the value of the new textbox
    $('#modalpayrowid').val(rowId);

    // Trigger the modal to display
    $('#paymentmodal').modal('show');
});

$('body').on('click', '.delete-pay-btn', function () {
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

function updatepayRowNumbers() {
    // Update the numbering in the first column of each remaining row
    $('#paydataTable tbody tr').each(function (index, element) {
        $(element).find('td:eq(0)').text(index + 1);
    });
}


var rowpaymentCounter = 0; // Move the initialization here
// Find the maximum row number in the existing table rows
function findMaxRowNumber() {
    // alert("increment");
    // Find the maximum row number in the existing table rows
    $('#paydataTable tbody tr').each(function(index, element) {
        var currentRowNumber = parseInt($(element).find('td:eq(0)').text(), 10);
        rowpaymentCounter = Math.max(rowpaymentCounter, currentRowNumber);
    });
}
function addPayment() {
    // alert("payment");
    // Call the function to find the maximum row number
    findMaxRowNumber();

    // Get the selected values from the first two select boxes
    var selectBox3 = document.getElementById("paytype").value;
    var selectBox4 = document.getElementById("paymenttransmode").value;
    // alert (selectBox3 );
    // alert (selectBox4 );
    // Check if both select boxes are selected
    // if (selectBox1.selectedIndex === -1 || selectBox2.selectedIndex === -1) {
    if (selectBox3 === "" || selectBox4 === "") {
        alert("Please select values for the Payment Type & Transaction Mode.");
        return; // Exit the function if not selected
    }
    var table = document.getElementById("paydataTable");
    var tbody = table.getElementsByTagName("tbody")[0]; // Get the tbody element
    var newRow = tbody.insertRow(tbody.rows.length); // Insert row into tbody
    // Generate a unique identifier for the row
    var rowId = "row_" + (new Date().getTime()); // You can use a more robust method based on your needs


    // Numbering Column
    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = ++rowpaymentCounter; // Increment before setting the innerHTML
    // Set the unique identifier as a data attribute
    newRow.setAttribute('data-rowid', rowId);
    // Select Box 1
    var cell2 = newRow.insertCell(1);
    var selectBox1 = document.getElementById("paytype");
    cell2.innerHTML = selectBox1.options[selectBox1.selectedIndex].text;

    // Select Box 1
    var cell3 = newRow.insertCell(2);
    var selectBox1 = document.getElementById("paymenttransmode");
    cell3.innerHTML = selectBox1.options[selectBox1.selectedIndex].text;


    // Text Box 1
    var cell4 = newRow.insertCell(3);
    var textBox1 = document.getElementById("paymentamt");
    cell4.innerHTML = textBox1.value;
    cell4.style.textAlign = "right";

    // Text Box 2
    var cell5 = newRow.insertCell(4);
    var textBox2 = document.getElementById("paycustbillno");
    cell5.innerHTML = textBox2.value;

    // Text Box 3
    // New cell with Edit and Delete buttons  ===========href='edit-supplier.php?edit=" + ++rowCounter + "'---onclick='javascript:confirmationDelete($(this));return false;
    var cell6 = newRow.insertCell(5);
    cell6.innerHTML = "<a class='btn btn-sm btn-primary edit-pay-btn'  data-bs-target='#paymentmodal' data-bs-toggle='modal' title='Edit' style='color:white'>" +
        "<span class='fe fe-edit'> </span></a>&nbsp;&nbsp;" +
        "<a class='btn btn-sm btn-danger delete-pay-btn'  id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'>" +
        "<span class='fe fe-trash-2'> </span></a>";


    // Clear input values after adding to the table
    textBox1.value = "";
    textBox2.value = "";

    // Clear select box values
    selectBox1.selectedIndex = -1;


}



$('#savepayChangesBtn').on('click', function () {
    // Get the values from the modal fields
    var modalpaytype = $('#modalpaytype').val();
    var transmodeValue = $('#modalpaymenttransmode').val();
    var custbillnoValue = $('#modalpaycustbillno').val();
    var payamtValue = $('#modalpaymentamt').val();


     
   
    $('#paystatus').val('Payment edited');
    // Get the selected row in the table (assuming it has an id, adjust as needed)
    var selectedRowId = $('#modalpayrowid').val(); // Update this to the actual input or method to get the row ID

    // Update the corresponding row in the table
    var selectedRow = $('#paydataTable tbody tr[data-rowid="' + selectedRowId + '"]');
    selectedRow.find('td:eq(1)').text(modalpaytype); // Update with the correct column indices.
    selectedRow.find('td:eq(2)').text(transmodeValue); // Update with the correct column indices.
    selectedRow.find('td:eq(3)').text(payamtValue); // Update with the correct column indices
    selectedRow.find('td:eq(4)').text(custbillnoValue); // Update with the correct column indices


    // Hide the modal
    $('#paymentmodal').modal('hide');
});
// ================== End payment details==========================


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
    
    // Hide the modal
    $('#staffmodal').modal('hide');
});


// ************* end staff details ****************


// *************************start followup details***********************
// Add a click event listener for the "Edit" buttons
$('body').on('click', '.edit-follow-btn', function () {
    // Get the corresponding row
    var row = $(this).closest('tr');

    // Extract values from the row
    var followupdate = row.find('td:eq(1)').text(); // Replace 1 with the actual column index
    var modeofcontact = row.find('td:eq(2)').text(); // Replace 2 with the actual column index
    var remarks = row.find('td:eq(3)').text(); // Replace 3 with the actual column index
    var rowId = row.data('rowid'); // Assuming you have a data-rowid attribute on your row

    // Set values in the modal
    $('#modalfollowupdate').val(followupdate);
    $('#modalfollowupmode').val(modeofcontact).trigger('change');
    $('#modalfollowupremarks').val(remarks);
    

    // Set the value of the new textbox
    $('#modalfollowuprowid').val(rowId);

    // Trigger the modal to display
    $('#followupmodal').modal('show');
});
// Add a click event listener for the "delete" buttons
$('body').on('click', '.delete-follow-btn', function () {
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
        updatefollowupRowNumbers();
    }
});
// row number updation function
function updatefollowupRowNumbers() {
    // Update the numbering in the first column of each remaining row
    $('#followupdataTable tbody tr').each(function (index, element) {
        $(element).find('td:eq(0)').text(index + 1);
    });
}



var rowfollowupCounter = 0; // Move the initialization here
// Find the maximum row number in the existing table rows
function findfollowupRowNumber() {
    // alert("increment");
    // Find the maximum row number in the existing table rows
    $('#followupdataTable tbody tr').each(function(index, element) {
        var currentRowNumber = parseInt($(element).find('td:eq(0)').text(), 10);
        rowfollowupCounter = Math.max(rowfollowupCounter, currentRowNumber);
    });
}
function addfollowup() {
    // alert("payment");
    // Call the function to find the maximum row number
    findfollowupRowNumber();

    // Get the selected values from the first two select boxes
    var textBox3 = document.getElementById("followupdate").value;
    var selectBox4 = document.getElementById("followupmode").value;
    // alert (selectBox3 );
    // alert (selectBox4 );
    // Check if both select boxes are selected
    // if (selectBox1.selectedIndex === -1 || selectBox2.selectedIndex === -1) {
    if (textBox3 === "" || selectBox4 === "") {
        alert("Please select values for the Date & Mode Of Contact.");
        return; // Exit the function if not selected
    }
    var table = document.getElementById("followupdataTable");
    var tbody = table.getElementsByTagName("tbody")[0]; // Get the tbody element
    var newRow = tbody.insertRow(tbody.rows.length); // Insert row into tbody
    // Generate a unique identifier for the row
    var rowId = "row_" + (new Date().getTime()); // You can use a more robust method based on your needs


    // Numbering Column
    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = ++rowpaymentCounter; // Increment before setting the innerHTML
    // Set the unique identifier as a data attribute
    newRow.setAttribute('data-rowid', rowId);
    // Select Box 1
    var cell2 = newRow.insertCell(1);
    var textBox1 = document.getElementById("followupdate");
    cell2.innerHTML = textBox1.value;
   

    // Select Box 1
    var cell3 = newRow.insertCell(2);
    var selectBox1 = document.getElementById("followupmode");
    cell3.innerHTML = selectBox1.options[selectBox1.selectedIndex].text;


    // Text Box 1
    var cell4 = newRow.insertCell(3);
    var textBox2 = document.getElementById("followupremarks");
    cell4.innerHTML = textBox2.value;
    


    // Text Box 3
    // New cell with Edit and Delete buttons  ===========href='edit-supplier.php?edit=" + ++rowCounter + "'---onclick='javascript:confirmationDelete($(this));return false;
    var cell5 = newRow.insertCell(4);
    cell5.innerHTML = "<a class='btn btn-sm btn-primary edit-follow-btn'  data-bs-target='#followupmodal' data-bs-toggle='modal' title='Edit' style='color:white'>" +
        "<span class='fe fe-edit'> </span></a>&nbsp;&nbsp;" +
        "<a class='btn btn-sm btn-danger delete-follow-btn'  id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'>" +
        "<span class='fe fe-trash-2'> </span></a>";


    // Clear input values after adding to the table
    textBox1.value = "";
    textBox2.value = "";
    selectBox1.value = "";

    // Clear select box values
    selectBox1.selectedIndex = -1;


}



$('#savefollowupChangesBtn').on('click', function () {
    // Get the values from the modal fields
    var followupdate = $('#modalfollowupdate').val();
    var followupmode = $('#modalfollowupmode').val();
    var followupremarks = $('#modalfollowupremarks').val();
   


     
   
    $('#paystatus').val('Payment edited');
    // Get the selected row in the table (assuming it has an id, adjust as needed)
    var selectedRowId = $('#modalfollowuprowid').val(); // Update this to the actual input or method to get the row ID

    // Update the corresponding row in the table
    var selectedRow = $('#followupdataTable tbody tr[data-rowid="' + selectedRowId + '"]');
    selectedRow.find('td:eq(1)').text(followupdate); // Update with the correct column indices.
    selectedRow.find('td:eq(2)').text(followupmode); // Update with the correct column indices.
    selectedRow.find('td:eq(3)').text(followupremarks); // Update with the correct column indices
    

    // Hide the modal
    $('#followupmodal').modal('hide');
});


// ******************************end followup details*********************************



// ============start data saving code================================
function saveDataToDatabase() {
    var correctorderid =  document.getElementById("ordersdisplay").value;
    // *********** supplier details *************
    var table = document.getElementById("dataTable");
    var rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
    console.log("hai suppliers   :" + rows)
    var supplierdataToSave = [];

    // Iterate through each row
    for (var i = 0; i < rows.length; i++) {
        console.log(i);
        var row = rows[i];
        var cells = row.getElementsByTagName("td");

        var rowData = {
            orderid: document.getElementById("ordersdisplay").value,
            entry: cells[1].innerHTML, // Adjust the index based on your table structure
            entryid: cells[2].innerHTML, // Adjust the index based on your table structure
            SupplierName: cells[3].innerHTML, // Adjust the index based on your table structure
            Supplierid: cells[4].innerHTML, // Adjust the index based on your table structure
            workDone: cells[5].innerHTML, // Adjust the index based on your table structure
            SupplierBillNo: cells[6].innerHTML, // Adjust the index based on your table structure
            PaymentAmount: cells[7].innerHTML, // Adjust the index based on your table structure
            TransactionMode: cells[8].innerHTML, // Adjust the index based on your table structure
            CustomerBillNo: cells[9].innerHTML // Adjust the index based on your table structure
            // Add more fields as needed
        };

        supplierdataToSave.push(rowData);
    }
    console.log(rowData);
    // **********payment details *********************

    var table1 = document.getElementById("paydataTable");
    var rows1 = table1.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
    console.log("hai  payments :" + rows1)
    var paymentdataToSave = [];

    // Iterate through each row
    for (var i = 0; i < rows1.length; i++) {
        console.log(i);
        var row = rows1[i];
        var cells = row.getElementsByTagName("td");

        var rowData1 = {
            orderid: document.getElementById("ordersdisplay").value,
            PaymentType: cells[1].innerHTML, // Adjust the index based on your table structure
            TransactionMode: cells[2].innerHTML, // Adjust the index based on your table structure
            PaymentAmount: cells[3].innerHTML, // Adjust the index based on your table structure
            CustomerBillNo: cells[4].innerHTML, // Adjust the index based on your table structure

        };

        paymentdataToSave.push(rowData1);
    }
    console.log(rowData1);
      // **********folllowup details *********************

      var table1 = document.getElementById("followupdataTable");
      var rows1 = table1.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
      console.log("hai  followups :" + rows1)
      var followupdataToSave = [];
  
      // Iterate through each row
      for (var i = 0; i < rows1.length; i++) {
          console.log(i);
          var row = rows1[i];
          var cells = row.getElementsByTagName("td");
  
          var rowData1 = {
              orderid: document.getElementById("ordersdisplay").value,
              followdate: cells[1].innerHTML, // Adjust the index based on your table structure
              followmode: cells[2].innerHTML, // Adjust the index based on your table structure
              remarks: cells[3].innerHTML, // Adjust the index based on your table structure
            
  
          };
  
          followupdataToSave.push(rowData1);
      }
      console.log(rowData1);
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
             assignDate: cells[8].innerHTML // Adjust the index based on your table structure
 
        };
 
         staffallocationdataToSave.push(rowData1);
     }
     console.log(rowData1);
    // ==============================================
    // Combine the two arrays into a single object for the AJAX request
    var combinedData = {
        correctorderid:correctorderid,
        staffallocationdataToSave:staffallocationdataToSave,
        supplierdataToSave: supplierdataToSave,
        paymentdataToSave: paymentdataToSave,
        followupdataToSave: followupdataToSave,
    };

    // Send data to the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "save-paymentdetails.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Handle the response from the server if needed
                console.log("result: " + xhr.responseText);
                alert("Succesfully Saved Data.");
                // window.location.href = 'add-order-details.php';
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
        url: 'get_followup_details.php',
        data: {
            selectedOrderId: selectedOrderId
        },
        success: function (data) {

            $('#ajaxfollowupresults').html(data);
        }
    });

    $.ajax({
        type: 'POST',
        url: 'get_added_payment_details.php',
        data: {
            selectedOrderId: selectedOrderId
        },
        success: function (data) {

            $('#ajaxpaymentresults').html(data);
        }
    });

    $.ajax({
        type: 'POST',
        url: 'get_added_supplier_payment_details.php',
        data: {
            selectedOrderId: selectedOrderId
        },
        success: function (data) {

            $('#ajaxsupplierresults').html(data);
        }
    });
    $.ajax({
        type: 'POST',
        url: 'view_quote_splitup_details.php',
        data: {
            selectedOrderId: selectedOrderId
        },
        success: function (data) {

            $('#ajaxquotesplitupresults').html(data);
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
                window.location = "staffAllocation.php";
            }
        } else {
            window.location = "staffAllocation.php";
        }
        return false;
    });
});




// ******************* start quotation splitup ****************
$('#quotesplitupbtn').on('click', function() {
    // alert("op");
    // Access the value of the data attribute 'data_quoteid'
    var quoteIdValue = $(this).data('quoteid');
    $('#quoteid').val(quoteIdValue);
    // alert(quoteIdValue);
    var custName = $(this).data('custname');
    $('#custname').val(custName);
    var brandName = $(this).data('brandname');
   $('#brandname').val(brandName);
    var quoteAmt = $(this).data('quotedamt');
    // alert (quoteAmt)
    $('#quotedamt').val(quoteAmt);
    // alert("complete");
    // Your code to be executed when the element is clicked
    // alert('Element with id "quoteSplit" clicked! Data Quote ID: ' + quoteIdValue);
    // Fetch data from the server using AJAX (you may need to adjust the URL)
    $.ajax({
        url: 'quotation_details.php',
        method: 'POST',
        data: {
            order_id: quoteIdValue
        },
        success: function(data) {
            
            $('#orderTable tbody').html(data);
        },
        error: function() {
            alert('Error fetching data from the server.');
        }
    });
});

$('#saveQuotesplitupBtn').on('click', function() {
    // Calculate the total amount entered in the numeric column
    var totalAmount = 0;
    $('.numeric-column').each(function() {
        var numericValue = parseInt($(this).text()) || 0;
        totalAmount += numericValue;
    });

    // Get the value from the quoteamt input
    var quoteAmount = parseInt($('#quoteamt').val()) || 0;
    var quoteId = $('#quoteid').val();
    // Compare the total amount with quoteAmount
    if (totalAmount > quoteAmount) {
        alert('Total amount entered exceeds the Quoted Amount!');
    } else {
        // alert('Total amount is within the Quoted Amount.');

        // Save data to the server (replace this with your actual AJAX call)
        var tableData = [];
        var tablechk=0;
        $('#orderTable tbody tr').each(function() {
            var priceValue = $(this).find('td:eq(3)').text().trim();
            if (priceValue !== "") {
                tablechk=1;
            var rowData = {
                itemId: $(this).find('td:nth-child(2)').text(),
                itemName: $(this).find('td:nth-child(3)').text(),
                price: $(this).find('td:nth-child(4)').text()
            };
            tableData.push(rowData);
        }
        });
       if ( tablechk == 1 ){
        // Send the data to the server using AJAX
        $.ajax({
            url: 'quote_splitup_save.php',
            method: 'POST',
            data: {
                quoteId: quoteId,
                tableData: JSON.stringify(tableData)
            },
            success: function(response) {
                console.log('Data saved successfully:', response); +
                alert('Data saved successfully:');
                $('#modalquotesplitup').modal('hide');
                // window.location.href="quote_splitup.php";
                // *************************
                $.ajax({
                    type: 'POST',
                    url: 'view_quote_splitup_details.php',
                    data: {
                        selectedOrderId: quoteId
                    },
                    success: function (data) {
            
                        $('#ajaxquotesplitupresults').html(data);
                    }
                });


                // *******************************
            },
            error: function() {
                console.error('Error saving data to the server.');
                alert(response);
            }
        });
     } else {
        alert("Enter Itemwise Price ");
    }



    }
});

$('#editquotesplitupbtn').on('click', function() {

    // Access the value of the data attribute 'data_quoteid'
    var quoteIdValue = $(this).data('quoteid');
    $('#editquoteid').val(quoteIdValue);
    var custName = $(this).data('custname');
    $('#editcustname').val(custName);
    var brandName = $(this).data('brandname');
   $('#editbrandname').val(brandName);
    var quoteAmt = $(this).data('quotedamt');
    $('#editquoteamt').val(quoteAmt);
    // Your code to be executed when the element is clicked
    // alert('Element with id "quoteSplit" clicked! Data Quote ID: ' + quoteIdValue);
    // Fetch data from the server using AJAX (you may need to adjust the URL)
    $.ajax({
        url: 'quotation_details_edit.php',
        method: 'POST',
        data: {
            order_id: quoteIdValue
        },
        success: function(data) {
            // alert(data);
            $('#editorderTable tbody').html(data);
        },
        error: function() {
            alert('Error fetching data from the server.');
        }
    });
});

$('#updateChangesBtn').on('click', function() {
    // Calculate the total amount entered in the numeric column
    var totalAmount = 0;
    $('.numeric-column').each(function() {
        var numericValue = parseInt($(this).text()) || 0;
        totalAmount += numericValue;
    });

    // Get the value from the quoteamt input
    var quoteAmount = parseInt($('#editquoteamt').val()) || 0;
    var quoteId = $('#editquoteid').val();
    // Compare the total amount with quoteAmount
    if (totalAmount > quoteAmount) {
        alert('Total amount entered exceeds the Quoted Amount!');
    } else {
        // alert('Total amount is within the Quoted Amount.');

        // Save data to the server (replace this with your actual AJAX call)
        var tableData = [];
        var tablechk=0;
        $('#editorderTable tbody tr').each(function() {
            var priceValue = $(this).find('td:eq(3)').text().trim();
            if (priceValue !== "") {
                tablechk=1;
            var rowData = {
                itemId: $(this).find('td:nth-child(2)').text(),
                itemName: $(this).find('td:nth-child(3)').text(),
                price: $(this).find('td:nth-child(4)').text()
            };
            tableData.push(rowData);
        }
        });
       if ( tablechk == 1 ){
        // Send the data to the server using AJAX
        $.ajax({
            url: 'quote_splitup_update.php',
            method: 'POST',
            data: {
                quoteId: quoteId,
                tableData: JSON.stringify(tableData)
            },
            success: function(response) {
                console.log('Data updated successfully:', response); +
                alert('Data updated successfully:');
                $('#modaleditquotesplitup').modal('hide');
                // window.location.href="quote_splitup.php";
                   // *************************
                   $.ajax({
                    type: 'POST',
                    url: 'view_quote_splitup_details.php',
                    data: {
                        selectedOrderId: quoteId
                    },
                    success: function (data) {
            
                        $('#ajaxquotesplitupresults').html(data);
                    }
                });


                // *******************************
            },
            error: function() {
                console.error('Error saving data to the server.');
                alert(response);
            }
        });
     } else {
        alert("Enter Itemwise Price ");
    }



    }
});


// ************* end quotation splitup ******************

