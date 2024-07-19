<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp Button Example</title>
    <style>
        /* Hide the button by default */
        .whatsapp-button {
            display: none;
        }
        /* Show the button only on mobile devices */
        @media (max-width: 768px) {
            .whatsapp-button {
                display: block;
                position: fixed;
                bottom: 10px;
                right: 10px;
                z-index: 1000;
            }
        }
    </style>
</head>
<body>

<div id="whatsapp-button-container"></div>

<script>
    // Function to create and insert the WhatsApp button
    function createWhatsAppButton() {
        var button = document.createElement('a');
        button.href = 'https://wa.me/9744437355'; // Replace with your WhatsApp number
        button.className = 'whatsapp-button';
        button.target="_blank";
        button.innerHTML = '<img src="wicon.png" alt="WhatsApp" style="width: 50px; height: 50px;">'; // Replace with your icon path
        document.getElementById('whatsapp-button-container').appendChild(button);
    }

    // Check if the device is mobile
    if (window.innerWidth <= 768) {
        createWhatsAppButton();
    }

    // Optional: Add event listener to handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth <= 768 && !document.querySelector('.whatsapp-button')) {
            createWhatsAppButton();
        } else if (window.innerWidth > 768 && document.querySelector('.whatsapp-button')) {
            var button = document.querySelector('.whatsapp-button');
            button.parentNode.removeChild(button);
        }
    });
</script>

<script async src='https://d2mpatx37cqexb.cloudfront.net/delightchat-whatsapp-widget/embeds/embed.min.js'></script>
    <script>
        var wa_btnSetting = {
            "btnColor": "#16BE45",
            "ctaText": "",
            "cornerRadius": 40,
            "marginBottom": 20,
            "marginLeft": 20,
            "marginRight": 20,
            "btnPosition": "left",
            "whatsAppNumber": "9744437355",
            "welcomeMessage": "Hello",
            "zIndex": 999999,
            "btnColorScheme": "light"
        };
        window.onload = () => {
            _waEmbed(wa_btnSetting);
        };
    </script>
</body>
</html>
