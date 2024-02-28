<?php
$filename = "../assets/img/kvk-superadmin-user-manuel.pdf";
$file_path = __DIR__ . '/' . $filename;

// Check if the file exists
if (file_exists($file_path)) {
    // Set the appropriate headers for PDF file
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . $filename . '"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');

    // Open the file in a new tab
    readfile($file_path);

    // Optionally force download by uncommenting the line below
    // header('Content-Disposition: attachment; filename="' . $filename . '"');
} else {
    // File not found, handle accordingly (e.g., show an error message)
    echo "File not found.";
}
?>
