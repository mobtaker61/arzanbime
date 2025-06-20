<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// upload.php
$targetDir = "public/uploads/";

// Create directory if it doesn't exist
if (!is_dir($targetDir)) {
    if (!mkdir($targetDir, 0755, true)) {
        $response = ['error' => 'Failed to create upload directory'];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}

// Check if directory is writable
if (!is_writable($targetDir)) {
    $response = ['error' => 'Upload directory is not writable'];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Check if file was uploaded
if (!isset($_FILES["file"]) || $_FILES["file"]["error"] !== UPLOAD_ERR_OK) {
    $error = isset($_FILES["file"]) ? $_FILES["file"]["error"] : 'No file uploaded';
    $response = ['error' => 'Upload error: ' . $error];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

$targetFile = $targetDir . basename($_FILES["file"]["name"]);
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
$response = array();

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["file"]["tmp_name"]);
if ($check !== false) {
    // Check file size
    if ($_FILES["file"]["size"] > 5000000) {
        $response['error'] = "Sorry, your file is too large.";
    } else {
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType != "webp") {
            $response['error'] = "Sorry, only JPG, JPEG, PNG, GIF & WEBP files are allowed.";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                $response['location'] = "/" . $targetFile;
            } else {
                $response['error'] = "Sorry, there was an error uploading your file. Error: " . error_get_last()['message'];
            }
        }
    }
} else {
    $response['error'] = "File is not an image.";
}

header('Content-Type: application/json');
echo json_encode($response);
?>
