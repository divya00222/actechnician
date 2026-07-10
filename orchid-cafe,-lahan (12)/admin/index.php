<?php
/**
 * Orchid Cafe - Admin Index Redirect
 */
require_once '../includes/auth.php';

if (is_admin_logged_in()) {
    header('Location: dashboard.php');
} else {
    header('Location: login.php');
}
exit;
?>
