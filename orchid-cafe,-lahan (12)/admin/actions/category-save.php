<?php
/**
 * Orchid Cafe - Admin Action: Save Menu Category
 */
require_once '../../includes/db.php';
require_once '../../includes/functions.php';
require_once '../../includes/auth.php';

require_admin_auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id         = isset($_POST['id']) ? (int)$_POST['id'] : null;
    $name       = clean_input($_POST['name'] ?? '');
    $slug       = clean_input($_POST['slug'] ?? '');
    $sort_order = (int)($_POST['sort_order'] ?? 0);
    $status     = clean_input($_POST['status'] ?? 'active');

    if (empty($name) || empty($slug)) {
        set_flash_message('error', 'Name and Slug are required.');
        header('Location: ../menu-categories.php' . ($id ? "?edit=$id" : ""));
        exit;
    }

    try {
        if ($id) {
            // Update
            $stmt = $pdo->prepare("UPDATE menu_categories SET name = ?, slug = ?, sort_order = ?, status = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
            $stmt->execute([$name, $slug, $sort_order, $status, $id]);
            set_flash_message('success', 'Category updated successfully.');
        } else {
            // Create
            $stmt = $pdo->prepare("INSERT INTO menu_categories (name, slug, sort_order, status) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $slug, $sort_order, $status]);
            set_flash_message('success', 'Category created successfully.');
        }
    } catch (PDOException $e) {
        set_flash_message('error', 'Error: ' . $e->getMessage());
    }

    header('Location: ../menu-categories.php');
    exit;
} else {
    header('Location: ../menu-categories.php');
    exit;
}
?>
