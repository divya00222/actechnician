<?php
/**
 * Orchid Cafe - Event Inquiry Submission Handler
 */
require_once '../includes/db.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize Inputs
    $name        = clean_input($_POST['name'] ?? '');
    $phone       = clean_input($_POST['phone'] ?? '');
    $event_type  = clean_input($_POST['event_type'] ?? 'other');
    $date        = clean_input($_POST['date'] ?? '');
    $guest_count = (int)($_POST['guest_count'] ?? 0);
    $details     = clean_input($_POST['details'] ?? '');

    // Simple Validation
    if (empty($name) || empty($phone) || empty($date) || $guest_count <= 0) {
        set_flash_message('error', 'Please fill in all required fields.');
        header('Location: ../private-dining.php');
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO event_inquiries (name, phone, event_type, event_date, guest_count, details, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')");
        $stmt->execute([$name, $phone, $event_type, $date, $guest_count, $details]);

        set_flash_message('success', 'Your event inquiry has been submitted. Our event coordinator will contact you soon!');
        header('Location: ../private-dining.php');
        exit;
    } catch (PDOException $e) {
        set_flash_message('error', 'Sorry, something went wrong. Please try again later.');
        header('Location: ../private-dining.php');
        exit;
    }
} else {
    header('Location: ../private-dining.php');
    exit;
}
?>
