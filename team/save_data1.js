document.addEventListener("DOMContentLoaded", function() {
    const saveButton = document.getElementById("save-button");

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
                subquestion: cells[3].textContent,
                subqid: cells[4].textContent,
                qans: cells[5].textContent,
                timetaken: cells[6].textContent,
            };
            dataToSave.push(rowData);
        }

        $.ajax({
            type: 'POST',
            url: 'save_to_db1.php',
            data: JSON.stringify(dataToSave),
            success: function(response) {
                alert(response);
               
                // Successful save
                window.location.href = 'dailyworkstatus.php'; // Redirect after successful save
            },
            error: function(xhr, status, error) {
                // Handle error
            }
        });


       
    });
});
