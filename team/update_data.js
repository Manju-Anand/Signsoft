document.addEventListener("DOMContentLoaded", function() {
    const saveButton = document.getElementById("update-button");

    saveButton.addEventListener("click", function() {
        const tableRows = document.querySelectorAll("#example1 tr");
        const dataToSave = [];

        // Skip the first row (header)
        for (let i = 1; i < tableRows.length; i++) {
            const row = tableRows[i];
            const cells = row.querySelectorAll("td");
            const rowData = {
                question: cells[1].textContent,
                qid: cells[2].textContent,
                qans: cells[6].textContent,
                workdate: cells[3].textContent,
                workstatusid: cells[4].textContent,
                wid: cells[5].textContent
            };
            dataToSave.push(rowData);
        }

        $.ajax({
            type: 'POST',
            url: 'update_to_db.php',
            data: JSON.stringify(dataToSave),
            success: function(response) {
                  alert(response);
                // Successful save
                // window.location.href = 'dailyworkstatus.php'; // Redirect after successful save
            },
            error: function(xhr, status, error) {
                // Handle error
            }
        });


       
    });
});
