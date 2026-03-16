<?php
echo "<h2>Required Extensions Check</h2>";

// Check SQLite3
if (extension_loaded('sqlite3')) {
    echo "✅ SQLite3 is installed and enabled<br>";
} else {
    echo "❌ SQLite3 is NOT installed or enabled<br>";
    echo "Please enable extension=sqlite3 in php.ini<br>";
}

// Check PDO SQLite
if (extension_loaded('pdo_sqlite')) {
    echo "✅ PDO SQLite is installed and enabled<br>";
} else {
    echo "❌ PDO SQLite is NOT installed or enabled<br>";
    echo "Please enable extension=pdo_sqlite in php.ini<br>";
}

// Check GD
if (extension_loaded('gd')) {
    echo "✅ GD Library is installed and enabled<br>";
} else {
    echo "❌ GD Library is NOT installed or enabled<br>";
    echo "Please enable extension=gd in php.ini<br>";
}

// Check directory permissions
echo "<h2>Directory Permissions Check</h2>";

$directories = [
    'uploads/faces',
    'models',
    '.' // current directory for faces.db
];

foreach ($directories as $dir) {
    echo "<strong>$dir</strong>: ";
    if (!file_exists($dir)) {
        echo "❌ Directory does not exist<br>";
        continue;
    }
    
    if (is_writable($dir)) {
        echo "✅ Writable<br>";
    } else {
        echo "❌ NOT writable<br>";
        echo "Please give write permissions to the web server user<br>";
    }
}

// Check if we can create/write to SQLite database
echo "<h2>SQLite Database Check</h2>";
try {
    $testDb = new PDO('sqlite:test.db');
    echo "✅ SQLite database creation successful<br>";
    unlink('test.db'); // Clean up test database
} catch (Exception $e) {
    echo "❌ SQLite database creation failed<br>";
    echo "Error: " . $e->getMessage() . "<br>";
}

// Display full PHP info for reference
echo "<h2>Full PHP Info</h2>";
phpinfo();
?> 