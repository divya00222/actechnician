<?php
/**
 * Orchid Cafe - Change Password Action
 */
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/auth.php';

// Verify admin auth
require_admin_auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    $admin_id = $_SESSION['admin_id'];

    // 1. Basic validation
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        set_flash_message('error', 'All fields are required.');
        redirect('../change-password.php');
    }

    if ($new_password !== $confirm_password) {
        set_flash_message('error', 'New passwords do not match.');
        redirect('../change-password.php');
    }

    if (strlen($new_password) < 8) {
        set_flash_message('error', 'New password must be at least 8 characters long.');
        redirect('../change-password.php');
    }

    try {
        // 2. Fetch current admin from DB
        $stmt = $pdo->prepare("SELECT password FROM admins WHERE id = ?");
        $stmt->execute([$admin_id]);
        $admin = $stmt->fetch();

        if (!$admin || !password_verify($current_password, $admin['password'])) {
            set_flash_message('error', 'Current password is incorrect.');
            redirect('../change-password.php');
        }

        // 3. Hash and update
        $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE admins SET password = ? WHERE id = ?");
        $stmt->execute([$new_hash, $admin_id]);

        set_flash_message('success', 'Password updated successfully. Please keep it safe.');
        redirect('../change-password.php');
        
    } catch (PDOException $e) {
        set_flash_message('error', 'Database error: ' . $e->getMessage());
        redirect('../change-password.php');
    }
} else {
    redirect('../dashboard.php');
}
