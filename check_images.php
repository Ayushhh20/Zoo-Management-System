<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/dbconnection.php');

function checkImageType($path) {
    if (!file_exists($path)) return "File does not exist";
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $path);
    finfo_close($finfo);
    return $mime_type;
}

$query = mysqli_query($con, "SELECT ID, AnimalName, AnimalImage FROM tblanimal ORDER BY ID ASC");
echo "<pre>\n";
while ($row = mysqli_fetch_array($query)) {
    $image_path = __DIR__ . "/admin/images/" . $row['AnimalImage'];
    $exists = file_exists($image_path);
    $mime_type = $exists ? checkImageType($image_path) : "N/A";
    $filesize = $exists ? filesize($image_path) : 0;
    
    echo "ID: " . $row['ID'] . "\n";
    echo "Animal: " . $row['AnimalName'] . "\n";
    echo "Image: " . $row['AnimalImage'] . "\n";
    echo "Full Path: " . $image_path . "\n";
    echo "Exists: " . ($exists ? "Yes" : "No") . "\n";
    echo "MIME Type: " . $mime_type . "\n";
    echo "File Size: " . ($filesize / 1024) . " KB\n";
    echo "-------------------\n";
}
echo "</pre>";
?> 