<?php
/**
 * Orchid Cafe - Admin Action: Delete Testimonial
 */
require_once '../../includes/db.php';
require_once '../../includes/functions.php';
require_once '../../includes/auth.php';

require_admin_auth();

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    try {
        $stmt = $pdo->prepare("SELECT customer_image FROM testimonials WHERE id = ?");
        $stmt->execute([$id]);
        $test = $stmt->fetch();
        if ($test && !empty($test['customer_image'])) {
            if (file_exists('../../' . $test['customer_image'])) {
                unlink('../../' . $test['customer_image']);
            }
        }
        $stmt = $pdo->prepare("DELETE FROM testimonials WHERE id = ?");
        $stmt->execute([$id]);
        set_flash_message('success', 'Testimonial deleted.');
    } catch (PDOException $e) {
        set_flash_message('error', 'Error: ' . $e->getMessage());
    }
}

header('Location: ../testimonials.php');
exit;
?>
