<?php
header('Content-Type: text/html; charset=utf-8');
echo "<pre>";

// Create models directory if it doesn't exist
$modelsDir = __DIR__ . '/models';

echo "Starting model download process...\n\n";

// Create or clean models directory
if (!file_exists($modelsDir)) {
    echo "Creating models directory...\n";
    if (!mkdir($modelsDir, 0777, true)) {
        die("Failed to create models directory. Please check permissions.\n");
    }
} else {
    echo "Cleaning up existing model files...\n";
    $files = glob($modelsDir . '/*');
    foreach ($files as $file) {
        if (is_file($file)) {
            if (unlink($file)) {
                echo "Deleted: " . basename($file) . "\n";
            } else {
                echo "Failed to delete: " . basename($file) . "\n";
            }
        }
    }
}

echo "\nPreparing to download new model files...\n";

// Model files to download with correct file sizes
$models = [
    'tiny_face_detector_model-shard1' => [
        'url' => 'https://raw.githubusercontent.com/justadudewhohacks/face-api.js/master/weights/tiny_face_detector_model-shard1',
        'size' => 190356
    ],
    'tiny_face_detector_model-weights_manifest.json' => [
        'url' => 'https://raw.githubusercontent.com/justadudewhohacks/face-api.js/master/weights/tiny_face_detector_model-weights_manifest.json',
        'size' => 635
    ],
    'face_landmark_68_model-shard1' => [
        'url' => 'https://raw.githubusercontent.com/justadudewhohacks/face-api.js/master/weights/face_landmark_68_model-shard1',
        'size' => 1024434
    ],
    'face_landmark_68_model-weights_manifest.json' => [
        'url' => 'https://raw.githubusercontent.com/justadudewhohacks/face-api.js/master/weights/face_landmark_68_model-weights_manifest.json',
        'size' => 631
    ],
    'face_recognition_model-shard1' => [
        'url' => 'https://raw.githubusercontent.com/justadudewhohacks/face-api.js/master/weights/face_recognition_model-shard1',
        'size' => 6156329
    ],
    'face_recognition_model-shard2' => [
        'url' => 'https://raw.githubusercontent.com/justadudewhohacks/face-api.js/master/weights/face_recognition_model-shard2',
        'size' => 3025667
    ],
    'face_recognition_model-weights_manifest.json' => [
        'url' => 'https://raw.githubusercontent.com/justadudewhohacks/face-api.js/master/weights/face_recognition_model-weights_manifest.json',
        'size' => 169
    ]
];

echo "\nDownloading model files...\n";
echo "------------------------\n";

$allSuccess = true;

foreach ($models as $filename => $info) {
    echo "\nProcessing $filename:\n";
    
    // Create a stream context with timeout and user agent
    $context = stream_context_create([
        'http' => [
            'timeout' => 300,
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
            'ignore_errors' => true
        ],
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false
        ]
    ]);
    
    echo "- Downloading... ";
    $content = file_get_contents($info['url'], false, $context);
    
    if ($content === false) {
        echo "ERROR!\n";
        echo "  Failed to download file. Please check your internet connection.\n";
        $allSuccess = false;
        continue;
    }
    
    $downloadedSize = strlen($content);
    echo "OK (" . $downloadedSize . " bytes)\n";
    
    if ($downloadedSize != $info['size']) {
        echo "  Warning: File size mismatch. Expected {$info['size']} bytes but got {$downloadedSize} bytes.\n";
    }
    
    $filepath = $modelsDir . '/' . $filename;
    echo "- Saving... ";
    if (file_put_contents($filepath, $content)) {
        echo "OK\n";
        echo "- Verifying... ";
        if (file_exists($filepath) && filesize($filepath) === $downloadedSize) {
            echo "OK\n";
        } else {
            echo "FAILED!\n";
            $allSuccess = false;
        }
    } else {
        echo "FAILED!\n";
        echo "  Could not save file. Please check directory permissions.\n";
        $allSuccess = false;
    }
}

echo "\n----------------------------------------\n";
if ($allSuccess) {
    echo "✓ All models downloaded and verified successfully!\n";
    echo "\nYou can now use the face recognition system.\n";
    echo "Please refresh your browser to load the new models.\n";
} else {
    echo "⚠ Some models failed to download or verify.\n";
    echo "Please try running this script again.\n";
}
echo "</pre>";

// Add a refresh button
echo '<br><button onclick="window.location.reload()">Try Again</button>';
echo '<br><br><button onclick="window.location.href=\'face-recognition.php\'">Go to Face Recognition</button>';
?> 