<?php
/**
 * Orchid Cafe - Reservation Form Submission Handler
 */
require_once '../includes/db.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize Inputs
    $name     = clean_input($_POST['name'] ?? '');
    $phone    = clean_input($_POST['phone'] ?? '');
    $email    = clean_input($_POST['email'] ?? '');
    $date     = clean_input($_POST['date'] ?? '');
    $time     = clean_input($_POST['time'] ?? '');
    $guests   = (int)($_POST['guests'] ?? 2);
    $occasion = clean_input($_POST['occasion'] ?? 'none');
    $seating  = clean_input($_POST['seating'] ?? 'any');
    $requests = clean_input($_POST['requests'] ?? '');

    // Simple Validation
    if (empty($name) || empty($phone) || empty($email) || empty($date) || empty($time)) {
        set_flash_message('error', 'Please fill in all required fields.');
        header('Location: ../reservations.php');
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO reservations (name, phone, email, reservation_date, reservation_time, guests, occasion, seating_preference, special_requests, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
        $stmt->execute([$name, $phone, $email, $date, $time, $guests, $occasion, $seating, $requests]);

        set_flash_message('success', 'Your reservation request has been sent! We will confirm via phone/email soon.');
        header('Location: ../reservations.php');
        exit;
    } catch (PDOException $e) {
        // In real world, log $e->getMessage()
        set_flash_message('error', 'Sorry, something went wrong. Please try again later.');
        header('Location: ../reservations.php');
        exit;
    }
} else {
    header('Location: ../reservations.php');
    exit;
}
?>
