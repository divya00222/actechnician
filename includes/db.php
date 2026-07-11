<?php
/**
 * Maithil Thal - Database Connection
 * For Hostinger / cPanel Deployment
 */

$host = 'localhost';
$db_name = 'maithil_thal';
$username = 'root'; // Replace with your cPanel MySQL user
$password = '';     // Replace with your cPanel MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
