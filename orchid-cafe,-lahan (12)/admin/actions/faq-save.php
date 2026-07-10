<?php
/**
 * Orchid Cafe - Admin Action: Save FAQ
 */
require_once '../../includes/db.php';
require_once '../../includes/functions.php';
require_once '../../includes/auth.php';

require_admin_auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id         = isset($_POST['id']) ? (int)$_POST['id'] : null;
    $question   = clean_input($_POST['question'] ?? '');
    $answer     = clean_input($_POST['answer'] ?? '');
    $sort_order = (int)($_POST['sort_order'] ?? 0);
    $status     = clean_input($_POST['status'] ?? 'active');

    try {
        if ($id) {
            $stmt = $pdo->prepare("UPDATE faqs SET question = ?, answer = ?, sort_order = ?, status = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
            $stmt->execute([$question, $answer, $sort_order, $status, $id]);
            set_flash_message('success', 'FAQ updated.');
        } else {
            $stmt = $pdo->prepare("INSERT INTO faqs (question, answer, sort_order, status) VALUES (?, ?, ?, ?)");
            $stmt->execute([$question, $answer, $sort_order, $status]);
            set_flash_message('success', 'New FAQ added.');
        }
    } catch (PDOException $e) {
        set_flash_message('error', 'Error: ' . $e->getMessage());
    }

    header('Location: ../faqs.php');
    exit;
} else {
    header('Location: ../faqs.php');
    exit;
}
?>
