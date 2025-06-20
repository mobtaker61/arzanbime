<?php
// Test upload functionality
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Upload Test</h2>";

// Check if directory exists and is writable
$uploadDir = "public/uploads/";
echo "<p>Upload directory: $uploadDir</p>";
echo "<p>Directory exists: " . (is_dir($uploadDir) ? 'Yes' : 'No') . "</p>";
echo "<p>Directory writable: " . (is_writable($uploadDir) ? 'Yes' : 'No') . "</p>";

// Check PHP upload settings
echo "<h3>PHP Upload Settings:</h3>";
echo "<p>file_uploads: " . (ini_get('file_uploads') ? 'Enabled' : 'Disabled') . "</p>";
echo "<p>upload_max_filesize: " . ini_get('upload_max_filesize') . "</p>";
echo "<p>post_max_size: " . ini_get('post_max_size') . "</p>";
echo "<p>max_file_uploads: " . ini_get('max_file_uploads') . "</p>";

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['test_file'])) {
    echo "<h3>Upload Attempt:</h3>";
    
    $file = $_FILES['test_file'];
    echo "<p>File name: " . $file['name'] . "</p>";
    echo "<p>File size: " . $file['size'] . "</p>";
    echo "<p>File type: " . $file['type'] . "</p>";
    echo "<p>Upload error: " . $file['error'] . "</p>";
    echo "<p>Temp name: " . $file['tmp_name'] . "</p>";
    
    if ($file['error'] === UPLOAD_ERR_OK) {
        $targetFile = $uploadDir . basename($file['name']);
        echo "<p>Target file: $targetFile</p>";
        
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            echo "<p style='color: green;'>File uploaded successfully!</p>";
        } else {
            echo "<p style='color: red;'>Failed to move uploaded file.</p>";
            echo "<p>Error: " . error_get_last()['message'] . "</p>";
        }
    } else {
        echo "<p style='color: red;'>Upload error occurred.</p>";
    }
}

// Simple upload form
?>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="test_file" accept="image/*">
    <input type="submit" value="Test Upload">
</form> 