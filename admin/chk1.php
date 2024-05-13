<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Popup Example</title>
    <style>
      

        .popup-container {
            display: inline-block;
            position: relative;
            z-index: 1;
        }

        .popup-content {
            display: none;
            position: absolute;
            top: 120%;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px;
            background-color: #ebdb00;
            color: green;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transition: opacity 0.3s ease-in-out,
                top 0.3s ease-in-out;
                z-index: 2;
        }

        .popup-container:hover .popup-content {
            top: 100%;
            opacity: 1;
        }
    </style>
</head>
<body>
    <h3>Hover over table cells to see popup</h3>
    <table>
        <thead>
            <tr>
                <th>Brand Name</th>
                <th>Quoted Amount</th>
                <th>Customer Name</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="popup-container" data-id="19">Apple</td>
                <td class="popup-container" data-id="20">$1000</td>
                <td class="popup-container" data-id="21">John Doe</td>
            </tr>
            <tr>
                <td class="popup-container" data-id="22">Samsung</td>
                <td class="popup-container" data-id="23">$800</td>
                <td class="popup-container" data-id="24">Jane Smith</td>
            </tr>
        </tbody>
    </table>

    <div class="popup-content" id="popupContent">
        <h1>dgcdcj</h1>
    </div>

    <script>
        const popupContainers = document.querySelectorAll('.popup-container');
        const popupContent = document.getElementById('popupContent');

        popupContainers.forEach(container => {
            container.addEventListener('mouseenter', async () => {
                const id = container.getAttribute('data-id');
                const response = await fetch(`get_orderdata.php?id=${id}`); // Replace 'get_data.php' with your backend API endpoint
                const data = await response.json();
                popupContent.innerHTML = `
                    <p><strong>Brand Name:</strong> ${data.brandName}</p>
                    <p><strong>Quoted Amount:</strong> ${data.quotedAmount}</p>
                    <p><strong>Customer Name:</strong> ${data.customerName}</p>
                `;
                popupContent.style.display = 'block';
            });

            container.addEventListener('mouseleave', () => {
                popupContent.style.display = 'none';
            });
        });
    </script>
</body>
</html>
