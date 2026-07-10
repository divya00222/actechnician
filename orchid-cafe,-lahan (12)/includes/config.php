<?php
/**
 * Orchid Cafe - Global Configuration & Bootstrap
 * Optimized for Hostinger/cPanel Shared Hosting
 */

// --- 1. SESSION MANAGEMENT ---
if (session_status() === PHP_SESSION_NONE) {
    // Security settings for production
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_samesite', 'Lax');
    
    // Set session lifetime to 1 day (86400 seconds) for standard persistence
    ini_set('session.gc_maxlifetime', 86400);
    session_set_cookie_params(86400);
    
    session_start();
}

// Global Constants
define('BASE_URL', '/'); // Adjust for subdirectory hosting if needed

// --- 2. APP SETTINGS ---
define('APP_NAME', 'Orchid Cafe');
define('APP_URL', 'https://yourdomain.com'); // Update this to your real domain
define('APP_TIMEZONE', 'Asia/Kathmandu');
date_default_timezone_set(APP_TIMEZONE);

// --- 3. DATABASE CREDENTIALS ---
// Updated with real credentials for Hostinger/cPanel environment
define('DB_HOST', 'sql306.cpanelfree.com');
define('DB_NAME', 'cpfr_42220742_thakali');
define('DB_USER', 'cpfr_42220742');
define('DB_PASS', 'x0u3vyXY42');

// --- 4. PATH DEFINITIONS ---
// Use __DIR__ to ensure paths are always relative to this file
define('BASE_DIR', dirname(__DIR__));
define('INCLUDES_DIR', BASE_DIR . '/includes');
define('UPLOADS_DIR', BASE_DIR . '/uploads');

// --- 5. DATABASE CONNECTION (PDO) ---
try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false, // Use real prepared statements
    ];

    // Create the global $pdo connection object
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);

} catch (PDOException $e) {
    // Determine if we should show detailed errors (only on localhost)
    $is_local = in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']);
    
    if ($is_local) {
        die("Database Connection Error: " . $e->getMessage());
    } else {
        // Production: log error and show friendly message
        error_log("DB Connection Failed: " . $e->getMessage());
        die("An internal error occurred. Please try again later.");
    }
}

// --- 6. GLOBAL HELPERS ---
// Load common functions now that the database is connected
require_once INCLUDES_DIR . '/functions.php';
