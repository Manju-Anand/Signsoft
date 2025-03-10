<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $targetDirectory = __DIR__; // Main project folder
    $file = $_FILES['file'];

    // Get file details
    $fileName = basename($file['name']);
    $targetFilePath = $targetDirectory . DIRECTORY_SEPARATOR . $fileName;

    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Error uploading the file. Error code: " . $file['error']);
    }

    // Optional: Check file type (commented out to allow PHP files)
    /*
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'txt', 'docx', 'php'];
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    if (!in_array(strtolower($fileType), $allowedTypes)) {
        die("Invalid file type. Only " . implode(', ', $allowedTypes) . " files are allowed.");
    }
    */

    // Move the file to the target directory
    if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        echo "File uploaded successfully!<br>";
        echo "File path: " . $targetFilePath;
    } else {
        echo "Error: Failed to upload the file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <h1>Upload a File</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="file">Choose a file:</label>
        <input type="file" name="file" id="file" required>
        <br><br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
