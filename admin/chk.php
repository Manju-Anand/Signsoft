<?php
if (isset($_POST['submit'])) {

    // Configure upload directory and allowed file types
    $upload_dir = 'uploads/';
    $allowed_types = array('jpg', 'png', 'jpeg', 'gif');

    // Define maxsize for image i.e 50KB
    $maxsize = 50 * 1024;

    // Define required dimensions
    $required_width = 590;
    $required_height = 660;

    // Checks if user sent an empty form
    if (!empty(array_filter($_FILES['image']['name']))) {

        // ... (Your existing code)

        // Loop through each file in image[] array
        foreach ($_FILES['image']['tmp_name'] as $key => $value) {

            // ... (Your existing code)

            // Check file type and dimensions
            if (in_array(strtolower($file_ext), $allowed_types) &&
                getimagesize($file_tmpname)[0] == $required_width &&
                getimagesize($file_tmpname)[1] == $required_height) {

                // Verify file size - 50KB max
                if ($file_size > $maxsize) {
                    echo "<div class='alert alert-warning border-0 bg-warning alert-dismissible fade show py-2'>
                        <div class='d-flex align-items-center'>
                        <div class='font-35 text-dark'><i class='bx bx-info-circle'></i>
                        </div>
                        <div class='ms-3'>
                        <h6 class='mb-0 text-dark'>Warning Alerts</h6>
                        <div class='text-dark'>Error: File size is larger than the allowed limit.</div>
                        </div>
                        </div>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                }

                // ... (Your existing code for moving and inserting into the database)

            } else {
                echo "<div class='alert alert-warning border-0 bg-warning alert-dismissible fade show py-2'>
                        <div class='d-flex align-items-center'>
                        <div class='font-35 text-dark'><i class='bx bx-info-circle'></i>
                        </div>
                        <div class='ms-3'>
                        <h6 class='mb-0 text-dark'>Warning Alerts</h6>
                        <div class='text-dark'>Error uploading {$file_name} - Invalid file type or dimensions.</div>
                        </div>
                        </div>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
            }
        }
        // ... (Your existing code)
    } else {
        echo "<div class='alert alert-warning border-0 bg-warning alert-dismissible fade show py-2'>
                <div class='d-flex align-items-center'>
                <div class='font-35 text-dark'><i class='bx bx-info-circle'></i>
                </div>
                <div class='ms-3'>
                <h6 class='mb-0 text-dark'>Warning Alerts</h6>
                <div class='text-dark'>No image selected!</div>
                </div>
                </div>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
    }
}
?>
