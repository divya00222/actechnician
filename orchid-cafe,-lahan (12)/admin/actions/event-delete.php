<?php
/**
 * Orchid Cafe - Admin Action: Delete Event Inquiry
 */
require_once '../../includes/db.php';
require_once '../../includes/functions.php';
require_once '../../includes/auth.php';

require_admin_auth();

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM event_inquiries WHERE id = ?");
        $stmt->execute([$id]);
        set_flash_message('success', 'Inquiry deleted.');
    } catch (PDOException $e) {
        set_flash_message('error', 'Error: ' . $e->getMessage());
    }
}

header('Location: ../events.php');
exit;
?>
