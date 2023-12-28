<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category and Subcategory</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<form method="post" action="process_form.php">
    <label for="categories">Categories:</label>
    <select id="categories" name="categories[]" multiple>
        <!-- Populate categories dynamically from the database -->
        <?php
        // Replace with your database connection code
        // $conn = new mysqli("your_servername", "your_username", "your_password", "your_dbname");
        $conn = mysqli_connect('localhost', 'root', '', 'signsoft');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $result = $conn->query("SELECT * FROM category");

        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['category'] . "</option>";
        }

        $conn->close();
        ?>
    </select>

    <label for="subcategories">Subcategories:</label>
    <select id="subcategories" name="subcategories[]" multiple></select>

    <button type="submit">Submit</button>
</form>

<script>
    $(document).ready(function () {
        $('#categories').change(function () {
            var selectedCategories = $(this).val();

            // Clear existing options in subcategories select
            $('#subcategories').empty();

            if (selectedCategories) {
                // Fetch and populate subcategories dynamically from the database
                $.ajax({
                    type: 'POST',
                    url: 'get_subcategories.php', // Replace with your PHP script to fetch subcategories
                    data: {categories: selectedCategories},
                    dataType: 'json',
                    success: function (data) {
                        $.each(data, function (index, value) {
                            $('#subcategories').append('<option value="' + value.id + '">' + value.subcategory + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>

</body>
</html>


// for (var j = 0; j < subcategories.length; j++) {
                                    //     var subcategoryOption = document.createElement("option");
                                    //     subcategoryOption.value = subcategories[j].id;
                                    //     subcategoryOption.text = subcategories[j].subcategory;
                                    //     subcategoriesSelect.appendChild(subcategoryOption);
                                    // }
