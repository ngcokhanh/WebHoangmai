<?php
$targetDir = "uploads/";
$targetFile = $targetDir . basename($_FILES["upload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["upload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($targetFile)) {
    $uploadOk = 0;
}

// Check file size
if ($_FILES["upload"]["size"] > 500000) {
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "mp4" && $imageFileType != "avi"
) {
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["upload"]["tmp_name"], $targetFile)) {
        echo "The file " . basename($_FILES["upload"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>