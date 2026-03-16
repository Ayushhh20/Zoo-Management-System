<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Try database connection
$con = mysqli_connect("localhost", "root", "", "zmsdb");

// Check connection
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
} else {
    echo "Database connection successful!";
    
    // Try to query a table
    $query = mysqli_query($con, "SHOW TABLES");
    if ($query) {
        echo "<br>Tables in database:<br>";
        while ($row = mysqli_fetch_array($query)) {
            echo $row[0] . "<br>";
        }
    } else {
        echo "<br>Error querying tables: " . mysqli_error($con);
    }
}
?> 