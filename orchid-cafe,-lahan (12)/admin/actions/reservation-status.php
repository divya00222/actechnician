<?php
/**
 * Orchid Cafe - Admin Action: Update Reservation Status
 */
require_once '../../includes/db.php';
require_once '../../includes/functions.php';
require_once '../../includes/auth.php';

require_admin_auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id         = (int)$_POST['id'];
    $status     = clean_input($_POST['status']);
    $admin_note = clean_input($_POST['admin_note']);

    try {
        $stmt = $pdo->prepare("UPDATE reservations SET status = ?, admin_note = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        $stmt->execute([$status, $admin_note, $id]);
        
        set_flash_message('success', 'Reservation status updated successfully.');
    } catch (PDOException $e) {
        set_flash_message('error', 'Error updating reservation: ' . $e->getMessage());
    }
}

header('Location: ../reservations.php');
exit;
?>
