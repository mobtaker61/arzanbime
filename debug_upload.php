<?php
// Simple debug script for upload testing
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Upload Debug</h1>";

// Test 1: Check directory permissions
echo "<h2>1. Directory Check</h2>";
$dir = "public/uploads/";
echo "Directory: $dir<br>";
echo "Exists: " . (is_dir($dir) ? 'Yes' : 'No') . "<br>";
echo "Readable: " . (is_readable($dir) ? 'Yes' : 'No') . "<br>";
echo "Writable: " . (is_writable($dir) ? 'Yes' : 'No') . "<br>";
echo "Permissions: " . substr(sprintf('%o', fileperms($dir)), -4) . "<br>";

// Test 2: Check PHP settings
echo "<h2>2. PHP Settings</h2>";
echo "file_uploads: " . (ini_get('file_uploads') ? 'On' : 'Off') . "<br>";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "<br>";
echo "post_max_size: " . ini_get('post_max_size') . "<br>";
echo "max_execution_time: " . ini_get('max_execution_time') . "<br>";
echo "memory_limit: " . ini_get('memory_limit') . "<br>";

// Test 3: Check if we can write a test file
echo "<h2>3. Write Test</h2>";
$testFile = $dir . "test_write.txt";
if (file_put_contents($testFile, "test")) {
    echo "Write test: SUCCESS<br>";
    unlink($testFile); // Clean up
} else {
    echo "Write test: FAILED<br>";
}

// Test 4: Check upload handling
echo "<h2>4. Upload Test</h2>";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['test_file'])) {
    $file = $_FILES['test_file'];
    echo "File received:<br>";
    echo "- Name: " . $file['name'] . "<br>";
    echo "- Size: " . $file['size'] . "<br>";
    echo "- Type: " . $file['type'] . "<br>";
    echo "- Error: " . $file['error'] . "<br>";
    echo "- Temp: " . $file['tmp_name'] . "<br>";
    
    if ($file['error'] === UPLOAD_ERR_OK) {
        $target = $dir . basename($file['name']);
        if (move_uploaded_file($file['tmp_name'], $target)) {
            echo "<span style='color: green;'>Upload SUCCESS: $target</span><br>";
        } else {
            echo "<span style='color: red;'>Upload FAILED</span><br>";
            echo "Error: " . error_get_last()['message'] . "<br>";
        }
    }
}

// Test form
?>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="test_file" accept="image/*">
    <input type="submit" value="Test Upload">
</form> 