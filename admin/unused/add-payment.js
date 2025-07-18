
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

// ************************** edit & delete table rows for supplier table**********************************
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

// ************************** edit & delete table rows for payment table**********************************
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


// ***************************************************************

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

// ==============================
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

// ============================================
function saveDataToDatabase() {
    var correctorderid =  document.getElementById("orderiddisplay").value;
    var table = document.getElementById("dataTable");
    var rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
    console.log("hai   :" + rows)
    var dataToSave = [];

    // Iterate through each row
    for (var i = 0; i < rows.length; i++) {
        console.log(i);
        var row = rows[i];
        var cells = row.getElementsByTagName("td");

        var rowData = {
            orderid: document.getElementById("orderiddisplay").value,
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

        dataToSave.push(rowData);
    }
    console.log(rowData);
    // ============= second table

    var table1 = document.getElementById("paydataTable");
    var rows1 = table1.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
    console.log("hai   :" + rows1)
    var dataToSave1 = [];

    // Iterate through each row
    for (var i = 0; i < rows1.length; i++) {
        console.log(i);
        var row = rows1[i];
        var cells = row.getElementsByTagName("td");

        var rowData1 = {
            orderid: document.getElementById("orderiddisplay").value,
            PaymentType: cells[1].innerHTML, // Adjust the index based on your table structure
            TransactionMode: cells[2].innerHTML, // Adjust the index based on your table structure
            PaymentAmount: cells[3].innerHTML, // Adjust the index based on your table structure
            CustomerBillNo: cells[4].innerHTML, // Adjust the index based on your table structure

        };

        dataToSave1.push(rowData1);
    }
    console.log(rowData1);
    // ==============================================
    // Combine the two arrays into a single object for the AJAX request
    var combinedData = {
        correctorderid:correctorderid,
        dataToSave: dataToSave,
        dataToSave1: dataToSave1
    };

    // Send data to the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "save-paymentdetails.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Handle the response from the server if needed
                console.log("res " + xhr.responseText);
                alert("Succesfully Saved Data.");
                window.location.href = 'add-payment.php';
            } else {
                // Handle errors if any
                console.error("Error saving data: " + xhr.status);
                alert("Error saving data. Please try again.");
            }
        }
    };

    xhr.send(JSON.stringify(combinedData));
}


// Add an event listener to the select element
document.getElementById('ordersdisplay').addEventListener('change', function () {
    // Get the selected option
    var selectedOption = this.options[this.selectedIndex];

    // Get the values from the selected option
    var selectedOrderId = selectedOption.value;
    var selectedbrandName = selectedOption.getAttribute('data-brandName');
    var selectedquoteAmt = selectedOption.getAttribute('data-quotedAmt');
    // Update other input tags with the selected values
    document.getElementById('amountdisplay').value = selectedquoteAmt;
    document.getElementById('branddisplay').value = selectedbrandName;
    document.getElementById('orderiddisplay').value = selectedOrderId;
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
        }
    });

    $.ajax({
        type: 'POST',
        url: 'get_added_payment_details.php',
        data: {
            selectedOrderId: selectedOrderId
        },
        success: function (data) {

            $('#ajaxaddpaymentresults').html(data);
        }
    });

    $.ajax({
        type: 'POST',
        url: 'get_added_supplier_payment_details.php',
        data: {
            selectedOrderId: selectedOrderId
        },
        success: function (data) {

            $('#ajaxaddsupplierresults').html(data);
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