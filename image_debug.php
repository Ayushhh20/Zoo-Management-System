<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/dbconnection.php');

function getImageInfo($filename) {
    $base_path = __DIR__ . '/admin/images/';
    $info = array(
        'original' => $filename,
        'exists' => false,
        'found_path' => '',
        'size' => 0,
        'type' => ''
    );
    
    // Check original filename
    if (file_exists($base_path . $filename)) {
        $info['exists'] = true;
        $info['found_path'] = $filename;
        $info['size'] = filesize($base_path . $filename);
        $info['type'] = mime_content_type($base_path . $filename);
        return $info;
    }
    
    // Check with different extensions
    $extensions = array('.jpg', '.jpeg', '.png', '.gif');
    $name_without_ext = preg_replace('/\.[^.]+$/', '', $filename);
    
    foreach ($extensions as $ext) {
        $test_path = $name_without_ext . $ext;
        if (file_exists($base_path . $test_path)) {
            $info['exists'] = true;
            $info['found_path'] = $test_path;
            $info['size'] = filesize($base_path . $test_path);
            $info['type'] = mime_content_type($base_path . $test_path);
            return $info;
        }
    }
    
    return $info;
}

echo "<html><head><title>Image Debug</title><style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    th { background-color: #f5f5f5; }
    .error { color: red; }
    .success { color: green; }
    img { max-width: 100px; height: auto; }
</style></head><body>";

echo "<h2>Image Debug Information</h2>";

// List all files in images directory
echo "<h3>Files in admin/images directory:</h3>";
echo "<table>";
echo "<tr><th>Filename</th><th>Size</th><th>Type</th></tr>";

$files = scandir(__DIR__ . '/admin/images');
foreach ($files as $file) {
    if ($file != '.' && $file != '..' && !is_dir(__DIR__ . '/admin/images/' . $file)) {
        $size = filesize(__DIR__ . '/admin/images/' . $file);
        $type = mime_content_type(__DIR__ . '/admin/images/' . $file);
        echo "<tr>";
        echo "<td>$file</td>";
        echo "<td>" . number_format($size / 1024, 2) . " KB</td>";
        echo "<td>$type</td>";
        echo "</tr>";
    }
}
echo "</table>";

// Database records
echo "<h3>Database Records:</h3>";
echo "<table>";
echo "<tr><th>ID</th><th>Animal Name</th><th>Image in DB</th><th>Status</th><th>Found Path</th><th>Size</th><th>Type</th><th>Preview</th></tr>";

$query = mysqli_query($con, "SELECT ID, AnimalName, AnimalImage FROM tblanimal ORDER BY ID ASC");
while ($row = mysqli_fetch_array($query)) {
    $info = getImageInfo($row['AnimalImage']);
    echo "<tr>";
    echo "<td>" . $row['ID'] . "</td>";
    echo "<td>" . htmlspecialchars($row['AnimalName']) . "</td>";
    echo "<td>" . htmlspecialchars($row['AnimalImage']) . "</td>";
    echo "<td class='" . ($info['exists'] ? 'success' : 'error') . "'>" . 
         ($info['exists'] ? 'Found' : 'Missing') . "</td>";
    echo "<td>" . htmlspecialchars($info['found_path']) . "</td>";
    echo "<td>" . ($info['size'] > 0 ? number_format($info['size'] / 1024, 2) . " KB" : "N/A") . "</td>";
    echo "<td>" . htmlspecialchars($info['type']) . "</td>";
    echo "<td><img src='admin/images/" . htmlspecialchars($info['found_path'] ?: $row['AnimalImage']) . 
         "' onerror=\"this.src='admin/images/s1.png';this.style.opacity='0.5';\"></td>";
    echo "</tr>";
}
echo "</table>";

echo "</body></html>";
?> 