<?php
/**
 * Orchid Cafe - Admin Authentication Helper
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Check if admin is logged in
 */
function is_admin_logged_in() {
    return isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']);
}

/**
 * Redirect if not logged in
 */
function require_admin_auth() {
    if (!is_admin_logged_in()) {
        header('Location: login.php');
        exit;
    }
}
?>
