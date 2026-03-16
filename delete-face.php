<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die(json_encode(['success' => false, 'message' => 'Invalid request method']));
}

$id = $_POST['id'] ?? null;
if (!$id) {
    die(json_encode(['success' => false, 'message' => 'Face ID is required']));
}

try {
    $db = new PDO('sqlite:' . __DIR__ . '/faces.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // First get the image path
    $stmt = $db->prepare('SELECT image_path FROM known_faces WHERE id = ?');
    $stmt->execute([$id]);
    $face = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$face) {
        die(json_encode(['success' => false, 'message' => 'Face not found']));
    }
    
    // Delete the image file
    $imagePath = __DIR__ . '/' . $face['image_path'];
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
    
    // Delete from database
    $stmt = $db->prepare('DELETE FROM known_faces WHERE id = ?');
    $stmt->execute([$id]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Face deleted successfully'
    ]);
    
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
} 