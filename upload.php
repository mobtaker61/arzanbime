<?php
// upload.php
$targetDir = "public/uploads/";

// Create directory if it doesn't exist
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
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
                $response['error'] = "Sorry, there was an error uploading your file.";
            }
        }
    }
} else {
    $response['error'] = "File is not an image.";
}

header('Content-Type: application/json');
echo json_encode($response);
?>
