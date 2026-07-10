<?php
/**
 * Orchid Cafe - Admin Action: Delete Message
 */
require_once '../../includes/db.php';
require_once '../../includes/functions.php';
require_once '../../includes/auth.php';

require_admin_auth();

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM contact_messages WHERE id = ?");
        $stmt->execute([$id]);
        set_flash_message('success', 'Message deleted.');
    } catch (PDOException $e) {
        set_flash_message('error', 'Error: ' . $e->getMessage());
    }
}

header('Location: ../messages.php');
exit;
?>
