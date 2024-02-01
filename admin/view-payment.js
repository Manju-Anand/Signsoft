
// Add an event listener to the select element
document.getElementById('ordersdisplay').addEventListener('change', function () {
    // Get the selected option
    var selectedOption = this.options[this.selectedIndex];

    // Get the values from the selected option
    var selectedOrderId = selectedOption.value;
 
    // Fetch data for the second select using AJAX
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
        url: 'view_added_payment_details.php',
        data: {
            selectedOrderId: selectedOrderId
        },
        success: function (data) {

            $('#ajaxpaymentresults').html(data);
        }
    });

    $.ajax({
        type: 'POST',
        url: 'view_followup_details.php',
        data: {
            selectedOrderId: selectedOrderId
        },
        success: function (data) {

            $('#ajaxfollowupresults').html(data);
        }
    });

    $.ajax({
        type: 'POST',
        url: 'view_added_supplier_payment_details.php',
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
        url: 'view_staff_allocation_details.php',
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
        
            window.location = "orderlist.php";
       
    });
});