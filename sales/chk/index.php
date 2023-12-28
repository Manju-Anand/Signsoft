<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories and Subcategories</title>
    <style>
        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<?php


// Create connection
$conn = mysqli_connect('localhost', 'root', '', 'signsoft');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch categories from the database
$categoriesQuery = "SELECT * FROM category";
$categoriesResult = $conn->query($categoriesQuery);

if ($categoriesResult->num_rows > 0) {
    echo '<form action="process_form.php" method="post">';
    echo '<h2>Select Categories</h2>';
    echo '<ul>';
    while ($categoryRow = $categoriesResult->fetch_assoc()) {
        echo '<li><input type="checkbox" name="categories[]" value="' . $categoryRow['id'] . '">' . $categoryRow['category'] . '</li>';
    }
    echo '</ul>';

    echo '<h2>Select Subcategories</h2>';
    echo '<ul id="subcategoriesList"></ul>';

    echo '<script>
            document.addEventListener("DOMContentLoaded", function () {
                var categoriesCheckbox = document.getElementsByName("categories[]");
                var subcategoriesList = document.getElementById("subcategoriesList");

                for (var i = 0; i < categoriesCheckbox.length; i++) {
                    categoriesCheckbox[i].addEventListener("change", function () {
                        updateSubcategories();
                    });
                }

                function updateSubcategories() {
                    subcategoriesList.innerHTML = "";
                    for (var i = 0; i < categoriesCheckbox.length; i++) {
                        if (categoriesCheckbox[i].checked) {
                            var categoryId = categoriesCheckbox[i].value;

                            // Fetch subcategories from the server/database using AJAX
                            var xhr = new XMLHttpRequest();
                            xhr.onreadystatechange = function () {
                                if (this.readyState === 4 && this.status === 200) {
                                    var subcategories = JSON.parse(this.responseText);

                                    for (var j = 0; j < subcategories.length; j++) {
                                        var subcategoryItem = document.createElement("li");
                                        var subcategoryCheckbox = document.createElement("input");
                                        subcategoryCheckbox.type = "checkbox";
                                        subcategoryCheckbox.name = "subcategories[]";
                                        subcategoryCheckbox.value = subcategories[j].id;
                                        subcategoryItem.appendChild(subcategoryCheckbox);
                                        subcategoryItem.appendChild(document.createTextNode(subcategories[j].subcategory));
                                        subcategoriesList.appendChild(subcategoryItem);
                                    }
                                }
                            };
                            xhr.open("GET", "get_subcategories.php?category_id=" + categoryId, true);
                            xhr.send();
                        }
                    }
                }
            });
        </script>';

    echo '<br><input type="submit" value="Submit">';
    echo '</form>';
} else {
    echo "No categories found in the database.";
}

// Close connection
$conn->close();
?>

</body>
</html>
