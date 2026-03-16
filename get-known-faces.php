<?php
header('Content-Type: application/json');

try {
    $db = new PDO('sqlite:' . __DIR__ . '/faces.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $db->query('SELECT id, name, image_path, descriptor FROM known_faces ORDER BY created_at DESC');
    $faces = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'data' => $faces
    ]);
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
} 