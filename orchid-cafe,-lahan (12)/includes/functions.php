<?php
/**
 * Orchid Cafe - Global Helper Functions
 */

/**
 * Escapes HTML for output protection (XSS)
 */
function h($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Clean input data
 */
function clean_input($data) {
    return trim(htmlspecialchars($data));
}

/**
 * Set flash message in session
 */
function set_flash_message($type, $message) {
    $_SESSION['flash'] = [
        'type' => $type, // success, error, info, warning
        'message' => $message
    ];
}

/**
 * Display flash message if exists
 */
function display_flash_message() {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        
        $classes = [
            'success' => 'bg-green-100 text-green-800 border-green-200',
            'error'   => 'bg-red-100 text-red-800 border-red-200',
            'info'    => 'bg-blue-100 text-blue-800 border-blue-200',
            'warning' => 'bg-amber-100 text-amber-800 border-amber-200'
        ];
        
        $cls = $classes[$flash['type']] ?? $classes['info'];
        
        echo "<div class='flash-message p-4 mb-6 rounded-2xl border {$cls} font-medium animate-in fade-in slide-in-from-top-4 duration-300'>";
        echo h($flash['message']);
        echo "</div>";
    }
}

/**
 * Handle image uploads securely
 */
function upload_image($file, $folder) {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
    if (!in_array($file['type'], $allowed_types)) {
        return false;
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid('img_') . '.' . $extension;
    $target_dir = __DIR__ . '/../uploads/' . $folder . '/';
    
    // Create directory if not exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $target_path = $target_dir . $filename;

    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        return 'uploads/' . $folder . '/' . $filename;
    }

    return false;
}

/**
 * Redirect helper
 */
function redirect($path) {
    header("Location: $path");
    exit;
}

/**
 * Format currency
 */
function format_currency($amount) {
    return 'Rs ' . number_format($amount, 0);
}

/**
 * Get all settings as an associative array
 */
function getAllSettings($pdo) {
    if (!$pdo instanceof PDO) return [];
    try {
        $stmt = $pdo->query("SELECT setting_key, setting_value FROM settings");
        $settings = [];
        while ($row = $stmt->fetch()) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        return $settings;
    } catch (PDOException $e) {
        // Fallback: If settings table doesn't exist yet, return empty or try business_info
        return getBusinessInfo($pdo);
    }
}

/**
 * Get a specific setting by key
 */
function getSetting($pdo, $key, $default = '') {
    static $settings = null;
    if ($settings === null) {
        $settings = getAllSettings($pdo);
    }
    return $settings[$key] ?? $default;
}

/**
 * Get business information (legacy support)
 */
function getBusinessInfo($pdo) {
    if (!$pdo instanceof PDO) return [];
    try {
        // Check if settings table exists first
        $stmt = $pdo->query("SHOW TABLES LIKE 'settings'");
        if ($stmt->rowCount() > 0) {
            return getAllSettings($pdo);
        }

        $stmt = $pdo->query("SELECT * FROM business_info LIMIT 1");
        return $stmt->fetch() ?: [];
    } catch (PDOException $e) {
        error_log("Error fetching business info: " . $e->getMessage());
        return [];
    }
}

/**
 * Get menu categories
 */
function getMenuCategories($pdo) {
    if (!$pdo instanceof PDO) return [];
    try {
        $stmt = $pdo->query("SELECT * FROM menu_categories WHERE status = 'active' ORDER BY sort_order ASC");
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching menu categories: " . $e->getMessage());
        return [];
    }
}

/**
 * Get menu items (optionally by category)
 */
function getMenuItems($pdo, $category_id = null) {
    if (!$pdo instanceof PDO) return [];
    try {
        if ($category_id) {
            $stmt = $pdo->prepare("SELECT * FROM menu_items WHERE category_id = ? AND status = 'active' ORDER BY sort_order ASC");
            $stmt->execute([(int)$category_id]);
        } else {
            $stmt = $pdo->query("SELECT * FROM menu_items WHERE status = 'active' ORDER BY sort_order ASC");
        }
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching menu items: " . $e->getMessage());
        return [];
    }
}

/**
 * Get gallery images
 */
function getGalleryImages($pdo, $category = null) {
    if (!$pdo instanceof PDO) return [];
    try {
        if ($category) {
            $stmt = $pdo->prepare("SELECT * FROM gallery_images WHERE category = ? ORDER BY sort_order ASC");
            $stmt->execute([$category]);
        } else {
            $stmt = $pdo->query("SELECT * FROM gallery_images ORDER BY sort_order ASC");
        }
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching gallery images: " . $e->getMessage());
        return [];
    }
}

/**
 * Get testimonials
 */
function getTestimonials($pdo) {
    if (!$pdo instanceof PDO) return [];
    try {
        $stmt = $pdo->query("SELECT * FROM testimonials WHERE status = 'active' ORDER BY created_at DESC");
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching testimonials: " . $e->getMessage());
        return [];
    }
}

/**
 * Get FAQs
 */
function getFAQs($pdo) {
    if (!$pdo instanceof PDO) return [];
    try {
        $stmt = $pdo->query("SELECT * FROM faqs WHERE status = 'active' ORDER BY sort_order ASC");
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching FAQs: " . $e->getMessage());
        return [];
    }
}

/**
 * Get featured menu items
 */
function getFeaturedDishes($pdo, $limit = 3) {
    if (!$pdo instanceof PDO) return [];
    try {
        $limit = (int)$limit;
        $stmt = $pdo->query("SELECT * FROM menu_items WHERE is_featured = 1 AND status = 'active' ORDER BY sort_order ASC LIMIT $limit");
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching featured dishes: " . $e->getMessage());
        return [];
    }
}

/**
 * Get active offers
 */
function getActiveOffers($pdo) {
    if (!$pdo instanceof PDO) return [];
    try {
        $stmt = $pdo->query("SELECT * FROM offers WHERE status = 'active' AND (expiry_date IS NULL OR expiry_date >= CURDATE()) ORDER BY id DESC");
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error fetching active offers: " . $e->getMessage());
        return [];
    }
}
