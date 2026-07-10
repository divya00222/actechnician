<?php
/**
 * Orchid Cafe - Save Settings Action
 */
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/auth.php';

// Verify admin auth
require_admin_auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->beginTransaction();
    
    try {
        // Simple key-value update logic
        $allowed_settings = [
            'business_name', 'tagline', 'address', 'phone', 'email', 'whatsapp', 
            'opening_hours_text', 'facebook_url', 'instagram_url', 'tiktok_url', 
            'youtube_url', 'hero_title', 'hero_subtitle', 'hero_cta_text', 
            'hero_cta_link', 'footer_about', 'map_embed_url', 'site_title', 
            'meta_description', 'established_since', 'google_rating', 'reviews_count'
        ];

        $stmt = $pdo->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?");

        foreach ($allowed_settings as $key) {
            if (isset($_POST[$key])) {
                $val = $_POST[$key];
                $stmt->execute([$key, $val, $val]);
            }
        }

        // Handle File Uploads (Logo & Favicon)
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $logo_path = upload_image($_FILES['logo'], 'branding');
            if ($logo_path) {
                $stmt->execute(['logo', $logo_path, $logo_path]);
            }
        }

        if (isset($_FILES['favicon']) && $_FILES['favicon']['error'] === UPLOAD_ERR_OK) {
            $favicon_path = upload_image($_FILES['favicon'], 'branding');
            if ($favicon_path) {
                $stmt->execute(['favicon', $favicon_path, $favicon_path]);
            }
        }

        $pdo->commit();
        set_flash_message('success', 'Settings updated successfully.');
    } catch (Exception $e) {
        $pdo->rollBack();
        set_flash_message('error', 'Error saving settings: ' . $e->getMessage());
    }

    redirect('../settings.php');
} else {
    redirect('../dashboard.php');
}
