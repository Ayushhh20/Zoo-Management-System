<?php
$models = [
    'tiny_face_detector_model-weights_manifest.json',
    'tiny_face_detector_model-shard1',
    'face_landmark_68_model-weights_manifest.json',
    'face_landmark_68_model-shard1',
    'face_recognition_model-weights_manifest.json',
    'face_recognition_model-shard1'
];

$baseUrl = 'https://raw.githubusercontent.com/justadudewhohacks/face-api.js/master/weights/';
$modelDir = __DIR__ . '/models/';

if (!file_exists($modelDir)) {
    mkdir($modelDir, 0777, true);
}

foreach ($models as $model) {
    $url = $baseUrl . $model;
    $savePath = $modelDir . $model;
    
    echo "Downloading $model...\n";
    $content = file_get_contents($url);
    
    if ($content === false) {
        echo "Error downloading $model\n";
        continue;
    }
    
    file_put_contents($savePath, $content);
    echo "Saved $model successfully\n";
}

echo "Model download complete!\n";
?> 