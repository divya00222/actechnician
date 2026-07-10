<?php
/**
 * Orchid Cafe - Admin Action: Delete Menu Item
 */
require_once '../../includes/db.php';
require_once '../../includes/functions.php';
require_once '../../includes/auth.php';

require_admin_auth();

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    try {
        // Optional: Delete physical image file
        $stmt = $pdo->prepare("SELECT image FROM menu_items WHERE id = ?");
        $stmt->execute([$id]);
        $item = $stmt->fetch();
        if ($item && !empty($item['image'])) {
            $file_path = '../../' . $item['image'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $stmt = $pdo->prepare("DELETE FROM menu_items WHERE id = ?");
        $stmt->execute([$id]);
        
        set_flash_message('success', 'Menu item deleted successfully.');
    } catch (PDOException $e) {
        set_flash_message('error', 'Error deleting item: ' . $e->getMessage());
    }
}

header('Location: ../menu-items.php');
exit;
?>
