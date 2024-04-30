
// Add an event listener to the select element
document.getElementById('ordersdisplay').addEventListener('change', function () {
    // Get the selected option
    var selectedOption = this.options[this.selectedIndex];

    // Get the values from the selected option
    var selectedOrderId = selectedOption.value;
 
    // Fetch data for the second select using AJAX
    $.ajax({
        type: 'POST',
        url: 'viewcloseinorderdetails.php', // Replace with the actual URL that fetches data based on selectedOrderId
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
        
            window.location = "inorderlist.php";
       
    });
});