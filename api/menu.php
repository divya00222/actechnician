<?php
/**
 * Maithil Thal - Menu API
 * Returns menu items as JSON
 */

require_once '../includes/db.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT * FROM menu_items WHERE availability = 1");
    $items = $stmt->fetchAll();
    echo json_encode($items);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
