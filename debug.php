<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/dbconnection.php');

echo "<html><head><style>
table { border-collapse: collapse; width: 100%; }
th, td { border: 1px solid black; padding: 8px; text-align: left; }
.missing { color: red; }
.exists { color: green; }
</style></head><body>";

echo "<h2>Image Debug Information</h2>";
echo "<table>";
echo "<tr><th>ID</th><th>Animal Name</th><th>Image Name</th><th>Status</th><th>Preview</th></tr>";

$query = mysqli_query($con, "SELECT ID, AnimalName, AnimalImage FROM tblanimal ORDER BY ID ASC");
while ($row = mysqli_fetch_array($query)) {
    $image_path = "admin/images/" . $row['AnimalImage'];
    $full_path = __DIR__ . "/" . $image_path;
    $exists = file_exists($full_path);
    
    echo "<tr>";
    echo "<td>" . $row['ID'] . "</td>";
    echo "<td>" . htmlspecialchars($row['AnimalName']) . "</td>";
    echo "<td>" . htmlspecialchars($row['AnimalImage']) . "</td>";
    echo "<td class='" . ($exists ? 'exists' : 'missing') . "'>" . ($exists ? 'File Exists' : 'File Missing') . "</td>";
    echo "<td><img src='" . htmlspecialchars($image_path) . "' height='50' onerror=\"this.src='admin/images/s1.png';\"></td>";
    echo "</tr>";
}

echo "</table>";
echo "</body></html>";
?> 