<?php
/**
 * Orchid Cafe - Contact Form Submission Handler
 */
require_once '../includes/db.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize Inputs
    $name    = clean_input($_POST['name'] ?? '');
    $email   = clean_input($_POST['email'] ?? '');
    $subject = clean_input($_POST['subject'] ?? 'general');
    $message = clean_input($_POST['message'] ?? '');

    // Simple Validation
    if (empty($name) || empty($email) || empty($message)) {
        set_flash_message('error', 'Please fill in all required fields.');
        header('Location: ../contact.php');
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message, status) VALUES (?, ?, ?, ?, 'unread')");
        $stmt->execute([$name, $email, $subject, $message]);

        set_flash_message('success', 'Thank you for your message! We will get back to you shortly.');
        header('Location: ../contact.php');
        exit;
    } catch (PDOException $e) {
        set_flash_message('error', 'Sorry, something went wrong. Please try again later.');
        header('Location: ../contact.php');
        exit;
    }
} else {
    header('Location: ../contact.php');
    exit;
}
?>
