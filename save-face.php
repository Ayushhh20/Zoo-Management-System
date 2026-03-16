<?php
header('Content-Type: application/json');

// Create directories if they don't exist
$uploadsDir = __DIR__ . '/uploads/faces';
if (!file_exists($uploadsDir)) {
    mkdir($uploadsDir, 0777, true);
}

// Database connection
try {
    $db = new PDO('sqlite:' . __DIR__ . '/faces.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create table if not exists
    $db->exec('CREATE TABLE IF NOT EXISTS known_faces (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        image_path TEXT NOT NULL,
        descriptor TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )');
} catch(PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $imageData = $_POST['image'] ?? '';
    $descriptor = $_POST['descriptor'] ?? '';
    
    if (empty($name) || empty($imageData) || empty($descriptor)) {
        die(json_encode(['success' => false, 'message' => 'Missing required data']));
    }
    
    // Process and save the image
    $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $imageData = base64_decode($imageData);
    
    $fileName = uniqid() . '.jpg';
    $filePath = $uploadsDir . '/' . $fileName;
    
    if (file_put_contents($filePath, $imageData)) {
        try {
            $stmt = $db->prepare('INSERT INTO known_faces (name, image_path, descriptor) VALUES (?, ?, ?)');
            $relativePath = 'uploads/faces/' . $fileName;
            $stmt->execute([$name, $relativePath, $descriptor]);
            
            echo json_encode([
                'success' => true,
                'message' => 'Face saved successfully',
                'data' => [
                    'id' => $db->lastInsertId(),
                    'name' => $name,
                    'image_path' => $relativePath
                ]
            ]);
        } catch(PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save image']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
} 