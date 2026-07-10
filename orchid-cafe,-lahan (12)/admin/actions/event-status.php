<?php
/**
 * Orchid Cafe - Admin Action: Update Event Status
 */
require_once '../../includes/db.php';
require_once '../../includes/functions.php';
require_once '../../includes/auth.php';

require_admin_auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $status = clean_input($_POST['status']);
    $admin_note = clean_input($_POST['admin_note']);

    try {
        $stmt = $pdo->prepare("UPDATE event_inquiries SET status = ?, admin_note = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        $stmt->execute([$status, $admin_note, $id]);
        set_flash_message('success', 'Event inquiry updated.');
    } catch (PDOException $e) {
        set_flash_message('error', 'Error: ' . $e->getMessage());
    }
}

header('Location: ../events.php');
exit;
?>
