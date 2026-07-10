<?php
/**
 * Orchid Cafe - Admin Action: Delete Menu Category
 */
require_once '../../includes/db.php';
require_once '../../includes/functions.php';
require_once '../../includes/auth.php';

require_admin_auth();

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    try {
        // Option A: Just delete. (Items will have a foreign key issue if not handled)
        // Option B: Set items to NULL category (if allowed)
        // For this simple implementation, we delete.
        
        $stmt = $pdo->prepare("DELETE FROM menu_categories WHERE id = ?");
        $stmt->execute([$id]);
        
        set_flash_message('success', 'Category deleted successfully.');
    } catch (PDOException $e) {
        set_flash_message('error', 'Cannot delete category as it may contain menu items. Please remove items first.');
    }
}

header('Location: ../menu-categories.php');
exit;
?>
