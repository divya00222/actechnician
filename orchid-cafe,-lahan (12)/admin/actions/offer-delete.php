<?php
/**
 * Orchid Cafe - Admin Action: Delete Special Offer
 */
require_once '../../includes/db.php';
require_once '../../includes/functions.php';
require_once '../../includes/auth.php';

require_admin_auth();

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    try {
        // Delete file
        $stmt = $pdo->prepare("SELECT image_url FROM offers WHERE id = ?");
        $stmt->execute([$id]);
        $offer = $stmt->fetch();
        if ($offer && !empty($offer['image_url'])) {
            $file_path = '../../' . $offer['image_url'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $stmt = $pdo->prepare("DELETE FROM offers WHERE id = ?");
        $stmt->execute([$id]);
        
        set_flash_message('success', 'Offer deleted.');
    } catch (PDOException $e) {
        set_flash_message('error', 'Error: ' . $e->getMessage());
    }
}

header('Location: ../offers.php');
exit;
?>
