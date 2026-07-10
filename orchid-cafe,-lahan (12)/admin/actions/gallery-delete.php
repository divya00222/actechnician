<?php
/**
 * Orchid Cafe - Admin Action: Delete Gallery Image
 */
require_once '../../includes/db.php';
require_once '../../includes/functions.php';
require_once '../../includes/auth.php';

require_admin_auth();

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    try {
        // Delete file
        $stmt = $pdo->prepare("SELECT image_url FROM gallery_images WHERE id = ?");
        $stmt->execute([$id]);
        $img = $stmt->fetch();
        if ($img && !empty($img['image_url'])) {
            $file_path = '../../' . $img['image_url'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $stmt = $pdo->prepare("DELETE FROM gallery_images WHERE id = ?");
        $stmt->execute([$id]);
        
        set_flash_message('success', 'Image removed from gallery.');
    } catch (PDOException $e) {
        set_flash_message('error', 'Error: ' . $e->getMessage());
    }
}

header('Location: ../gallery.php');
exit;
?>
